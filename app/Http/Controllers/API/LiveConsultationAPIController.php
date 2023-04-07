<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Models\LiveConsultation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LiveConsultationAPIController extends AppBaseController
{
    /**
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $liveConsultations = LiveConsultation::whereHas('patient.patientUser')->whereHas('doctor.doctorUser')->whereHas('user')->with([
            'patient.patientUser', 'doctor.doctorUser', 'user',
        ])->filter()->where('patient_id', getLoggedInUser()->owner_id)->get();

        $data = [];
        foreach ($liveConsultations as $liveConsultation) {
            $data[] = $liveConsultation->prepareLiveConsultation();
        }

        return $this->sendResponse($data, 'Live Consultation Retrieved successfully.');
    }

    /**
     * @param $id
     *
     *
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $liveConsultation = LiveConsultation::with([
            'user', 'patient.patientUser', 'doctor.doctorUser', 'opdPatient', 'ipdPatient',
        ])->find($id);

        return $this->sendResponse($liveConsultation->prepareLiveConsultationDetail(),
            'Live Consultation Retrieved successfully.');
    }
}
