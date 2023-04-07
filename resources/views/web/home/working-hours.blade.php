@extends('web.layouts.front')
@section('title')
    {{ __('messages.web_home.working_hours') }}
@endsection
@section('page_css')
{{--    <link rel="stylesheet" href="{{ mix('web_front/css/working-hours.css') }}">--}}
@endsection
@section('content')

    <div class="working-hours-page">
        <!-- start hero section -->
        <section
                class="hero-section position-relative p-t-10 border-bottom-right-rounded border-bottom-left-rounded bg-gray overflow-hidden">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 text-lg-start text-center">
                        <div class="hero-content">
                            <h1 class="mb-3 pb-1">
                                {{ __('messages.web_home.working_hours') }}
                            </h1>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb justify-content-lg-start justify-content-center mb-lg-0 mb-5">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('front') }}">{{ __('messages.web_home.home') }}</a>    
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        {{ __('messages.web_home.working_hours') }}
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="col-lg-6 text-lg-end text-center">
                        <img src="{{ asset('web_front/images/page-banner/working-hours.png') }}" alt="Infy Care" class="img-fluid" />
                    </div>
                </div>
            </div>
        </section>
        <!-- end hero section -->

        <!--start opening-hours section-->
        <section class="opening-hours-section bg-gray p-t-75 p-b-100">
            <div class="container">
                <h2 class="text-center mb-5 pb-xl-3 mt-5 pt-4 pt-xl-0">
                    {{ __('messages.web_working_hours.opening_hours') }}
                </h2>
                <div class="row justify-content-center">
                    <div class="col-xl-6 col-lg-8">
                        @if(count($hospitalSchedules))
                            @foreach($hospitalSchedules as $hospitalSchedule)
                                <div class="bg-white d-flex align-items-center justify-content-between opening-hours-card fs-5">
                                    <label class="text-success">{{$weekDay[$hospitalSchedule->day_of_week]}} :</label>
                                    <span class="text-secondary fw-light">
                                        {{ $hospitalSchedule->start_time.' - '.$hospitalSchedule->end_time  }}
                                    </span>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </section>
        <!--end opening-hours section-->
    </div>
@endsection
