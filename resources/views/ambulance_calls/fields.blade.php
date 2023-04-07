<div class="row">
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('patient_id', __('messages.ambulance_call.patient').(':'),['class' => 'form-label']) }}
        <span class="required"></span>
        {{ Form::select('patient_id', $patients, null, ['class' => 'form-select','required','id' => 'ambulanceCallPatientId','placeholder'=>'Select Patient','data-control' => 'select2']) }}
    </div>
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('ambulance_id', __('messages.ambulance_call.vehicle_model').(':'),['class' => 'form-label']) }}
        <span class="required"></span>
        {{ Form::select('ambulance_id', $ambulances, null, ['class' => 'form-select','required','id' => 'callAmbulanceId','placeholder'=>'Select Ambulance','data-control' => 'select2']) }}
    </div>
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('date', __('messages.ambulance_call.date').(':'),['class' => 'form-label']) }}
        <span class="required"></span>
        {{ Form::text('date', null, ['id'=>'ambulanceCallDate', 'class' => (getLoggedInUser()->thememode ? 'bg-light form-control' : 'bg-white form-control'), 'required','autocomplete' => 'off']) }}
    </div>
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('driver_name', __('messages.ambulance_call.driver_name').(':'),['class' => 'form-label']) }}
        <span class="required"></span>
        {{ Form::text('driver_name', null, ['class' => 'form-control', 'required', 'readonly', 'id' => 'ambulanceCallDriverName']) }}
    </div>
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('amount', __('messages.ambulance_call.amount').(':'),['class' => 'form-label']) }}
        <span class="required"></span>
        {{ Form::text('amount', null, ['class' => 'form-control price-input', 'required', 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")']) }}
    </div>
    <div class="d-flex justify-content-end">
        {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-2', 'id' => 'ambulanceCallSaveBtn']) }}
        <a href="{{ route('ambulance-calls.index') }}"
           class="btn btn-secondary me-2">{{ __('messages.common.cancel') }}</a>
    </div>
</div>
