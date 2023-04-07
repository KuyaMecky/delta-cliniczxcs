@php($modules = App\Models\Module::cacheFor(now()->addDays())->toBase()->get())
{{--<div class="position-relative mb-5 mx-3 mt-2 sidebar-search-box">--}}
{{--    <span class="svg-icon svg-icon-1 svg-icon-primary position-absolute top-50 translate-middle ms-9">--}}
{{--                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"--}}
{{--                                                                 height="24" viewBox="0 0 24 24" fill="none">--}}
{{--                                                                <rect opacity="0.5" x="17.0365" y="15.1223"--}}
{{--                                                                      width="8.15546" height="2" rx="1"--}}
{{--                                                                      transform="rotate(45 17.0365 15.1223)"--}}
{{--                                                                      fill="black"></rect>--}}
{{--                                                                <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"--}}
{{--                                                                      fill="black"></path>--}}
{{--                                                            </svg>--}}
{{--                                                        </span>--}}
{{--    <input type="text" class="form-control form-control-lg  ps-15" id="menuSearch" name="search"--}}
{{--           value="" placeholder="Search" style="background-color: #2A2B3A;border: none;color: #FFFFFF"--}}
{{--           autocomplete="off">--}}
{{--</li>--}}
{{--<div class="no-record text-white text-center d-none">No matching records found</li>--}}
@role('Admin')
{{--Dashboard--}}
<li class="nav-item {{ Request::is('dashboard*') ? 'active' : '' }}">
    <a class="nav-link  d-flex align-items-center py-3" href="{{ route('dashboard') }}">
        <span class="aside-menu-icon pe-3 pe-3">
            <i class="fas fa-chart-pie"></i>
		</span>
        <span class="aside-menu-title">{{ __('messages.dashboard.dashboard') }}</span>
    </a>
</li>

{{--Admin--}}
@module('Admin',$modules)
<li class="nav-item  {{ Request::is('admins*') ? 'active' : '' }}">
    <a class="nav-link  d-flex align-items-center py-3"
       href="{{ route('admins.index') }}">
        <span class="aside-menu-icon pe-3 pe-3"><i class="fas fa-user"></i></span>
        <span class="aside-menu-title">{{ __('messages.admin') }}</span>
    </a>
</li>
@endmodule

{{--Accountantants--}}
@module('Accountants',$modules)
<li class="nav-item  {{ Request::is('accountants*') ? 'active' : '' }}">
    <a class="nav-link  d-flex align-items-center py-3"
       href="{{ route('accountants.index') }}">
        <span class="aside-menu-icon pe-3 pe-3"><i class="fas fa-file-invoice"></i></span>
        <span class="aside-menu-title">{{ __('messages.accountants') }}</span>
    </a>
</li>
@endmodule

{{--Appointments--}}
@module('Appointments',$modules)
<li class="nav-item {{ Request::is('appointment*') ? 'active' : '' }}">
    <a class="nav-link  d-flex align-items-center py-3"
       href="{{ route('appointments.index') }}">
        <span class="aside-menu-icon pe-3 pe-3"><i class="fas fa-calendar-check"></i></span>
        <span class="aside-menu-title">{{ __('messages.appointments') }}</span>
    </a>
</li>
@endmodule

{{-- Billing --}}
<?php
$billingMGT = getMenuLinks(\App\Models\User::MAIN_BILLING_MGT)
?>
@if ($billingMGT)
    <li class="nav-item  {{ Request::is('accounts*','employee-payrolls*','invoices*','payments*','payment-reports*','advanced-payments*','bills*') ? 'active' : '' }}">
        <a class="nav-link  d-flex align-items-center py-3"
           href="{{ $billingMGT }}">
            <span class="aside-menu-icon pe-3 pe-3"><i class="fas fa-file-invoice-dollar"></i></span>
            <span class="aside-menu-title">{{ __('messages.billing') }}</span>
            <span class="d-none">{{__('messages.employee_payrolls')}}</span>
            <span class="d-none">{{__('messages.invoices')}}</span>
            <span class="d-none">{{__('messages.payments')}}</span>
            <span class="d-none">{{__('messages.payment_reports')}}</span>
            <span class="d-none">{{__('messages.advanced_payments')}}</span>
            <span class="d-none">{{__('messages.bills')}}</span>
        </a>
    </li>
@endif


{{--Documents Mgt--}}
<?php
$documentMGT = getMenuLinks(\App\Models\User::MAIN_DOCUMENT)
?>
@if ($documentMGT)
    <li class="nav-item {{ Request::is('documents*','document-types*') ? 'active' : '' }}">
        <a class="nav-link  d-flex align-items-center py-3"
           href="{{ $documentMGT }}">
            <span class="aside-menu-icon pe-3 pe-3"><i class="fas fa-file"></i></span>
            <span class="aside-menu-title">{{ __('messages.documents') }}</span>
            <span class="d-none">{{__('messages.document_types')}}</span>
        </a>
    </li>
@endif

{{-- Doctors dropdown --}}
<?php
$doctorMGT = getMenuLinks(\App\Models\User::MAIN_DOCTOR)
?>
@if ($doctorMGT)
    <li class="nav-item  {{ Request::is('doctors*','doctor-departments*','schedules*','prescriptions*') ? 'active' : '' }}">
        <a class="nav-link  d-flex align-items-center py-3"
           href="{{ $doctorMGT }}">
            <span class="aside-menu-icon pe-3 pe-3"><i class="fa fa-user-md"></i></span>
            <span class="aside-menu-title">{{ __('messages.doctors') }}</span>
            <span class="d-none">{{__('messages.doctor_departments')}}</span>
            <span class="d-none">{{__('messages.schedules')}}</span>
            <span class="d-none">{{__('messages.prescriptions')}}</span>
        </a>
    </li>
@endif

{{--Diagnosis Test--}}
<?php
$diagnosisMGT = getMenuLinks(\App\Models\User::MAIN_DIAGNOSIS)
?>
@if ($diagnosisMGT)
    <li class="nav-item  {{ Request::is('diagnosis-categories*','patient-diagnosis-test*') ? 'active' : '' }}">
        <a class="nav-link  d-flex align-items-center py-3"
           href="{{ $diagnosisMGT }}">
                                                    <span class="aside-menu-icon pe-3 pe-3"><i
                                                                class="fas fa-diagnoses"></i></span>
            <span class="aside-menu-title">{{ __('messages.patient_diagnosis_test.diagnosis') }}</span>
            <span class="d-none">{{ __('messages.patient_diagnosis_test.diagnosis_category') }}</span>
            <span class="d-none">{{ __('messages.patient_diagnosis_test.diagnosis_test') }}</span>
        </a>
    </li>
@endif


{{-- Front settings --}}
<li class="nav-item {{ Request::is('front-settings*','notice-boards*','testimonials*', 'front-cms-services*') ? 'active' : '' }}">
    <a class="nav-link  d-flex align-items-center py-3"
       href="{{ route('front.settings.index') }}">
                                                                        <span class="aside-menu-icon pe-3 pe-3"><i
                                                                                    class="fas fa fa-cog"></i></span>
        <span class="aside-menu-title">{{ __('messages.front_cms') }}</span>
        <span class="d-none">{{ __('messages.notice_boards') }}</span>
        <span class="d-none">{{ __('messages.testimonials') }}</span>
        <span class="d-none">{{ __('messages.cms') }}</span>
        <span class="d-none">{{ __('messages.front_cms_services') }}</span>
    </a>
</li>

{{--MedTech--}}
@module('Lab Technicians',$modules)
<li class="nav-item  {{ Request::is('lab-technicians*') ? 'active' : '' }}">
    <a class="nav-link  d-flex align-items-center py-3"
       href="{{ route('lab-technicians.index') }}">
                                                                                        <span class="aside-menu-icon pe-3 pe-3"><i
                                                                                                    class="fas fa-microscope"></i></span>
        <span class="aside-menu-title">{{ __('messages.lab_technicians') }}</span>
    </a>
</li>
@endmodule

{{--Cases Mgt--}}
<?php
$patientCaseMgt = getMenuLinks(\App\Models\User::MAIN_PATIENT_CASE)
?>
@if ($patientCaseMgt)
    <li class="nav-item  {{ Request::is('patients*','patient-cases*','case-handlers*','patient-admissions*') ? 'active' : '' }}">
        <a class="nav-link  d-flex align-items-center py-3"
           href="{{ $patientCaseMgt }}">
                                                                                                            <span class="aside-menu-icon pe-3 pe-3"><i
                                                                                                                        class="fas fa-user-injured"></i></span>
            <span class="aside-menu-title">{{ __('messages.patients') }}</span>
            <span class="d-none">{{__('messages.cases')}}</span>
            <span class="d-none">{{__('messages.case_handlers')}}</span>
            <span class="d-none">{{__('messages.patient_admissions')}}</span>
        </a>
    </li>
@endif

{{-- Services dropdown --}}
<?php
$serviceMgt = getMenuLinks(\App\Models\User::MAIN_SERVICE)
?>
@if ($serviceMgt)
    <li class="nav-item {{ Request::is('insurances*','packages*','services*','ambulances*','ambulance-calls*') ? 'active' : '' }}">
        <a class="nav-link  d-flex align-items-center py-3"
           href="{{ $serviceMgt }}">
            <span class="aside-menu-icon pe-3 pe-3"><i class="fas fa-box"></i></span>
            <span class="aside-menu-title">{{ __('messages.services') }}</span>
            <span class="d-none">{{__('messages.insurances')}}</span>
            <span class="d-none">{{__('messages.packages')}}</span>
            <span class="d-none">{{__('messages.services')}}</span>
            <span class="d-none">{{__('messages.ambulances')}}</span>
            <span class="d-none">{{__('messages.ambulance_calls')}}</span>
        </a>
    </li>
@endif

{{-- sms/mail--}}
<?php
$smsMailMgt = getMenuLinks(\App\Models\User::MAIN_SMS_MAIL)
?>
@if ($smsMailMgt)
    <li class="nav-item  {{ Request::is('sms*','mail*') ? 'active' : '' }}">
        <a class="nav-link  d-flex align-items-center py-3"
           href="{{ $smsMailMgt }}"
           title="{{ __('SMS/Mail') }}">
        <span class="aside-menu-icon pe-3 pe-3">
            <i class="fas fa-bell"></i>
		</span>
            <span class="aside-menu-title">{{ __('messages.sms.sms') }}/{{ __('messages.mail') }}</span>
            <span class="d-none">{{ __('messages.sms.sms') }}</span>
            <span class="d-none">{{ __('messages.mail') }}</span>
        </a>
    </li>
@endif

{{-- Settings --}}
<li class="nav-item  {{ Request::is('settings*','hospital-schedules*','currency-settings*') ? 'active' : '' }}">
    <a class="nav-link  d-flex align-items-center py-3"
       href="{{ route('settings.edit') }}">
        <span class="aside-menu-icon pe-3 pe-3"><i class="fa fa-cogs"></i></span>
        <span class="aside-menu-title">{{ __('messages.settings') }}</span>
        <span class="d-none">{{ __('messages.general') }}</span>
        
    </a>
</li>


{{--Users--}}
<li class="nav-item {{ Request::is('users*') ? 'active' : '' }}">
    <a class="nav-link  d-flex align-items-center py-3"
       href="{{ route('users.index') }}">
        <span class="aside-menu-icon pe-3 pe-3">
            <i class="fas fa-user-friends"></i>
		</span>
        <span class="aside-menu-title">{{ __('messages.users') }}</span>
    </a>
</li>

@endrole
@if(Auth::user()->email_verified_at != null)
    @role('Doctor')
    @module('Appointments',$modules)
    <li class="nav-item  {{ Request::is('appointments*') ? 'active' : '' }}">
        <a class="nav-link  d-flex align-items-center py-3"
           href="{{ route('appointments.index') }}">
                                                                                                                                                                <span class="aside-menu-icon pe-3 pe-3"><i
                                                                                                                                                                            class="nav-icon fas fa-calendar-check"></i></span>
            <span class="aside-menu-title">{{ __('messages.appointments') }}</span>
        </a>
    </li>
    @endmodule

    @module('Doctors',$modules)
    <li class="nav-item  {{ Request::is('employee/doctor*','prescriptions*','schedules*','doctors*') ? 'active' : '' }}">
        <a class="nav-link  d-flex align-items-center py-3"
           href="{{ url('employee/doctor') }}">
                                                                                                                                                                <span class="aside-menu-icon pe-3 pe-3"><i
                                                                                                                                                                            class="fa fa-user-md"></i></span>
            <span class="aside-menu-title">{{ __('messages.doctors') }}</span>
            <span class="d-none">{{__('messages.schedules')}}</span>
            <span class="d-none">{{__('messages.prescriptions')}}</span>
        </a>
    </li>
    @endmodule

    @module('Documents',$modules)
    <li class="nav-item  {{ Request::is('documents*') ? 'active' : '' }}">
        <a class="nav-link  d-flex align-items-center py-3"
           href="{{ route('documents.index') }}">
                                                                                                                                                                <span class="aside-menu-icon pe-3 pe-3"><i
                                                                                                                                                                            class="fas fa-file"></i></span>
            <span class="aside-menu-title">{{ __('messages.documents') }}</span>
        </a>
    </li>
    @endmodule

    {{--Diagnosis Test--}}
    <?php
    $diagnosisDoctorMGT = getMenuLinks(\App\Models\User::MAIN_DIAGNOSIS)
    ?>
    @if ($diagnosisDoctorMGT)
        <li class="nav-item  {{ Request::is('diagnosis-categories*','patient-diagnosis-test*') ? 'active' : '' }}">
            <a class="nav-link  d-flex align-items-center py-3"
               href="{{ $diagnosisDoctorMGT }}">
                <span class="aside-menu-icon pe-3 pe-3"><i class="fas fa-diagnoses"></i></span>
                <span class="aside-menu-title">{{ __('messages.patient_diagnosis_test.diagnosis') }}</span>
                <span class="d-none">{{ __('messages.patient_diagnosis_test.diagnosis_category') }}</span>
                <span class="d-none">{{ __('messages.patient_diagnosis_test.diagnosis_test') }}</span>
            </a>
        </li>
    @endif

    {{-- Front settings --}}
    @module('Notice Boards',$modules)
    <li class="nav-item {{ Request::is('employee/notice-board*') ? 'active' : '' }}">
        <a class="nav-link  d-flex align-items-center py-3"
           href="{{ url('employee/notice-board') }}">
                                                                                                                                                                        <span class="aside-menu-icon pe-3 pe-3"><i
                                                                                                                                                                                    class="fas fa fa-cog"></i></span>
            <span class="aside-menu-title">{{ __('messages.notice_boards') }}</span>
            <span class="d-none">{{ __('messages.notice_boards') }}</span>
        </a>
    </li>
    @endmodule

    {{-- Patients --}}
    <?php
    $patientDoctorCaseMgt = getMenuLinks(\App\Models\User::MAIN_DOCTOR_PATIENT_CASE)
    ?>
    @if ($patientDoctorCaseMgt)
        <li class="nav-item  {{ Request::is('patient-admissions*') ? 'active' : '' }}">
            <a class="nav-link  d-flex align-items-center py-3"
               href="{{ $patientDoctorCaseMgt }}">
                <span class="aside-menu-icon pe-3 pe-3"><i class="fas fa-user-injured"></i></span>
                <span class="aside-menu-title">{{ __('messages.patients') }}</span>
                <span class="d-none">{{__('messages.patient_admissions')}}</span>
            </a>
        </li>
    @endif

    {{-- SMS --}}
    @module('SMS',$modules)
    <li class="nav-item {{ Request::is('sms*') ? 'active' : '' }}">
        <a class="nav-link  d-flex align-items-center py-3"
           href="{{ route('sms.index') }}">
           <span class="aside-menu-icon pe-3 pe-3"><i class="fas fa fa-sms"></i></span>
            <span class="aside-menu-title">{{ __('messages.sms.sms') }}</span>
        </a>
    </li>
    @endmodule
    @endrole

    @role('Case Manager')
    @module('Doctors',$modules)
    <li class="nav-item  {{ Request::is('employee/doctor*') ? 'active' : '' }}">
        <a class="nav-link  d-flex align-items-center py-3"
           href="{{ url('employee/doctor') }}">
           <span class="aside-menu-icon pe-3 pe-3"><i class="fa fa-user-md"></i></span>
            <span class="aside-menu-title">{{ __('messages.doctors') }}</span>
        </a>
    </li>
    @endmodule

    {{-- Notice Boards --}}
    @module('Notice Boards',$modules)
    <li class="nav-item  {{ Request::is('employee/notice-board*') ? 'active' : '' }}">
        <a class="nav-link  d-flex align-items-center py-3"
           href="{{ url('employee/notice-board') }}">
            <span class="aside-menu-icon pe-3 pe-3"><i class="fas fa fa-cog"></i></span>
            <span class="aside-menu-title">{{ __('messages.notice_boards') }}</span>
            <span class="d-none">{{ __('messages.notice_boards') }}</span>
        </a>
    </li>


    @module('My Payrolls',$modules)
    <li class="nav-item  {{ Request::is('employee/payroll') ? 'active' : '' }}">
        <a class="nav-link  d-flex align-items-center py-3"
           href="{{ route('payroll') }}">
            <span class="aside-menu-icon pe-3 pe-3"><i class="fas fa-chart-pie"></i></span>
            <span class="aside-menu-title">{{ __('messages.my_payrolls') }}</span>
        </a>
    </li>
    @endmodule

    {{-- Patient admissions and Cases --}}
    <?php
    $patientCaseMangerCaseMgt = getMenuLinks(\App\Models\User::MAIN_CASE_MANGER_PATIENT_CASE)
    ?>
    @if ($patientCaseMangerCaseMgt)
        <li class="nav-item  {{ Request::is('patient-admissions*','patient-cases*') ? 'active' : '' }}">
            <a class="nav-link  d-flex align-items-center py-3"
               href="{{ $patientCaseMangerCaseMgt }}"
               title="{{ __('Patients') }}">
                <span class="aside-menu-icon pe-3 pe-3"><i class="fas fa-user-injured"></i></span>
                <span class="aside-menu-title">{{ __('messages.patients') }}</span>
                <span class="d-none">{{__('messages.case_handlers')}}</span>
                <span class="d-none">{{__('messages.patient_admissions')}}</span>
            </a>
        </li>
    @endif

    {{-- Ambulances and Ambulance Calls --}}
    <?php
    $serviceCaseMangerCaseMgt = getMenuLinks(\App\Models\User::MAIN_CASE_MANGER_SERVICE)
    ?>
    @if ($serviceCaseMangerCaseMgt)
        <li class="nav-item  {{ Request::is('ambulances*','ambulance-calls*') ? 'active' : '' }}">
            <a class="nav-link  d-flex align-items-center py-3"
               href="{{ $serviceCaseMangerCaseMgt }}"
               title="{{ __('Services') }}">
                <span class="aside-menu-icon pe-3 pe-3"><i class="fas fa-box"></i></span>
                <span class="aside-menu-title">{{ __('messages.services') }}</span>
                <span class="d-none">{{__('messages.ambulances')}}</span>
                <span class="d-none">{{__('messages.ambulance_calls')}}</span>
            </a>
        </li>
    @endif

    {{-- Mail and SMS --}}
    <?php
    $smsMailCaseManagerMgt = getMenuLinks(\App\Models\User::MAIN_SMS_MAIL)
    ?>
    @if ($smsMailCaseManagerMgt)
        <li class="nav-item  {{ Request::is('sms*','mail*') ? 'active' : '' }}">
            <a class="nav-link  d-flex align-items-center py-3"
               href="{{ route('sms.index') }}"
               title="{{ __('SMS/Mail') }}">
                <span class="aside-menu-icon pe-3 pe-3">
                    <i class="fas fa-bell"></i>
                </span>
                <span class="aside-menu-title">{{ __('messages.sms.sms') }}/{{ __('messages.mail') }}</span>
            </a>
        </li>
    @endif
    @endmodule
    @endrole

    @role('Receptionist')
    {{--Appointments--}}
    @module('Appointments',$modules)
    <li class="nav-item  {{ Request::is('appointments*') ? 'active' : '' }}">
        <a class="nav-link  d-flex align-items-center py-3"
           href="{{ route('appointments.index') }}">
            <span class="aside-menu-icon pe-3 pe-3"><i class="fas fa-calendar-check"></i></span>
            <span class="aside-menu-title">{{ __('messages.appointments') }}</span>
        </a>
    </li>
    @endmodule

    {{--Doctors--}}
    @module('Doctors',$modules)
    <li class="nav-item  {{ Request::is('doctors*') ? 'active' : '' }}">
        <a class="nav-link  d-flex align-items-center py-3"
           href="{{ route('doctors.index') }}">
            <span class="aside-menu-icon pe-3 pe-3"><i class="fa fa-user-md"></i></span>
            <span class="aside-menu-title">{{ __('messages.doctors') }}</span>
        </a>
    </li>
    @endmodule

    @module('Notice Boards',$modules)
    <li class="nav-item {{ Request::is('employee/notice-board','testimonials*') ? 'active' : '' }}">
        <a class="nav-link  d-flex align-items-center py-3"
           href="{{ url('employee/notice-board') }}">
            <span class="aside-menu-icon pe-3 pe-3"><i class="fas fa fa-cog"></i></span>
            <span class="aside-menu-title">{{ __('messages.notice_boards') }}</span>
            <span class="d-none">{{ __('messages.notice_boards') }}</span>
        </a>
    </li>
    @endmodule

    {{-- Hospital Charges --}}
    <?php
    $ReceptionisthospitalCharge = getMenuLinks(\App\Models\User::MAIN_HOSPITAL_CHARGE)
    ?>
    @if ($ReceptionisthospitalCharge)
        <li class="nav-item  {{ Request::is('charge-categories*','charges*','doctor-opd-charges*') ? 'active' : '' }}">
            <a class="nav-link  d-flex align-items-center py-3"
               href="{{ $ReceptionisthospitalCharge }}">
                <span class="aside-menu-icon pe-3 pe-3"><i class="fas fa-coins"></i></span>
                <span class="aside-menu-title">{{ __('messages.hospital_charges') }}</span>
                <span class="d-none">{{ __('messages.charge_categories') }}</span>
                <span class="d-none">{{ __('messages.charges') }}</span>
                <span class="d-none">{{ __('messages.doctor_opd_charges') }}</span>
            </a>
        </li>
    @endif


    @module('My Payrolls',$modules)
    <li class="nav-item {{ Request::is('employee/payroll') ? 'active' : '' }}">
        <a class="nav-link  d-flex align-items-center py-3"
           href="{{ route('payroll') }}">
            <span class="aside-menu-icon pe-3 pe-3"><i class="fas fa-chart-pie"></i></span>
            <span class="aside-menu-title">{{ __('messages.my_payrolls') }}</span>
        </a>
    </li>
    @endmodule

    {{--Cases Mgt--}}
    <?php
    $receptionistPatientCaseMgt = getMenuLinks(\App\Models\User::MAIN_PATIENT_CASE)
    ?>
    @if ($receptionistPatientCaseMgt)
        <li class="nav-item {{ Request::is('patients*','patient-cases*','case-handlers*','patient-admissions*') ? 'active' : '' }}">
            <a class="nav-link  d-flex align-items-center py-3"
               href="{{ $receptionistPatientCaseMgt }}">
                <span class="aside-menu-icon pe-3 pe-3"><i class="fas fa-user-injured"></i></span>
                <span class="aside-menu-title">{{ __('messages.patients') }}</span>
                <span class="d-none">{{__('messages.cases')}}</span>
                <span class="d-none">{{__('messages.case_handlers')}}</span>
                <span class="d-none">{{__('messages.patient_admissions')}}</span>
            </a>
        </li>
    @endif

    {{-- Services dropdown --}}
    <?php
    $receptionistServiceMgt = getMenuLinks(\App\Models\User::MAIN_SERVICE)
    ?>
    @if ($receptionistServiceMgt)
        <li class="nav-item {{ Request::is('insurances*','packages*','services*','ambulances*','ambulance-calls*') ? 'active' : '' }}">
            <a class="nav-link  d-flex align-items-center py-3"
               href="{{ $receptionistServiceMgt }}">
                <span class="aside-menu-icon pe-3 pe-3"><i class="fas fa-box"></i></span>
                <span class="aside-menu-title">{{ __('messages.services') }}</span>
                <span class="d-none">{{__('messages.insurances')}}</span>
                <span class="d-none">{{__('messages.packages')}}</span>
                <span class="d-none">{{__('messages.services')}}</span>
                <span class="d-none">{{__('messages.ambulances')}}</span>
                <span class="d-none">{{__('messages.ambulance_calls')}}</span>
            </a>
        </li>
    @endif

    {{-- Mail and SMS --}}
    <?php
    $receptionistSmsMailMgt = getMenuLinks(\App\Models\User::MAIN_SMS_MAIL)
    ?>
    @if ($receptionistSmsMailMgt)
        <li class="nav-item  {{ Request::is('sms*','mail*') ? 'active' : '' }}">
            <a class="nav-link  d-flex align-items-center py-3"
               href="{{ $receptionistSmsMailMgt }}"
               title="{{ __('SMS/Mail') }}">
                <span class="aside-menu-icon pe-3 pe-3">
                    <i class="fas fa-bell"></i>
                </span>
                <span class="aside-menu-title">{{ __('messages.sms.sms') }}/{{ __('messages.mail') }}</span>
                <span class="d-none">{{ __('messages.sms.sms') }}</span>
                <span class="d-none">{{ __('messages.mail') }}</span>
            </a>
        </li>
    @endif

    {{--@module('Testimonial',$modules)--}}
    {{--<li class="nav-item">--}}
    {{--    <a class="nav-link  d-flex align-items-center py-3 ps-0 {{ Request::is('testimonials*') ? 'active' : '' }}"--}}
    {{--       href="{{ route('testimonials.index') }}">--}}
    {{--        <span class="aside-menu-icon pe-3 pe-3"><i class="fas fa fa-cog"></i></span>--}}
    {{--               <span class="aside-menu-title">{{ __('messages.front_settings') }}</span>
            <span class="d-none">{{ __('messages.notice_boards') }}</span>--}}
    {{--    </a>--}}
    {{--</li>--}}
    {{--@endmodule--}}
    @endrole

    @role('Pharmacist')
    @module('Doctors',$modules)
    <li class="nav-item  {{ Request::is('employee/doctor*') ? 'active' : '' }}">
        <a class="nav-link  d-flex align-items-center py-3"
           href="{{ url('employee/doctor') }}">
            <span class="aside-menu-icon pe-3 pe-3"><i class="fa fa-user-md"></i></span>
            <span class="aside-menu-title">{{ __('messages.doctors') }}</span>
        </a>
    </li>
    @endmodule

    @module('Prescriptions',$modules)
    <li class="nav-item  {{ Request::is('employee/prescriptions*') ? 'active' : '' }}">
        <a class="nav-link  d-flex align-items-center py-3"
           href="{{ url('employee/prescriptions') }}">
            <span class="aside-menu-icon pe-3 pe-3"><i class="fas fa-prescription"></i></span>
            <span class="aside-menu-title">{{ __('messages.prescriptions') }}</span>
        </a>
    </li>
    @endmodule

    @module('Notice Boards',$modules)
    <li class="nav-item  {{ Request::is('employee/notice-board*') ? 'active' : '' }}">
        <a class="nav-link  d-flex align-items-center py-3"
           href="{{ url('employee/notice-board') }}">
            <span class="aside-menu-icon pe-3 pe-3"><i class="fas fa fa-cog"></i></span>
            <span class="aside-menu-title">{{ __('messages.notice_boards') }}</span>
            <span class="d-none">{{ __('messages.notice_boards') }}</span>
        </a>
    </li>
    @endmodule

    {{-- Live Meeting --}}
    @module('Live Meetings',$modules)
    <li class="nav-item  {{ Request::is('live-meeting*') ? 'active' : '' }}">
        <a class="nav-link  d-flex align-items-center py-3"
           href="{{ route('live.meeting.index') }}">
            <span class="aside-menu-icon pe-3 pe-3"><i class="fa fa-file-video"></i></span>
            <span class="aside-menu-title">{{ __('messages.live_meetings') }}</span>
        </a>
    </li>
    @endmodule

    @module('My Payrolls',$modules)
    <li class="nav-item {{ Request::is('employee/payroll') ? 'active' : '' }}">
        <a class="nav-link  d-flex align-items-center py-3"
           href="{{ route('payroll') }}">
            <span class="aside-menu-icon pe-3 pe-3"><i class="fas fa-chart-pie"></i></span>
            <span class="aside-menu-title">{{ __('messages.my_payrolls') }}</span>
        </a>
    </li>
    @endmodule

    {{-- SMS --}}
    @module('SMS',$modules)
    <li class="nav-item {{ Request::is('sms*') ? 'active' : '' }}">
        <a class="nav-link  d-flex align-items-center py-3"
           href="{{ route('sms.index') }}">
                                                                                                                                                                                                                                                        <span class="aside-menu-icon pe-3 pe-3"><i
                                                                                                                                                                                                                                                                    class="fas fa fa-sms"></i></span>
            <span class="aside-menu-title">{{ __('messages.sms.sms') }}</span>
        </a>
    </li>
    @endmodule
    @endrole

    @role('Nurse')
    {{-- Bed Manager --}}
    <?php $bedNurseMGT = getMenuLinks(\App\Models\User::MAIN_BED_MGT)
    ?>
    @if ($bedNurseMGT)
        <li class="nav-item  {{ Request::is('bed-types*','beds*','bed-assigns*','bulk-beds') ? 'active' : '' }}">
            <a class="nav-link  d-flex align-items-center py-3"
               href="{{ $bedNurseMGT }}">
               <span class="aside-menu-icon pe-3 pe-3"><i class="nav-icon fas fa-bed"></i></span>
                <span class="aside-menu-title">{{ __('messages.bed_management') }}</span>
                <span class="d-none">{{__('messages.bed_types')}}</span>
                <span class="d-none">{{__('messages.beds')}}</span>
                <span class="d-none">{{__('messages.bed_assigns')}}</span>
            </a>
        </li>
    @endif

    @module('Notice Boards',$modules)
    <li class="nav-item  {{ Request::is('employee/notice-board*') ? 'active' : '' }}">
        <a class="nav-link  d-flex align-items-center py-3"
           href="{{ url('employee/notice-board') }}">
           <span class="aside-menu-icon pe-3 pe-3"><i class="fas fa fa-cog"></i></span>
            <span class="aside-menu-title">{{ __('messages.notice_boards') }}</span>
            <span class="d-none">{{ __('messages.notice_boards') }}</span>
        </a>
    </li>
    @endmodule

    @endrole

    @role('MedTech')
    {{-- Blood Bank dropdown --}}
    <?php
    $bloodbankLabMGT = getMenuLinks(\App\Models\User::MAIN_BLOOD_BANK_MGT)
    ?>

    @module('Doctors',$modules)
    <li class="nav-item {{ Request::is('employee/doctor*') ? 'active' : '' }}">
        <a class="nav-link  d-flex align-items-center py-3"
           href="{{ url('employee/doctor') }}">
           <span class="aside-menu-icon pe-3 pe-3"><i class="fa fa-user-md"></i></span>
            <span class="aside-menu-title">{{ __('messages.doctors') }}</span>
        </a>
    </li>
    @endmodule



    {{--Diagnosis Test--}}
    <?php
    $diagnosiLabMGT = getMenuLinks(\App\Models\User::MAIN_DIAGNOSIS)
    ?>
    @if ($diagnosiLabMGT)
        <li class="nav-item {{ Request::is('diagnosis-categories*','patient-diagnosis-test*') ? 'active' : '' }}">
            <a class="nav-link  d-flex align-items-center py-3"
               href="{{ $diagnosiLabMGT }}">
               <span class="aside-menu-icon pe-3 pe-3"><i class="fas fa-diagnoses"></i></span>
                <span class="aside-menu-title">{{ __('messages.patient_diagnosis_test.diagnosis') }}</span>
                <span class="d-none">{{ __('messages.patient_diagnosis_test.diagnosis_category') }}</span>
                <span class="d-none">{{ __('messages.patient_diagnosis_test.diagnosis_test') }}</span>
            </a>
        </li>
    @endif

    {{-- Front Settings--}}
    @module('Notice Boards',$modules)
    <li class="nav-item  {{ Request::is('employee/notice-board*') ? 'active' : '' }}">
        <a class="nav-link  d-flex align-items-center py-3"
           href="{{ url('employee/notice-board') }}">
           <span class="aside-menu-icon pe-3 pe-3"><i class="fas fa fa-cog"></i></span>
            <span class="aside-menu-title">{{ __('messages.notice_boards') }}</span>
            <span class="d-none">{{ __('messages.notice_boards') }}</span>
        </a>
    </li>
    @endmodule

    @endrole

    @role('Secretary')
    {{-- Account Manager dropdown --}}
    <?php
    $billingAccountMGT = getMenuLinks(\App\Models\User::MAIN_ACCOUNT_MANAGER_MGT)
    ?>
    @if ($billingAccountMGT)
        <li class="nav-item {{ Request::is('accounts*','employee-payrolls*','invoices*','payments*','bills*') ? 'active' : '' }}">
            <a class="nav-link  d-flex align-items-center py-3"
               href="{{ $billingAccountMGT }}">
               <span class="aside-menu-icon pe-3 pe-3"><i class="fab fa-adn"></i></span>
                <span class="aside-menu-title">{{ __('messages.account_manager') }}</span>
                <span class="d-none">{{ __('messages.accounts') }}</span>
                <span class="d-none">{{__('messages.employee_payrolls')}}</span>
                <span class="d-none">{{__('messages.invoices')}}</span>
                <span class="d-none">{{__('messages.payments')}}</span>
                <span class="d-none">{{__('messages.bills')}}</span>
                <span class="d-none">{{__('messages.appointments')}}</span>
            </a>
        </li>
    @endif

    {{--Appointments--}}
        @module('Appointments',$modules)
        <li class="nav-item {{ Request::is('appointment*') ? 'active' : '' }}">
            <a class="nav-link  d-flex align-items-center py-3"
            href="{{ route('appointments.index') }}">
                <span class="aside-menu-icon pe-3 pe-3"><i class="fas fa-calendar-check"></i></span>
                <span class="aside-menu-title">{{ __('messages.appointments') }}</span>
            </a>
        </li>
        @endmodule

        {{-- Patients --}}
            <?php
            $patientDoctorCaseMgt = getMenuLinks(\App\Models\User::MAIN_DOCTOR_PATIENT_CASE)
            ?>
            @if ($patientDoctorCaseMgt)
                <li class="nav-item  {{ Request::is('patient-admissions*') ? 'active' : '' }}">
                    <a class="nav-link  d-flex align-items-center py-3"
                    href="{{ $patientDoctorCaseMgt }}">
                        <span class="aside-menu-icon pe-3 pe-3"><i class="fas fa-user-injured"></i></span>
                        <span class="aside-menu-title">{{ __('messages.patients') }}</span>
                        <span class="d-none">{{__('messages.patient_admissions')}}</span>
                    </a>
                </li>
            @endif
    
    {{-- Notice Boards--}}
    @module('Notice Boards',$modules)
    <li class="nav-item {{ Request::is('employee/notice-board*') ? 'active' : '' }}">
        <a class="nav-link  d-flex align-items-center py-3"
           href="{{ url('employee/notice-board') }}">
           <span class="aside-menu-icon pe-3 pe-3"><i class="fas fa fa-cog"></i></span>
            <span class="aside-menu-title">{{ __('messages.notice_boards') }}</span>
            <span class="d-none">{{ __('messages.notice_boards') }}</span>
        </a>
    </li>
    @endmodule

    

    {{-- Services --}}
    @module('Services',$modules)
    <li class="nav-item {{ Request::is('services*') ? 'active' : '' }}">
        <a class="nav-link  d-flex align-items-center py-3"
           href="{{ route('services.index') }}">
           <span class="aside-menu-icon pe-3 pe-3"><i class="fas fa-box"></i></span>
            <span class="aside-menu-title">{{ __('messages.services') }}</span>
        </a>
    </li>
    @endmodule

    {{-- SMS --}}
    @module('SMS',$modules)
    <li class="nav-item  {{ Request::is('sms*') ? 'active' : '' }}">
        <a class="nav-link  d-flex align-items-center py-3"
           href="{{ route('sms.index') }}">
            <span class="aside-menu-icon pe-3 pe-3"><i class="fas fa fa-sms"></i></span>
            <span class="aside-menu-title">{{ __('messages.sms.sms') }}</span>
        </a>
    </li>
    @endmodule
    @endrole

    @role('Patient')

    @module('Appointments',$modules)
    <li class="nav-item  {{ Request::is('appointments*') ? 'active' : '' }}">
        <a class="nav-link  d-flex align-items-center py-3"
           href="{{ route('appointments.index') }}">
            <span class="aside-menu-icon pe-3 pe-3"><i class="fas fa-calendar-check"></i></span>
            <span class="aside-menu-title">{{ __('messages.appointments') }}</span>
        </a>
    </li>
    @endmodule

    @module('Bills',$modules)
    <li class="nav-item  {{ Request::is('employee/bills*') ? 'active' : '' }}">
        <a class="nav-link  d-flex align-items-center py-3"
           href="{{ url('employee/bills') }}">
           <span class="aside-menu-icon pe-3 pe-3"><i class="fa fa-rupee-sign"></i></span>
            <span class="aside-menu-title">{{ __('messages.bills') }}</span>
        </a>
    </li>
    @endmodule

    {{--Diagnosis test Report--}}
    @module('Diagnosis Tests',$modules)
    <li class="nav-item  {{ Request::is('employee/patient-diagnosis-test*') ? 'active' : '' }}">
        <a class="nav-link  d-flex align-items-center py-3"
           href="{{ url('employee/patient-diagnosis-test') }}">
           <span class="aside-menu-icon pe-3 pe-3"><i class="fas fa-file-medical"></i></span>
            <span class="aside-menu-title">{{ __('messages.patient_diagnosis_test.diagnosis_test') }}</span>
        </a>
    </li>
    @endmodule

    {{-- Documents--}}
    @module('Documents',$modules)
    <li class="nav-item  {{ Request::is('documents*') ? 'active' : '' }}">
        <a class="nav-link  d-flex align-items-center py-3"
           href="{{ route('documents.index') }}">
            <span class="aside-menu-icon pe-3 pe-3"><i class="fas fa-file"></i></span>
            <span class="aside-menu-title">{{ __('messages.documents') }}</span>
        </a>
    </li>
    @endmodule

    @module('Notice Boards',$modules)
    <li class="nav-item  {{ Request::is('employee/notice-board*') ? 'active' : '' }}">
        <a class="nav-link  d-flex align-items-center py-3"
           href="{{ url('employee/notice-board') }}">
            <span class="aside-menu-icon pe-3 pe-3"><i class="fas fa fa-cog"></i></span>
            <span class="aside-menu-title">{{ __('messages.notice_boards') }}</span>
            <span class="d-none">{{ __('messages.notice_boards') }}</span>
        </a>
    </li>
    @endmodule

    @module('Invoices',$modules)
    <li class="nav-item  {{ Request::is('employee/invoices*') ? 'active' : '' }}">
        <a class="nav-link  d-flex align-items-center py-3"
           href="{{ url('employee/invoices') }}">
           <span class="aside-menu-icon pe-3 pe-3"><i class="fas fa-file-invoice"></i></span>
            <span class="aside-menu-title">{{ __('messages.invoices') }}</span>
        </a>
    </li>
    @endmodule

    @module('Patient Admissions',$modules)
    <li class="nav-item  {{ Request::is('employee/patient-admissions*') ? 'active' : '' }}">
        <a class="nav-link  d-flex align-items-center py-3"
           href="{{ url('employee/patient-admissions') }}">
            <span class="aside-menu-icon pe-3 pe-3"><i class="fas fa-history"></i></span>
            <span class="aside-menu-title">{{ __('messages.patient_admissions') }}</span>
        </a>
    </li>
    @endmodule

    @module('Prescriptions',$modules)
    <li class="nav-item {{ Request::is('patient/my-prescriptions*') ? 'active' : '' }}">
        <a class="nav-link  d-flex align-items-center py-3"
           href="{{ route('prescriptions.list') }}">
            <span class="aside-menu-icon pe-3 pe-3"><i class="fas fa-prescription"></i></span>
            <span class="aside-menu-title">{{ __('messages.prescriptions') }}</span>
        </a>
    </li>
    @endmodule

    @endrole
@endif
