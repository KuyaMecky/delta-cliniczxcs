document.addEventListener('turbo:load', loadAdminData)

function loadAdminData()
{
    $('#adminBirthDate').flatpickr({
        format: 'YYYY-MM-DD',
        useCurrent: true,
        sideBySide: true,
        maxDate: new Date(),
        locale : $('.userCurrentLanguage').val(),
    });

    $('#editAdminBirthDate').flatpickr({
        format: 'YYYY-MM-DD',
        useCurrent: true,
        sideBySide: true,
        maxDate: new Date(),
        locale : $('.userCurrentLanguage').val(),
    });
    
    listenClick('.delete-admin-btn', function (event){
        let adminId = $(event.currentTarget).attr('data-id');
        deleteItem($('#adminURL').val() + '/' + adminId, '', $('#admin').val());
    });
}

listenSubmit('#createAdminForm, #editAdminForm', function () {
    if ($('.error-msg').text() !== '') {
        $('.phoneNumber').focus();
        return false;
    }
});


listenChange('.admin-status', function (event) {
    let accountantId = $(event.currentTarget).attr('data-id');
    updateAccountantStatus(accountantId);
});

function updateAccountantStatus(id) {
    $.ajax({
        url: $('#adminURL').val() + '/' + +id + '/active-deactive',
        method: 'post',
        cache: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                livewire.emit('refresh')
            }
        },
    });
}

listenChange('#admin_filter_status', function () {
    window.livewire.emit('changeFilter', 'statusFilter', $(this).val())
});

listen('click', '#accountResetFilter', function () {
    $('#admin_filter_status').val(0).trigger('change');
    hideDropdownManually($('#adminFilterBtn'), $('.dropdown-menu'));
});
