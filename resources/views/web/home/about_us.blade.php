@extends('web.layouts.front')
@section('title')
    {{ __('messages.about_us') }}
@endsection
@section('page_css')
{{--    <link rel="stylesheet" href="{{ mix('web_front/css/about.css') }}">--}}
@endsection
@section('content')

    <div class="about-page">
        <!-- start hero section -->
        <section
                class="hero-section position-relative p-t-10 border-bottom-right-rounded border-bottom-left-rounded bg-gray overflow-hidden">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 text-lg-start text-center">
                        <div class="hero-content">
                            <h1 class="mb-3 pb-1">
                                {{ __('messages.web_home.about_us') }}
                            </h1>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb justify-content-lg-start justify-content-center mb-lg-0 mb-5">
                                    <li class="breadcrumb-item">
                                        <a href="{{ url('/') }}">{{ __('messages.web_home.home') }}</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">{{ __('messages.web_home.about_us') }}</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="col-lg-6 text-lg-end text-center">
                        <img src="{{ asset('web_front/images/page-banner/About.png') }}" alt="Infy Care" class="img-fluid" />
                    </div>
                </div>
            </div>
        </section>
        <!-- end hero section -->

        <!--start about-section -->
        <section class="about-section p-t-75 p-b-120">
            <div class="container">
                <div class="row align-items-stretch flex-column-reverse flex-lg-row">
                    <div class="col-lg-6 col-md-12">
                        <div class="row h-100">
                        <div>
                            <iframe style="border-radius:50px;border:0; width: 100%; height: 500px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3862.2615713921004!2d121.15214961481777!3d14.527025089849376!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397c6c6c9ad7727%3A0x49b39369b17e4627!2sDelta%20Diagnostic%20Clinic!5e0!3m2!1sen!2sph!4v1668509822024!5m2!1sen!2sph" frameborder="0" allowfullscreen></iframe>
                        </div>
                            
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <br>
                        <div class="about-right pb-5 pt-lg-5 text-lg-start text-center">
                            <h2 class="mt-md-3">{{ \Illuminate\Support\Str::limit($frontSetting['about_us_title'], 50)  }}</h2>
                            <p class="mt-4">{!! \Illuminate\Support\Str::limit($frontSetting['about_us_description'], 615)  !!}</p>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- end about-section -->
    </div>
    
@endsection
