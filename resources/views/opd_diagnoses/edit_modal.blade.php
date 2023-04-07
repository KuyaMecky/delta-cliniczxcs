<div id="edit_opd_diagnoses_modal" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h2>{{ __('messages.ipd_patient_diagnosis.edit_ipd_diagnosis') }}</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            {{ Form::open(['id'=>'editOpdDiagnosisForm']) }}
            <div class="modal-body">
                <div class="alert alert-danger d-none hide" id="editOpdDiagnosisErrorsBox"></div>
                {{ Form::hidden('id',null,['id'=>'opdDiagnosisId']) }}
                <div class="row">
                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('report_type', __('messages.ipd_patient_diagnosis.report_type').':',['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::text('report_type', null, ['class' => 'form-control','required', 'id' => 'editOpdDiagnosisReportType']) }}
                    </div>
                    <div class="form-group col-md-12 mb-5">
                        {{ Form::label('report_date', __('messages.ipd_patient_diagnosis.report_date').':',['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::text('report_date', null, ['class' => (getLoggedInUser()->thememode ? 'bg-light form-control' : 'bg-white form-control'),'id' => 'editOpdDiagnosisReportDate','autocomplete' => 'off', 'required']) }}
                    </div>
                    <div class="form-group col-md-12 mb-5">
                        <div class="form-group">
                            {{ Form::label('description', __('messages.ipd_patient_diagnosis.description').':',['class' => 'form-label']) }}
                            {{ Form::textarea('description', null, ['class' => 'form-control', 'rows' => 4, 'id' => 'editOpdDiagnosisDescription']) }}
                        </div>
                    </div>
                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('document', __('messages.ipd_patient_diagnosis.document').':',['class' => 'form-label']) }}
                        <div class="d-block"></div>
                            <div class="image-picker">
                                <div class="image previewImage" id="editOpdDiagnosisPreviewImage"
                                     style="background-image: url({{ asset('assets/img/default_image.jpg') }})">
                                </div>
                                <span class="picker-edit rounded-circle text-gray-500 fs-small" title="Change document">
                                    <label>
                                    <i class="fa-solid fa-pen" id="profileImageIcon"></i>
                                        {{ Form::file('file',['id'=>'editOpdDiagnosisDocumentImage','class' => 'image-upload d-none','accept' => 'image/*']) }}
                                        <input type="hidden" name="avatar_remove">
                                    </label>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer p-0">
                        {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary me-3','id'=>'btnEditOpdDiagnosisSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                        <button type="button" id="btnOpdDiagnosisCancelEdit"
                                class="btn btn-secondary"
                                data-bs-dismiss="modal">{{ __('messages.common.cancel') }}</button>
                    </div>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
{{--</div>--}}
