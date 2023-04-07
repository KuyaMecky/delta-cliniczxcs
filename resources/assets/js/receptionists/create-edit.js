document.addEventListener('turbo:load', loadEditReceptionistsData)

function loadEditReceptionistsData() {
    createReceptionistForm()
    editReceptionistForm()
}

function createReceptionistForm() {
    if (!$('#receptionistBirthDate').length) {
        return
    }

    $('#receptionistBirthDate').flatpickr({
        format: 'YYYY-MM-DD',
        useCurrent: true,
        sideBySide: true,
        maxDate: new Date(),
        locale : $('.userCurrentLanguage').val(),
    });
    $('#receptionistBloodGroup').select2({
        width: '100%',
    });

    $('#receptionistDepartmentId').select2({
        width: '100%',
    });
    $('#createReceptionForm').find('input:text:visible:first').focus();

}

function editReceptionistForm() {
    if (!$('#editReceptionistBirthDate').length) {
        return
    }
    $('#editReceptionistBirthDate').flatpickr({
        format: 'YYYY-MM-DD',
        useCurrent: true,
        sideBySide: true,
        maxDate: new Date(),
        locale : $('.userCurrentLanguage').val(),
    });

    $('#editReceptionistBloodGroup').select2({
        width: '100%',
    });

    $('#editReceptionForm').find('input:text:visible:first').focus();
}


listenSubmit('#createReceptionForm, #editReceptionForm', function () {
    if ($('.error-msg').text() !== '') {
        $('.phoneNumber').focus();
        return false;
    }
});
listenClick('.remove-receptionist-image', function () {
    defaultImagePreview('#receptionistPreviewImage', 1);
});
