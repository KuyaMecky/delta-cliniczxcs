@extends('web.layouts.front')
@section('title')
    {{ __('web.home') }}
@endsection
@section('content')
    <div class="home-page">
        <!-- start hero section -->
        <section
                class="hero-section position-relative p-t-75 p-b-75 border-bottom-right-rounded border-bottom-left-rounded bg-gray"
                id="div1">
            <div class="container">
                <div class="row align-items-center flex-column-reverse flex-lg-row">
                    <div class="col-lg-6 text-lg-start text-center">
                        <div class="hero-content mt-5 mt-lg-0">
                            <h6 class="text-primary mb-3">{{ $frontSetting['home_page_experience'] }} {{ __('messages.web_home.years_experience') }}</h6>
                            <h1 class="mb-3 pb-1">
                                {{ \Illuminate\Support\Str::limit($frontSetting['home_page_title'], 42) }}
                            </h1>
                            <p class="mb-lg-4 pb-lg-3 mb-4">
                                {{ \Illuminate\Support\Str::limit($frontSetting['home_page_description'], 170) }}</p>
                            @if(!Auth::user())
                                <a href="{{ route('register') }}"
                                   class="btn btn-primary" data-turbo="false">{{ __('messages.web_home.sign_up') }}</a>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6 text-lg-end text-center">
                        <img src="{{ !empty($frontSetting['home_page_image']) ? $frontSetting['home_page_image'] : asset('web_front/images/main-banner/banner-one/Home.png') }}"
                             alt="Infy Care" class="img-fluid"/>
                    </div>
                </div>
            </div>
        </section>
        <!-- end hero section -->

        <!-- start easy-solution section -->
        <section class="easy-solution-section position-relative">
            <div class="container">
                <div class="col-lg-6 text-center mx-auto">
                    <h6 class="text-primary pb-2">{{ __('messages.web_home.easy_solutions') }}</h6>
                    <h2 class="mb-4 pb-4">{{ __('messages.web_home.4_easy_step_and_get_the_world_best_treatment') }}</h2>
                </div>
                <div class="easy-solution-cards">
                    <div class="row justify-content-between">
                        <div class="col-xxl-3 col-md-6 text-center solution-card mb-xxl-0 mb-4">
                            <div class="card">
                                <div class="icon-box mx-auto br-5 mb-4 d-flex align-items-center justify-content-center">
                                    <i class="fa-solid fa-user fs-5"></i>
                                </div>
                                <div class="card-body p-0 text-center">
                                    <h4>{{ \Illuminate\Support\Str::limit($frontSetting['home_page_step_1_title'], 22) }}</h4>
                                    <p class="mb-0">
                                        {{ \Illuminate\Support\Str::limit($frontSetting['home_page_step_1_description'], 114) }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-6 text-center solution-card mb-xxl-0 mb-4">
                            <div class="card">
                                <div class="icon-box mx-auto br-5 mb-4 d-flex align-items-center justify-content-center">
                                    <i class="fa-solid fa-headphones-simple fs-5"></i>
                                </div>
                                <div class="card-body p-0 text-center">
                                    <h4>{{ \Illuminate\Support\Str::limit($frontSetting['home_page_step_2_title'], 22) }}</h4>
                                    <p class="mb-0">
                                        {{ \Illuminate\Support\Str::limit($frontSetting['home_page_step_2_description'], 114) }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-xxl-3 col-md-6 text-center solution-card mb-xxl-0 mb-4">
                            <div class="card">
                                <div class="icon-box mx-auto br-5 mb-4 d-flex align-items-center justify-content-center">
                                    <i class="fa-solid fa-calendar-check fs-5"></i>
                                </div>
                                <div class="card-body p-0 text-center">
                                    <h4>{{ \Illuminate\Support\Str::limit($frontSetting['home_page_step_3_title'], 22) }}</h4>
                                    <p class="mb-0">
                                        {{ \Illuminate\Support\Str::limit($frontSetting['home_page_step_3_description'], 114) }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-6 text-center solution-card mb-xxl-0 mb-lg-4">
                            <div class="card">
                                <div class="icon-box mx-auto br-5 mb-4 d-flex align-items-center justify-content-center">
                                    <i class="fa-solid fa-check-double fs-5"></i>
                                </div>
                                <div class="card-body p-0 text-center">
                                    <h4>{{ \Illuminate\Support\Str::limit($frontSetting['home_page_step_4_title'], 22) }}</h4>
                                    <p class="mb-0">
                                        {{ \Illuminate\Support\Str::limit($frontSetting['home_page_step_4_description'], 114) }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end easy-solution section -->

        <!-- start service-section -->
        <section class="service-section p-t-120 p-b-100 bg-gray">
            <div class="container">
                <div class="col-lg-6 text-center mx-auto">
                    <h6 class="text-primary mb-3">{{ __('messages.web_home.our_services') }}</h6>
                    <h2 class="mb-4 pb-xl-4">
                        {{ __('messages.web_home.we_offer_different_services_to_improve_your_health') }}
                    </h2>
                </div>
                <div class="our-service">
                    <div class="row justify-content-center">
                        @foreach($frontServices  as $frontService)
                            <div class="col-xl-3 col-lg-4 col-md-6 py-lg-2 card-hover d-flex align-items-stretch">
                                <div class="card p-c-4 my-lg-2 mx-lg-1 my-md-3 my-2 flex-fill">
                                    <img src="{{ isset($frontService->icon_url) ? $frontService->icon_url : asset('web_front/images/services/medicine.png') }}"
                                         class="card-img-top img-wh mx-auto " alt="Cardiology">
                                    <div class="card-body p-0 text-center flex-column">
                                        <h4 class="card-title mt-4">{{ \Illuminate\Support\Str::limit($frontService->name, 16) }}</h4>
                                        <p class="card-text">{{ \Illuminate\Support\Str::limit($frontService->short_description, 123) }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        <!-- end service-section -->

       
    </div>
@endsection
