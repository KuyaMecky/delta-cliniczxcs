@extends('layouts.app')
@section('title')
    {{ __('messages.dashboard.dashboard') }}
    {{ __('messages.appointment.appointment_calendar') }}
@endsection
@section('page_css')
    {{--        <link rel="stylesheet" href="{{ asset('css/bootstrap-datetimepicker.css') }}">--}}
    {{--        <link rel="stylesheet" href="{{ asset('assets/css/daterangepicker.css') }}">--}}
    {{--<link href="{{ asset('vendor/fullcalendar/main.min.css') }}" rel="stylesheet" />--}}

@endsection
@section('css')
    {{--    <link rel="stylesheet" href="{{ asset('assets/css/detail-header.css') }}">--}}
@endsection
@section('content')

    <div class="container" style="margin-left:auto; margin-right:auto">
        <div class="d-flex flex-column">
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="row">
                        @if($modules['Invoices'] == true)
                            {{-- Invoices Widget --}}
                            <div class="col-xxl-4 col-xl-4 col-sm-4 widget">
                                <a class="text-decoration-none" href="{{ route('invoices.index') }}">
                                    <div class="bg-primary shadow-md rounded-10 p-xxl-10 px-5 py-10 d-flex align-items-center justify-content-between my-sm-3 my-2">
                                        <div class="bg-cyan-300 widget-icon rounded-10 me-2 d-flex align-items-center justify-content-center">
                                            <i class="fa-solid fa-money-check fs-1-xl text-white"></i>
                                        </div>
                                        <div class="text-end text-white">
                                            <h2 class="fs-1-xxl fw-bolder text-white">{{getCurrencySymbol()}} {{ formatCurrency($data['invoiceAmount']) }}</h2>
                                            <h3 class="mb-0 fs-5 fw-light">{{ __('messages.dashboard.total_invoices') }}</h3>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif
                        
                        @if($modules['Doctors'] == true)
                            {{-- Doctors Widget --}}
                            <div class="col-xxl-4 col-xl-4 col-sm-4 widget">
                                <a href="{{ route('doctors.index') }}" class="text-decoration-none">
                                    <div class="bg-secondary shadow-md rounded-10 p-xxl-10 px-5 py-10 d-flex align-items-center justify-content-between my-sm-3 my-2">
                                        <div class="bg-gray-600 widget-icon rounded-10 me-2 d-flex align-items-center justify-content-center">
                                            <i class="fa-solid fa-user fs-1-xl text-white"></i>
                                        </div>
                                        <div class="text-end text-white">
                                            <h2 class="fs-1-xxl fw-bolder text-white">{{ $data['doctors'] }}</h2>
                                            <h3 class="mb-0 fs-5 fw-light">{{ __('messages.dashboard.doctors') }}</h3>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif
                        @if($modules['Patients'] == true)
                            {{-- Patients Widget --}}
                            <div class="col-xxl-4 col-xl-4 col-sm-4 widget">
                                <a href="{{ route('patients.index') }}" class="text-decoration-none">
                                    <div class="bg-danger shadow-md rounded-10 p-xxl-10 px-5 py-10 d-flex align-items-center justify-content-between my-sm-3 my-2">
                                        <div class="bg-red-300 widget-icon rounded-10 me-2 d-flex align-items-center justify-content-center">
                                            <i class="fa-solid fa-user fs-1-xl text-white"></i>
                                        </div>
                                        <div class="text-end text-white">
                                            <h2 class="fs-1-xxl fw-bolder text-white">{{ $data['patients'] }}</h2>
                                            <h3 class="mb-0 fs-5 fw-light">{{ __('messages.dashboard.patients') }}</h3>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif
                </div>
                
    <!--DITO SI CALENDAR-->
        <div class="container-fluid">
            <div class="d-flex flex-column livewire-table">
                <div class="row">
                    <div class="col-12">
                        @include('layouts.errors')
                    </div>
                </div>
            <div class="card">
                {{ Form::hidden('todayText', __('messages.appointment.today'), ['id' => 'todayText']) }}
                {{ Form::hidden('weekText', __('messages.appointment.week'), ['id' => 'weekText']) }}
                {{ Form::hidden('monthText', __('messages.appointment.month'), ['id' => 'monthText']) }}
                {{ Form::hidden('dayText', __('messages.appointment.day'), ['id' => 'dayText']) }}
                {{ Form::hidden('doctorScheduleList', url('doctor-schedule-list'), ['id' => 'doctorScheduleList']) }}
                {{ Form::hidden('calenderAppointmentSaveUrl', route('appointments.store'), ['id' => 'calenderAppointmentSaveUrl']) }}
                {{ Form::hidden('calenderIndexPage', route('appointment-calendars.index'), ['id' => 'calenderIndexPage']) }}
                {{ Form::hidden('getBookingSlot', route('get.booking.slot'), ['id' => 'getBookingSlot']) }}
                {{ Form::hidden('userRole', Auth::user()->hasRole('Doctor'), ['id' => 'userRole']) }}
                {{ Form::hidden('isCreate', true, ['class' => 'isCreate']) }}
                {{ Form::hidden('getLanguage',getCurrentLoginUserLanguageName(), ['class' => 'getLanguage']) }}
                {{ Form::hidden('isDoctor', (Auth::user()->hasRole('Doctor'))? 1 :0 , ['id' => 'isDoctor']) }}
                <div class="card-body">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>
    <br>
                <div class="col-xxl-5 col-12">
                    <div class="card">
                        <div class="card-header pb-0 px-10">
                            <h3 class="mb-0">
                                {{ __('messages.dashboard.notice_boards') }}
                            </h3>
                        </div>
                        <div class="card-body pt-7 pb-2">
                            @if(count($data['noticeBoards']) > 0)
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th scope="col">{{ __('messages.dashboard.title') }}</th>
                                        <th scope="col" class="text-center">{{ __('messages.common.created_on') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody class="text-gray-600 fw-bold">
                                    @foreach($data['noticeBoards'] as $noticeBoard)
                                        <tr>
                                            <td>
                                                <a href="javascript:void(0)" data-id="{{$noticeBoard->id}}"
                                                   class="text-decoration-none notice-board-view-btn">{{ Str::limit($noticeBoard->title, 32,'...') }}</a>
                                            </td>
                                            <td class="text-center">
                                                        <span class="badge bg-light-info">
                                                            {{ \Carbon\Carbon::parse($noticeBoard->created_at)->translatedFormat('jS M, Y') }}
                                                        </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <h2 class="mb-0 text-center fs-2">No Notice Boards yet..</h2>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            {{-- Income & Expense Chart--}}
            {{--            <div class="row">--}}
            {{--                <div class="col-lg-12">--}}
            {{--                    <div class="card">--}}
            {{--                        <div class="card-body">--}}
            {{--                            <div class="row justify-content-between">--}}
            {{--                                <div class="col-sm-6 col-md-6 col-lg-6 pt-2">--}}
            {{--                                    <h5>{{ __('messages.dashboard.income_and_expense_report') }}</h5>--}}
            {{--                                </div>--}}
            {{--                                <div class="col-md-3">--}}
            {{--                                    <div id="time_range" class="time_range d-flex">--}}
            {{--                                        <i class="far fa-enquiries-alt"--}}
            {{--                                           aria-hidden="true"></i>&nbsp;&nbsp;<span></span>--}}
            {{--                                        <b class="caret"></b>--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                            <div class="table-responsive-sm">--}}
            {{--                                <div class="pt-2">--}}
            {{--                                    <canvas id="daily-work-report" class="mh-400px"></canvas>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </div>--}}

            {{Form::hidden('incomeExpenseReportUrl',route('income-expense-report'),['id'=>'dashboardIncomeExpenseReportUrl','class'=>'incomeExpenseReportUrl'])}}
            {{Form::hidden('currentCurrencyName',getCurrencySymbol(),['id'=>'dashboardCurrentCurrencyName','class'=>'currentCurrencyName'])}}
            {{--                        {{Form::hidden('currencies',json_encode($data['currency']),['id'=>'createBillDate','class'=>'currencies'])}}--}}
            {{Form::hidden('income_and_expense_reports',__('messages.dashboard.income_and_expense_reports'),['id'=>'dashboardIncome_and_expense_reports','class'=>'income_and_expense_reports'])}}
            {{Form::hidden('defaultAvatarImageUrl',asset('assets/img/avatar.png'),['id'=>'dashboardDefaultAvatarImageUrl','class'=>'defaultAvatarImageUrl'])}}
            {{Form::hidden('noticeBoardUrl',url('notice-boards'),['id'=>'dashboardNoticeBoardUrl','class'=>'noticeBoardUrl'])}}

        </div>
        @include('employees.notice_boards.show_modal')
    </div>
    
@endsection

{{--    <script src="{{mix('assets/js/dashboard/dashboard.js')}}"></script>--}}
{{--    <script src="{{mix('assets/js/custom/input_price_format.js')}}"></script>--}}
{{--<script src="{{ asset('vendor/fullcalendar/main.min.js') }}"></script>--}}
{{--<script src="{{ asset('vendor/fullcalendar/locales-all.min.js') }}"></script>--}}
@section('scripts')
    {{--  assets/js/appointment_calendar/appointment_calendar.js --}}
@endsection
