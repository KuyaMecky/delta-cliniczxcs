document.addEventListener('turbo:load', loadLabTechnicianData)

function loadLabTechnicianData() {
    if (!$('#createLabTechnicianForm').length && !$('#editLabTechnicianForm').length) {
        return
    }

    $('#technicianBloodGroup').select2({
        width: '100%',
    });
    $('#editTechnicianBloodGroup').select2({
        width: '100%',
    });
    $('.departmentId').select2({
        width: '100%',
    });
    let birthDate = $('.technicianBirthDate').flatpickr({
        dateFormat: 'Y-m-d',
        useCurrent: false,
        locale : $('.userCurrentLanguage').val(),
    });
    birthDate.set('maxDate', new Date());
}
    listenSubmit('#createLabTechnicianForm, #editLabTechnicianForm', function () {
        if ($('.error-msg').text() !== '') {
            $('.phoneNumber').focus();
            return false;
        }
    });
    $('#createLabTechnicianForm, #editLabTechnicianForm').find('input:text:visible:first').focus();

listenChange('.removeTechnicianImage', function () {
    let extension = isValidOpdTimelineDocument($(this), '.alert');
    if (!isEmpty(extension) && extension != false) {
        $('.alert').html('').hide();
        displayDocument(this, '.previewImage', extension);
    }
});

