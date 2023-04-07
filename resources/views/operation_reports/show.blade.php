@extends('layouts.app')
@section('title')
    {{ __('messages.operation_report.operation_report_details')}}
@endsection
@section('header_toolbar')
    <div class="container-fluid">
        <div class="d-md-flex align-items-center justify-content-between mb-7">
            <h1 class="mb-0">@yield('title')</h1>
            <div class="text-end mt-4 mt-md-0">
                <a class="btn btn-primary edit-btn me-2"
                   href="javascript:void(0)" data-id="{{ $operationReport->id }}">{{ __('messages.common.edit') }}</a>
                <a href="{{ route('birth-reports.index') }}"
                   class="btn btn-outline-primary ms-2">{{ __('messages.common.back') }}</a>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            <div class="row">
                {{Form::hidden('operationReportUrl',url('operation-reports'),['id'=>'indexOperationReportUrl'])}}

                <div class="col-12">
                    @include('flash::message')
                </div>
            </div>
                @include('operation_reports.show_fields')
        </div>
    </div>
    @include('operation_reports.edit_modal')
@endsection
@section('page_scripts')
{{-- assets/js/moment.min.js --}}
@endsection

@section('scripts')
    {{-- assets/js/operation_reports/create-details-edit.js --}}
@endsection
