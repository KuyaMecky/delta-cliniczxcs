<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Models\Prescription;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PrescriptionAPIController extends AppBaseController
{
    /**
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $prescriptions = Prescription::with('patient.patientUser', 'doctor.doctorUser')->where('patient_id',
            getLoggedInUser()->owner_id)->get();
        $data = [];
        foreach ($prescriptions as $prescription) {
            /** @var Prescription $prescription */
            $data[] = $prescription->preparePrescription();
        }

        return $this->sendResponse($data, 'Prescriptions Retrieved Successfully');
    }

    public function show($id): JsonResponse
    {
        $prescription = Prescription::with('patient.patientUser', 'doctor.doctorUser')->find($id);

        return $this->sendResponse($prescription->preparePrescription(), "Prescription Retrieved Successfully");
    }
}
