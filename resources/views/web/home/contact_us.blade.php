@extends('web.layouts.front')
@section('title')
    {{ __('messages.contact_us') }}
@endsection
@section('page_css')
{{--    <link rel="stylesheet" href="{{ mix('web_front/css/contact.css') }}">--}}
@endsection
@php
    $enquiry = request()->query('enquiry');
    $settingValue = getSettingValue();
@endphp
@section('content')

    <div class="contact-page">
        <!-- start hero section -->
        <section
                class="hero-section position-relative p-t-10 border-bottom-right-rounded border-bottom-left-rounded bg-gray overflow-hidden">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 text-lg-start text-center">
                        <div class="hero-content">
                            <h1 class="mb-3 pb-1">
                                {{ __('messages.web_home.contact') }}
                            </h1>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb justify-content-lg-start justify-content-center mb-lg-0 mb-5">
                                    <li class="breadcrumb-item">
                                        <a href="{{ url('/') }}">{{ __('messages.web_home.home') }}</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        {{ __('messages.web_home.contact') }}
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="col-lg-6 text-lg-end text-center">
                        <img src="{{ asset('web_front/images/page-banner/Contact.png') }}" alt="Infy Care" class="img-fluid" />
                    </div>
                </div>
            </div>
        </section>
        <!-- end hero section -->

        <!-- start service-section -->
        <section class="information-section p-t-75 p-b-110">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-md-6 information-block d-flex align-items-stretch">
                        <div class="card text-center mx-lg-2 flex-fill">
                            <div class="icon-information-box d-flex align-items-center justify-content-center mx-auto">
                                <i class="fa-solid fa-phone fs-3"></i>
                            </div>
                            <div class="card-body text-center d-flex flex-column">
                                <a href="tel:{{ $settingValue['hospital_phone']['value'] }}" class="text-decoration-none fs-5 text-success my-2">
                                    {{ $settingValue['hospital_phone']['value'] }}
                                </a>
                                <span class="text-secondary fw-light">{{ __('messages.web_contact.call_today') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 information-block d-flex align-items-stretch">
                        <div class="card text-center mx-lg-2 flex-fill">
                            <div class="icon-information-box d-flex align-items-center justify-content-center mx-auto">
                                <i class="fa-solid fa-envelope fs-3"></i>
                            </div>
                            <div class="card-body text-center d-flex flex-column">
                                <a href="mailto:{{ $settingValue['hospital_email']['value'] }}"
                                   class="text-decoration-none fs-5 text-success my-2">
                                {{ $settingValue['hospital_email']['value'] }}
                                </a>
                                <span class="text-secondary fw-light">{{ __('messages.web_home.contact_hospital') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 information-block d-flex align-items-stretch">
                        <div class="card text-center mx-lg-2 flex-fill">
                            <div class="icon-information-box d-flex align-items-center justify-content-center mx-auto">
                                <i class="fa-solid fa-clock fs-3"></i>
                            </div>
                            <div class="card-body text-center d-flex flex-column">
                                <p class="fs-5 text-success fw-normal my-2">
                                    {{ $settingValue['hospital_from_time']['value'] }}
                                </p>
                                <span class="text-secondary fw-light">{{ __('messages.web_contact.open_hours') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 information-block d-flex align-items-stretch">
                        <div class="card text-center mx-lg-2 flex-fill">
                            <div class="icon-information-box d-flex align-items-center justify-content-center mx-auto">
                                <i class="fa-solid fa-location-dot fs-3"></i>
                            </div>
                            <div class="card-body text-center d-flex flex-column">
                                <p class="fs-5 text-success fw-normal my-2">
                                    {{ $settingValue['hospital_address']['value'] }}
                                </p>
                                <span class="text-secondary fw-light">{{ __('messages.web_contact.our_location') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 text-center">
                    <div class="btn-group mt-4 mt-xl-5">
                        @if($settingValue['facebook_url']['value'] != '' && !empty($settingValue['facebook_url']['value']))
                            <a href="{{ $settingValue['facebook_url']['value'] }}" target="_blank" class="btn btn-primary fs-4">
                                <i class="fa-brands fa-facebook"></i>
                            </a>
                        @endif
                        @if($settingValue['twitter_url']['value'] != '' && !empty($settingValue['twitter_url']['value']))
                            <a href="{{ $settingValue['twitter_url']['value'] }}" target="_blank" class="btn btn-primary fs-4">
                                <i class="fa-brands fa-twitter"></i>
                            </a>
                        @endif
                        @if($settingValue['instagram_url']['value'] != '' && !empty($settingValue['instagram_url']['value']))
                            <a href="{{ $settingValue['instagram_url']['value'] }}" target="_blank" class="btn btn-primary fs-4">
                                <i class="fa-brands fa-instagram"></i>
                            </a>
                        @endif
                        @if($settingValue['linkedIn_url']['value'] != '' && !empty($settingValue['linkedIn_url']['value']))
                            <a href="{{ $settingValue['linkedIn_url']['value'] }}" target="_blank" class="btn btn-primary fs-4">
                                <i class="fa-brands fa-linkedin-in"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </section>
        <!-- end service-section -->

        
    </div>
    
@endsection
@section('page_scripts')
    <script src='https://www.google.com/recaptcha/api.js'></script>
    {{--    <script src="{{ asset('assets/js/int-tel/js/intlTelInput.min.js') }}"></script>--}}
    {{--    <script src="{{ asset('assets/js/int-tel/js/utils.min.js') }}"></script>--}}
    {{--    <script src="{{ mix('assets/js/custom/phone-number-country-code.js') }}"></script>--}}
    {{--    <script src="{{ mix('assets/js/custom/custom.js') }}"></script>--}}
    {{--    <script src="{{ mix('assets/js/front_settings/contact_us.js') }}"></script>--}}
@endsection
