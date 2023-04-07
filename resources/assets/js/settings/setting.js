document.addEventListener('turbo:load', loadSettingData)

function loadSettingData() {
    if (!$('#generalCurrencyType').length) {
        return
    }
    $('#generalCurrencyType').select2({
        width: '100%',
    });
    initializeDefaultCountryCode()

}

function initializeDefaultCountryCode()
{
    let countryCode = $('#countryPhone');
    if (!countryCode.length) {
        return false;
    }

    let input = document.querySelector('#countryPhone')

// initialise plugin
    let intl = window.intlTelInput(input, {
        initialCountry: 'IN',
        separateDialCode: true,
        geoIpLookup: function (success, failure) {
            $.get('https://ipinfo.io', function () {}, 'jsonp').
                always(function (resp) {
                    let countryCode = (resp && resp.country)
                        ? resp.country
                        : ''
                    success(countryCode)
                })
        },
        utilsScript: '../../public/assets/js/inttel/js/utils.min.js',
    })
    let getCode = intl.selectedCountryData['name'] + ' +' + intl.selectedCountryData['dialCode']
    $('#countryPhone').val(getCode);

    let reset = function () {
        input.classList.remove('error');
    };

    // input.addEventListener('blur', function () {
    //     reset();
    //     if (input.value.trim()) {
    //         if (intl.isValidNumber()) {
    //             validMsg.classList.remove('d-none');
    //         } else {
    //             input.classList.add('error');
    //             let errorCode = intl.getValidationError()
    //             errorMsg.innerHTML = errorMap[errorCode];
    //             errorMsg.classList.remove('d-none');
    //         }
    //     }
    // });

// on keyup / change flag: reset
    input.addEventListener('change', reset);
    input.addEventListener('keyup', reset);


    $(document).on('blur keyup change countrychange','#countryPhone', function () {
        let getCode = intl.selectedCountryData['dialCode'];
        $('#countryCode').val(getCode);
    });
}


function updateSettingStatus(id) {
    $.ajax({
        url: $('#sideBarModuleUrl').val() + '/' + id + '/active-deactive',
        method: 'post',
        cache: false,
        success: function (result) {
            if (result.success) {
                setTimeout(function () {
                    window.location.reload();
                }, 5000);
                displaySuccessMessage(result.message);
                livewire.emit('refresh');
            }
        },
    });
};

function isValidSettingLogo(inputSelector, validationMessageSelector) {
    let ext = $(inputSelector).val().split('.').pop().toLowerCase();
    if ($.inArray(ext, ['jpg', 'png', 'jpeg']) == -1) {
        $(inputSelector).val('');
        $(validationMessageSelector).removeClass('d-none');
        $(validationMessageSelector).html('The image must be a file of type: jpg, jpeg, png.').show();
        return false;
    }
    $(validationMessageSelector).hide();
    return true;
};

function displaySettingLogo(input, selector) {
    let displayPreview = true;
    if (input.files && input.files[0]) {
        let reader = new FileReader();
        reader.onload = function (e) {
            let image = new Image();
            image.src = e.target.result;
            image.onload = function () {
                if (image.height != 60 && image.width != 90) {
                    $(selector).val('');
                    $('#generalValidationErrorsBox').removeClass('d-none');
                    $('#generalValidationErrorsBox').html($('#editGeneralImageValidation').val()).show();
                    return false;
                }
                $(selector).attr('src', e.target.result);
                displayPreview = true;
            };
        };
        if (displayPreview) {
            reader.readAsDataURL(input.files[0]);
            $(selector).show();
        }
    }
};

listenChange('#generalAppLogo', function () {
    $('#generalValidationErrorsBox').addClass('d-none');
    if (isValidSettingLogo($(this), '#generalValidationErrorsBox')) {
        displaySettingLogo(this, '#generalPreviewImage');
    }
});

listenKeyup('#generalFacebookUrl', function () {
    this.value = this.value.toLowerCase();
});
listenKeyup('#generalTwitterUrl', function () {
    this.value = this.value.toLowerCase();
});
listenKeyup('#generalInstagramUrl', function () {
    this.value = this.value.toLowerCase();
});
listenKeyup('#generalLinkedInUrl', function () {
    this.value = this.value.toLowerCase();
});

listenSubmit('#createSetting', function (event) {
    // event.preventDefault();

    if ($('.error-msg').text() !== '') {
        $('#generalPhoneNumber').focus();
        return false;
    }

    let facebookUrl = $('#generalFacebookUrl').val();
    let twitterUrl = $('#generalTwitterUrl').val();
    let instagramUrl = $('#generalInstagramUrl').val();
    let linkedInUrl = $('#generalLinkedInUrl').val();

    let facebookExp = new RegExp(
        /^(https?:\/\/)?((m{1}\.)?)?((w{2,3}\.)?)facebook.[a-z]{2,3}\/?.*/i);
    let twitterExp = new RegExp(
        /^(https?:\/\/)?((m{1}\.)?)?((w{2,3}\.)?)twitter\.[a-z]{2,3}\/?.*/i);
    let instagramUrlExp = new RegExp(
        /^(https?:\/\/)?((w{2,3}\.)?)instagram.[a-z]{2,3}\/?.*/i);
    let linkedInExp = new RegExp(
        /^(https?:\/\/)?((w{2,3}\.)?)linkedin\.[a-z]{2,3}\/?.*/i);

    let facebookCheck = (facebookUrl == '' ? true : (facebookUrl.match(
        facebookExp) ? true : false));
    if (!facebookCheck) {
        displayErrorMessage('Please enter a valid Facebook URL');
        return false;
    }
    let twitterCheck = (twitterUrl == '' ? true : (twitterUrl.match(twitterExp)
        ? true
        : false));
    if (!twitterCheck) {
        displayErrorMessage('Please enter a valid Twitter URL');
        return false;
    }
    let instagramCheck = (instagramUrl == '' ? true : (instagramUrl.match(
        instagramUrlExp) ? true : false));
    if (!instagramCheck) {
        displayErrorMessage('Please enter a valid Instagram URL');
        return false;
    }
    let linkedInCheck = (linkedInUrl == '' ? true : (linkedInUrl.match(
        linkedInExp) ? true : false));
    if (!linkedInCheck) {
        displayErrorMessage('Please enter a valid Linkedin URL');
        return false;
    }
    // $('#createSetting')[0].submit();

    return true;
});

listenChange('.settingStatus', function (event) {
    let moduleId = $(event.currentTarget).attr('data-id');
    updateSettingStatus(moduleId);
});


listenChange('#module_filter_status', function () {
    window.livewire.emit('changeFilter', 'statusFilter', $(this).val())
    hideDropdownManually($('#moduleFilterBtn'), $('#moduleFilter'));
});
listenClick('#settingResetFilter', function () {
    $('#module_filter_status').val(0).trigger('change');
    hideDropdownManually($('#moduleFilterBtn'), $('.dropdown-menu'));
});

