@extends('layouts.app')
@section('title')
    {{ __('messages.notice_board.details')}}
@endsection
@section('css')
{{--    <link rel="stylesheet" href="{{ asset('assets/css/detail-header.css') }}">--}}
@endsection
@section('content')
    <div class="d-flex flex-column flex-lg-row">
        <div class="flex-lg-row-fluid mb-10 mb-lg-0 me-lg-7 me-xl-10">
            <div class="row">
                <div class="col-12">
                    @include('flash::message')
                </div>
            </div>
            <div class="p-12">
                @include('notice_boards.show_fields')
                {{Form::hidden('noticeBoardUrl',url('notice-boards'),['id'=>'showNoticeBoardUrl'])}}

            </div>
        </div>
    </div>
    @include('notice_boards.edit_modal')
@endsection
@section('page_scripts')
    {{--  assets/js/moment.min.js --}}
@endsection
@section('scripts')
    {{--  assets/js/notice_boards/create-details-edit.js --}}
@endsection
