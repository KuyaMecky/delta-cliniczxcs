document.addEventListener('turbo:load', loadNurseData)

function loadNurseData() {
    if (!$('#createNurseForm').length && !$('#editNurseForm').length) {
        return
    }

    $('#nurseBloodGroup').select2({
        width: '100%',
    });
    $('#editNurseBloodGroup').select2({
        width: '100%',
    });
    $('.nurseBirthDate').flatpickr({
        format: 'YYYY-MM-DD',
        useCurrent: true,
        sideBySide: true,
        maxDate: new Date(),
        locale : $('.userCurrentLanguage').val(),
    });
    $('#departmentId').select2({
        width: '100%',
    });
    $('#createNurseForm, #editNurseForm').find('input:text:visible:first').focus();

}

listenSubmit('#createNurseForm, #editNurseForm', function () {
    if ($('.error-msg').text() !== '') {
        $('.phoneNumber').focus();
        return false;
    }
});

listenChange('.removeNurseImage', function () {
    let extension = isValidOpdTimelineDocument($(this), '.alert');
    if (!isEmpty(extension) && extension != false) {
        $('.alert').html('').hide();
        displayDocument(this, '.nursePreviewImage', extension);
    }
});

window.isValidOpdTimelineDocument = function (
    inputSelector, validationMessageSelector) {
    let ext = $(inputSelector).val().split('.').pop().toLowerCase();
    if ($.inArray(ext, ['png', 'jpg', 'jpeg', 'pdf', 'doc', 'docx']) == -1) {
        $(inputSelector).val('');
        $(validationMessageSelector).html(
            'The document must be a file of type: jpeg, jpg, png, pdf, doc, docx.').show();
        return false;
    }
    return ext;
};
