'use strict';

document.addEventListener('turbo:load', loadAccountantCreateEdit)

function loadAccountantCreateEdit () {
    
    if ($('#createAccountantForm').length || $('#editAccountantForm').length) {
        
        const bloodGroupElement = $('#bloodGroup')
        const birthDateElement = $('#birthDate')
        const createAccountantForm = $('#createAccountantForm')
        const editAccountantForm = $('#editAccountantForm')
        

        if (birthDateElement.length) {
            $('#birthDate').flatpickr({
                format: 'YYYY-MM-DD',
                useCurrent: true,
                sideBySide: true,
                maxDate: new Date(),
                locale : $('.userCurrentLanguage').val(),
            });
        }

        if (createAccountantForm.length) {
            createAccountantForm.find('input:text:visible:first').focus();
        }

        if (editAccountantForm.length) {
            editAccountantForm.find('input:text:visible:first').focus();
        }

        if (bloodGroupElement.length) {
            $('#bloodGroup').select2({
                width: '100%',
            })
        }
        
    }else{

        return false;
        
    }
 
}

listenClick('.remove-accountant-image', function () {
    defaultImagePreview('#previewImage', 1);
});

listenSubmit('#createAccountantForm, #editAccountantForm', function () {
    if ($('.error-msg').text() !== '') {
        $('#phoneNumber').focus();
        return false;
    }
});
