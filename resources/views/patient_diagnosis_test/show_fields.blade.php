<div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="diagnosisTestOverview" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 d-flex flex-column mb-md-10 mb-5">
                                <label class="pb-2 fs-5 text-gray-600">{{ __('messages.patient_diagnosis_test.patient')  }}</label>
                                <span class="fs-5 text-gray-800">{{$patientDiagnosisTest->patient->patientUser->full_name}}</span>
                            </div>
                            <div class="col-md-4 d-flex flex-column mb-md-10 mb-5">
                                <label class="pb-2 fs-5 text-gray-600">{{ __('messages.patient_diagnosis_test.doctor')  }}</label>
                                <span class="fs-5 text-gray-800">{{$patientDiagnosisTest->doctor->doctorUser->full_name}}</span>
                            </div>
                            <div class="col-md-4 d-flex flex-column mb-md-10 mb-5">
                                <label class="pb-2 fs-5 text-gray-600">{{ __('messages.patient_diagnosis_test.diagnosis_category')  }}</label>
                                <span class="fs-5 text-gray-800">{{$patientDiagnosisTest->category->name}}</span>
                            </div>
                            <div class="col-md-4 d-flex flex-column mb-md-10 mb-5">
                                <label class="pb-2 fs-5 text-gray-600">{{ __('messages.patient_diagnosis_test.report_number')  }}</label>
                                <span class="fs-5 text-gray-800">{{$patientDiagnosisTest->report_number}}</span>
                            </div>
                            @if(isset($patientDiagnosisTests))
                                @foreach($patientDiagnosisTests as $patientDiagnosisTest)
                                    <div class="col-md-4 d-flex flex-column mb-md-10 mb-5">
                                        @if(Lang::has('messages.patient_diagnosis_test.'.$patientDiagnosisTest->property_name.''))
                                            <label class="pb-2 fs-5 text-gray-600">{{ __('messages.patient_diagnosis_test.'.$patientDiagnosisTest->property_name.'')  }}</label>
                                        @else
                                            <label class="fs-5 text-gray-800">{{ str_replace("_"," ",$patientDiagnosisTest->property_name) }}</label>
                                        @endif
                                        <span class="pb-2 fs-5 text-gray-600">{{!empty($patientDiagnosisTest->property_value)?$patientDiagnosisTest->property_value:'N/A'}}</span>
                                    </div>
                                @endforeach
                            @endif

                            <div class="col-md-4 d-flex flex-column mb-md-10 mb-5">
                                <label class="pb-2 fs-5 text-gray-600">{{ __('messages.common.created_on')  }}</label>
                                <span class="fs-5 text-gray-800" data-placement="top"  data-bs-original-title="{{ \Carbon\Carbon::parse($patientDiagnosisTest->created_at)->format('jS M, Y') }}">{{ \Carbon\Carbon::parse($patientDiagnosisTest->created_at)->diffForHumans() }}</span>
                            </div>
                            <div class="col-md-4 d-flex flex-column mb-md-10 mb-5">
                                <label class="pb-2 fs-5 text-gray-600">{{ __('messages.common.last_updated')  }}</label>
                                <span class="fs-5 text-gray-800" data-placement="top"  data-bs-original-title="{{ \Carbon\Carbon::parse($patientDiagnosisTest->updated_at)->format('jS M, Y') }}">{{ \Carbon\Carbon::parse($patientDiagnosisTest->updated_at)->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
