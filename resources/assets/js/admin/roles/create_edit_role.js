
$('#createRoleForm').on('submit', function (event) {
    event.preventDefault();
    let loadingButton = jQuery(this).find('#btnCreateRole');
    loadingButton.button('loading');

    $('#createRoleForm')[0].submit();

    return true;
});

$('#editRoleForm').on('submit', function (event) {
    event.preventDefault();
    let loadingButton = jQuery(this).find('#btnEditSave');
    loadingButton.button('loading');

    $('#editRoleForm')[0].submit();

    return true;
});
