<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Models\PatientDiagnosisTest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DiagnosisTestAPIController extends AppBaseController
{
    public function index(): JsonResponse
    {
        if(getLoggedinPatient())
        {
            $diagnosis = PatientDiagnosisTest::with('doctor.doctorUser')->where('patient_id', getLoggedInUser()->patient->id)->get();
            $data = [];
            foreach ($diagnosis as $diagnose) {
                $data[] = $diagnose->prepareDiagnosis();
            }

            return $this->sendResponse($data, "Bills Retrieved Successfully");   
        }
    }

    public function show($id): JsonResponse
    {
        $diagnosis = PatientDiagnosisTest::with('doctor.doctorUser')->find($id);

        return $this->sendResponse($diagnosis->prepareDiagnosisDetail(), "Diagnosis Retrieved Successfully");
    }
}
