<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Models\PatientAdmission;
use Illuminate\Http\Request;

class PatientAdmissionAPIController extends AppBaseController
{
    public function index()
    {
        $admissions = PatientAdmission::whereHas('patient.patientUser')->whereHas('doctor.doctorUser')->with('patient.patientUser',
            'doctor.doctorUser', 'package', 'insurance')->where('patient_id', getLoggedInUser()->owner_id)->get();
        $data = [];
        foreach ($admissions as $admission) {
            $data[] = $admission->prepareAdmission();
        }

        return $this->sendResponse($data, 'Admissions Retrieved Successfully');
    }

    public function show($id)
    {
        $admission = PatientAdmission::with('patient.patientUser', 'doctor.doctorUser', 'package',
            'insurance')->find($id);

        return $this->sendResponse($admission->prepareAdmission(), 'Admissions Retrieved Successfully');
    }
}
