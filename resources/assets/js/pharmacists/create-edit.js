document.addEventListener('turbo:load', loadEditPharmacistData)

function loadEditPharmacistData() {
    if (!$('#createPharmacistForm').length && !$('#editPharmacistForm').length) {
        return
    }

    $('.pharmacistBloodGroup').select2({
        width: '100%',
    });
    let birthDate = $('.pharmacistBirthDate').flatpickr({
        dateFormat: 'Y-m-d',
        useCurrent: false,
        locale : $('.userCurrentLanguage').val(),
    });
    // birthDate.setDate(isEmpty($('#birthDate').val()) ? new Date() : $('#birthDate').val());
    birthDate.set('maxDate', new Date());
    if ($('.departmentId').length) {
        $('.departmentId').select2({
            width: '100%',
        });
    }
    $('#createPharmacistForm, #editPharmacistForm').find('input:text:visible:first').focus();
}
    listenSubmit('#createPharmacistForm, #editPharmacistForm', function () {
        if ($('.error-msg').text() !== '') {
            $('.phoneNumber').focus();
            return false;
        }
    });
listenClick('.remove-pharmacist-image', function () {
    defaultImagePreview('.previewImage', 1);
});

