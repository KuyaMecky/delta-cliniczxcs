<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Models\PatientCase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PatientCaseAPIController extends AppBaseController
{
    /**
     *
     *
     * @return mixed
     */
    public function index()
    {
        $patientCases = PatientCase::with('doctor')->where('patient_id', getLoggedInUser()->owner_id)->get();
        $data = [];
        foreach ($patientCases as $patientCase) {
            /** @var PatientCase $patientCase */
            $data[] = $patientCase->preparePatientCase();
        }

        return $this->sendResponse($data, 'Patient Cases Retrieved successfully.');
    }

    /**
     * @param $id
     *
     *
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $patientCase = PatientCase::with('doctor')->find($id);

        return $this->sendResponse($patientCase->preparePatientCase(), 'Patient Cases Retrieved successfully.');
    }
}
