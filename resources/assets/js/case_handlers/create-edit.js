'use strict';

document.addEventListener('turbo:load', loadCaseHandlersCreateEdit)

function loadCaseHandlersCreateEdit () {

    if ($('#createCaseHandlerForm').length || $('#editCaseHandlerForm').length) {

        const caseHandlerBirthDateElement = $('#caseHandlerBirthDate')
        const editCaseHandlerBirthDateElement = $('#editCaseHandlerBirthDate')
        const createCaseHandlerFormElement = $('#createCaseHandlerForm')
        const editCaseHandlerFormElement = $('#editCaseHandlerForm')

        if(caseHandlerBirthDateElement.length){
            $('#caseHandlerBirthDate').flatpickr({
                maxDate: new Date(),
                locale : $('.userCurrentLanguage').val(),
            });
        }

        if(editCaseHandlerBirthDateElement.length){
            $('#editCaseHandlerBirthDate').flatpickr({
                maxDate: new Date(),
                locale : $('.userCurrentLanguage').val(),
            });
        }

        if (createCaseHandlerFormElement.length){
            $('#createCaseHandlerForm').
                find('input:text:visible:first').
                focus();
        }

        if (editCaseHandlerFormElement.length){
            $('#editCaseHandlerForm').
                find('input:text:visible:first').
                focus();
        }


    }else{

        return false;

    }

}

listenSubmit('#createCaseHandlerForm, #editCaseHandlerForm', function () {
    if ($('.error-msg').text() !== '') {
        $('.phoneNumber').focus();
        return false;
    }
});

listenClick('.case-andler-remove-image', function () {
    defaultImagePreview('.previewImage', 1);
});
