<div id="add_blood_donors_modal" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">{{ __('messages.blood_donor.new_blood_donor') }}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            {{ Form::open(['id'=>'addBloodDonorForm']) }}
            <div class="modal-body">
                <div class="alert alert-danger d-none hide" id="bloodDonorErrorsBox"></div>
                <div class="row">
                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('name', __('messages.blood_donor.name').(':'), ['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::text('name', '', ['id'=>'bloodDonorName','class' => 'form-control','required']) }}
                    </div>
                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('age', __('messages.blood_donor.age').(':'),['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::number('age', '', ['id'=>'bloodDonorAge','class' => 'form-control','required','min' => '1', 'max' => '100']) }}
                    </div>
                    <div class="form-group  d-flex align-items-center mb-5">
                        {{ Form::label('gender', __('messages.user.gender').(':'),['class' => 'form-label']) }}
                        <span class="required me-5 mb-1"></span>
                        <div class="d-flex align-items-center mt-1 is-valid">
                            <div class="form-check me-10 mb-0">
                                {{ Form::radio('gender', '1', true, ['class' => 'form-check-input','id'=>'bloodDonorMale']) }}
                                <label class="form-label">{{ __('messages.user.male') }}</label>
                            </div>
                            <div class="form-check me-10 mb-0">
                                {{ Form::radio('gender', '0', false, ['class' => 'form-check-input','id'=>'bloodDonorFemale']) }}
                                <label class="form-label">{{ __('messages.user.female') }}</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('blood_group', __('messages.blood_donor.blood_group').(':'),['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::select('blood_group', $bloodGroup, null, ['class' => 'form-select select2Selector', 'required', 'id' => 'donorBloodGroup', 'placeholder' => 'Select Blood Group', 'data-control' => 'select2', 'required']) }}
                    </div>
                    <div class="form-group col-sm-12">
                        {{ Form::label('last_donate_date', __('messages.blood_donor.last_donation_date').(':'), ['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::text('last_donate_date', '', ['id'=>'lastDonationDate','class' => (getLoggedInUser()->thememode ? 'bg-light form-control' : 'bg-white form-control'),'required', 'autocomplete' => 'off']) }}
                    </div>
                </div>
            </div>
            <div class="modal-footer pt-0">
                {{ Form::button(__('messages.common.save'), ['type' => 'submit','class' => 'btn btn-primary m-0','id' => 'bloodDonorSave','data-loading-text' => "<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">{{ __('messages.common.cancel') }}</button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
