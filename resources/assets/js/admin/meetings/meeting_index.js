"use strict";

$(document).ready(function () {
    let tbl = $('#meetingsTable').DataTable({
        processing: true,
        serverSide: true,
        'bStateSave': true,
        'order': [[1, 'desc']],
        ajax: {
            url: meetingsUrl
        },
        columnDefs: [
            {
                'targets': [1],
                'className': 'text-center start-date-width',
            },
            {
                'targets': [2],
                'className': 'text-center',
                'width': '10%',
            },
            {
                'targets': [3],
                'orderable': false,
                'width': '15%',
                'className': 'text-center',
            },
            {
                'targets': [4],
                'orderable': false,
                'className': 'text-center',
                'width': '100px'
            },
            {
                'targets': [5],
                'orderable': false,
                'className': 'text-center',
                'width': '150px'
            }
        ],
        columns: [
            {
                data: 'topic',
                name: 'topic',
            },
            {
                data: function (row) {
                    return moment(row.start_time, 'YYYY-MM-DD hh:mm:ss').format('Do MMM, YYYY hh:mm A')
                },
                name: 'start_time',
            },
            {
                data: function (row) {
                    return `${ row.duration } minutes`
                },
                name: 'duration',
            },
            {
                data: function (row) {
                   return `<select class="statusDrp" data-id="${row.id}">` +
                    `<option value="1" ${row.status == 1 ? 'selected' : ''}>Awaited</option><option value="2" ${row.status == 2 ? 'selected' : ''}>Finished</option>`
                    +`</select>`
                },
                name: 'status',
            },
            {
                data: 'password',
                name: 'password',
            },
            {
                data: function (row) {
                    let startBtn = '<a href="' + row.meta.start_url + '" target="_blank" class="btn btn-primary btn-sm m-1 zoom-video"><i class="fa fa-video-camera"></i></a>';
                    let editBtn = '<a title="Edit" class="index__btn btn btn-ghost-success btn-sm edit-btn mr-1" href="' +
                        meetingsUrl + '/' + row.id + '/edit' + '">' +
                        '<i class="cui-pencil action-icon"></i>' +
                        '</a>';
                    startBtn = row.status == 1 ? startBtn + editBtn: '';
                    return '<div class="d-flex justify-content-center align-items-center">' + startBtn + '<button title="Delete" class="index__btn btn btn-ghost-danger btn-sm delete-btn" data-id="' +
                        row.id + '">' +
                        '<i class="cui-trash action-icon"></i></button> </div>';
                }, name: 'id',
                'searchable': false,
            }
        ],
        drawCallback: function () {
            this.api().state.clear();
            $('.statusDrp').select2({
                width: '100%',
                minimumResultsForSearch: -1,
                placeholder: "Select Members",
            });
        },
    });

    $(document).on('change', '.statusDrp', function () {
        let meetingId = $(this).data('id');

        $.ajax({
            url: meetingsUrl + '/' + meetingId + '/change-status',
            type: 'GET',
            success: function (obj) {
                if (obj.success) {
                    tbl.ajax.reload();
                }
            },
            error: function (data) {
                displayToastr('Error', 'error', data.responseJSON.message);
            },
        });
    });
});

let deleteBtn;
const swalDelete = Swal.mixin({
    customClass: {
        confirmButton: 'btn btn-danger mr-2 btn-lg',
        cancelButton: 'btn btn-secondary btn-lg',
    },
    buttonsStyling: false,
});

function deleteItem (url, tableId, header, callFunction = null) {
    swalDelete.fire({
        title: 'Are you sure?',
        html: 'Are you sure want to delete this "' + header + '" ?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Delete',
        input: 'text',
        inputPlaceholder: 'Write "delete" to delete this meeting',
        inputValidator: (value) => {
            if (value !== "delete") {
                return 'You need to write "delete"'
            }
        }
    }).then((result) => {
        if (result.value) {
            deleteBtn.addClass('invisible');
            deleteItemAjax(url, tableId, header, callFunction = null);
        }
    });
}

// open delete confirmation model
$(document).on('click', '.delete-btn', function (event) {
    let meetingId = $(this).data('id');
    deleteBtn = $(this);
    deleteItem(meetingsUrl + '/' + meetingId, '#meetingsTable', 'Meeting');
});

setTimeout(() => {
    $('.alert').slideUp(() => {
        $(this).addClass('d-none');
    })
}, 1500);
