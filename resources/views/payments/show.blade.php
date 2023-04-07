@extends('layouts.app')
@section('title')
    {{ __('messages.payment.payment_details')}}
@endsection
@section('header_toolbar')
    <div class="container-fluid">
        <div class="d-md-flex align-items-center justify-content-between mb-7">
            @include('layouts.errors')
            <h1 class="mb-0">@yield('title')</h1>
            <div class="text-end mt-4 mt-md-0">
                <a  class="btn btn-primary"
                    href="{{ route('payments.edit',['payment' => $payment->id]) }}">{{ __('messages.common.edit') }}</a>
                <a href="{{ route('payments.index')}}"
                   class="btn btn-outline-primary ms-2">{{ __('messages.common.back') }}</a>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            <div class="row">
                <div class="col-12">
                    @include('flash::message')
                </div>
            </div>
                @include('payments.show_fields')
        </div>
    </div>
@endsection
