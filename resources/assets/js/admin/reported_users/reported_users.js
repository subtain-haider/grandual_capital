$(document).ready(function () {

    $('#isActiveFilter').select2({
        minimumResultsForSearch: -1,
        placeholder: "Select Status",
    });

    let tbl = $('#reportedUsersTable').DataTable({
        processing: true,
        serverSide: true,
        'bStateSave': true,
        'order': [[2, 'desc']],
        ajax: {
            url: reportedUsersUrl,
            data: function (data) {
                data.is_active_filter = $('#isActiveFilter').find('option:selected').val();
            },
        },
        columnDefs: [
            {
                'targets': [4],
                'orderable': false,
                'className': 'text-center',
                'width': '7%',
            },
            {
                'targets': [3],
                'orderable': false,
                'className': 'text-center',
                'width': '80px',
            },
            {
                'targets': [2],
                'width': '100px',
            },
        ],
        columns: [
            {
                data: function (data) {
                    return htmlSpecialCharsDecode(data.reported_by.name);
                },
                name: 'reportedBy.name',
            },
            {
                data: function (data) {
                    return htmlSpecialCharsDecode(data.reported_to.name);
                },
                name: 'reportedTo.name',
            },
            {
                data: function (row) {
                    return row
                },
                render: function (row) {
                    return '<span data-toggle="tooltip" title="' +
                        format(row.created_at, 'hh:mm:ss a') + '">' +
                        format(row.created_at) + '</span>';
                },
                name: 'created_at',
            },
            {
                data: function (row) {
                    if (row.reported_to.id == loggedInUserId) {
                        return row.reported_to.is_active ? 'Active' : 'Deactive';
                    }
                    row.checked = row.reported_to.is_active === 0 ? '' : 'checked';
                    return $.templates('#isActiveSwitch').render(row);
                }, name: 'id',
            },
            {
                data: function (row) {
                    return $.templates('#viewDelIcons').render(row);
                }, name: 'id',
            },
        ],
        drawCallback: function () {
            this.api().state.clear();
            $('[data-toggle="tooltip"]').tooltip();
        },
        'fnInitComplete': function () {
            $('#isActiveFilter').change(function () {
                tbl.ajax.reload()
            });
        },
    });

    window.format = function (dateTime, format = 'DD-MMM-YYYY') {
        return moment(dateTime).format(format);
    };

    const swalDelete = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-danger mr-2 btn-lg',
            cancelButton: 'btn btn-secondary btn-lg',
        },
        buttonsStyling: false,
    });

    // open delete confirmation model
    $(document).on('click', '.delete-btn', function () {
        let reportedUsersId = $(this).data('id');
        let deleteReportedUsersUrl = reportedUsersUrl + '/' + reportedUsersId;
        deleteItem(deleteReportedUsersUrl, '#reportedUsersTable', 'Reported User');
    });

    $(document).on('click', '.view-btn', function () {
        let reportId = $(this).data('id');
        let viewReportedUsersUrl = reportedUsersUrl + '/' + reportId;

        $.ajax({
            type: 'GET',
            url: viewReportedUsersUrl,
            success: function (data) {
                $('.reported-user-notes').html(data.notes);
                $('.reported-by').text(data.reported_by.name);
                $('.reported-to').text(data.reported_to.name);
                $('#viewReportNoteModal').modal('show');
            }
        });
    });

    function deleteItem (url, tableId, header, callFunction = null) {
        swalDelete.fire({
            title: 'Are you sure?',
            html: 'Are you sure want to delete this "' + header + '" ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Delete',
        }).then((result) => {
            if (result.value) {
                deleteItemAjax(url, tableId, header, callFunction = null);
            }
        });
    }

    // listen user activation deactivation change event
    $(document).on('change', '.is-active', function (event) {
        const userId = $(event.currentTarget).data('id');
        activeDeActiveUser(userId);
    });

    // activate de-activate user
    window.activeDeActiveUser = function (id) {
        $.ajax({
            url: usersUrl + '/' + id + '/active-de-active',
            method: 'post',
            cache: false,
            success: function (result) {
                if (result.success) {
                    tbl.ajax.reload(null, false);
                }
            },
            error: function (error) {
                displayToastr('Error', 'error', error.responseJSON.message);
            }
        });
    };
});
