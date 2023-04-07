<!-- Start Navbar Area -->
@php
    $settingValue = getSettingValue();
@endphp
<header class="position-relative">
    <div class="container">
        <div class="row align-items-center">
        
            <div class="row-lg-1 col-4">
            
                <a href="{{ url('/') }}" class="header-logo">
                    <img src="{{ getLogoUrl() }}" alt="Infy HMS" class="img-fluid" /> <span class="row-lg-1 col-4" style="font-weight:bolder; font-size:20px">&nbsp EMB Diagnostic Laboratory Clinic-Delta </span>
                </a>
         
        
               
            </div>

            <div class="row-lg-11 col-8 ps-0">
                <nav class="navbar navbar-expand-xl navbar-light justify-content-end py-0">
                    <button class="navbar-toggler border-0 p-0" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                            aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                        <ul class="navbar-nav align-items-center py-2 py-lg-0">
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" aria-current="page" href="{{ url('/') }}">
                                    {{ __('messages.web_home.home') }}
                                </a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('our-services') ? 'active' : '' }}" href="{{ route('our-services') }}">
                                    {{ __('messages.web_home.services') }}
                                </a>
                            </li>
                            
                            <li class="nav-item">
                                <a href="{{ route('aboutUs') }}"
                                   class="nav-link {{ Request::is('about-us') ? 'active' : '' }}">{{ __('messages.web_menu.about') }}</a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('contact') }}"
                                   class="nav-link {{ Request::is('contact-us') ? 'active' : '' }}">{{ __('messages.web_home.contact') }}</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#" {{ Request::is('terms-of-service', 'privacy-policy') ? 'active' : '' }}>
                                    {{ __('messages.web_menu.our_features') }}
                                    <i class="fa-solid fa-angle-down ms-1"></i>
                                </a>
                                <ul class="nav submenu">
                                    
                                    <li class="nav-item ">
                                        <a class="nav-link {{ Request::is('working-hours') ? 'active' : '' }}" href="{{ route('working-hours') }}">
                                            {{ __('messages.web_menu.working_hours') }}
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ Request::is('testimonial') ? 'active' : '' }}" href="{{ route('testimonials') }}">
                                            {{ __('messages.web_home.testimonials') }}
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ Request::is('terms-of-service') ? 'active' : '' }}" href="{{ route('terms-of-service') }}">
                                            {{ __('messages.web_home.terms_of_service') }}
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ Request::is('privacy-policy') ? 'active' : '' }}" href="{{ route('privacy-policy') }}">
                                            {{ __('messages.web_home.privacy_policy') }}
                                        </a>
                                    </li>
                                </ul>
                            
                        </ul>
                        <div class="text-xl-end header-btn-grp ms-xl-3">
                            @if(Auth::user())
                                @role('Admin')
                                    <a href="{{ route('dashboard') }}"
                                       data-turbo="false"
                                       class="btn btn-success me-2 mb-3 mb-xl-0">{{ __('messages.dashboard.dashboard') }}
                                    </a>
                                @endrole 
                                @role('Patient')
                                    <a href="{{url('patient/my-cases') }}"
                                       data-turbo="false"
                                       class="btn btn-success me-2 mb-3 mb-xl-0">{{ __('messages.dashboard.dashboard') }}
                                    </a>
                                @endrole 
                                @role('Doctor')
                                    <a href="{{ url('employee/doctor') }}"
                                       data-turbo="false"
                                       class="btn btn-success me-2 mb-3 mb-xl-0">{{ __('messages.dashboard.dashboard') }}
                                    </a>
                                @endrole 
                                @role('Nurse')
                                    <a href="{{ url('bed-types') }}"
                                       data-turbo="false"
                                       class="btn btn-success me-2 mb-3 mb-xl-0">{{ __('messages.dashboard.dashboard') }}
                                    </a>
                                @endrole 
                                @role('Receptionist')
                                    <a href="{{ url('appointments') }}"
                                       data-turbo="false"
                                       class="btn btn-success me-2 mb-3 mb-xl-0">{{ __('messages.dashboard.dashboard') }}
                                    </a>
                                @endrole 
                                @role('Pharmacist')
                                    <a href="{{ url('employee/doctor') }}"
                                       data-turbo="false"
                                       class="btn btn-success me-2 mb-3 mb-xl-0">{{ __('messages.dashboard.dashboard') }}
                                    </a>
                                @endrole
                                @role('Secretary')
                                    <a href="{{ url('accounts') }}"
                                       data-turbo="false"
                                       class="btn btn-success me-2 mb-3 mb-xl-0">{{ __('messages.dashboard.dashboard') }}
                                    </a>
                                @endrole
                                @role('Case Manager')
                                    <a href="{{ url('employee/doctor') }}"
                                       data-turbo="false"
                                       class="btn btn-success me-2 mb-3 mb-xl-0">{{ __('messages.dashboard.dashboard') }}
                                    </a>
                                @endrole
                            @else
                                <a href="{{ route('login') }}"
                                   data-turbo="false"
                                        class="btn btn-success me-2 mb-3 mb-xl-0">
                                    {{ __('messages.web_menu.login') }}
                                </a>
                            @endif
                                
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>
<!-- End Navbar Area -->
