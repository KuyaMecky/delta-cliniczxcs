<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Models\VaccinatedPatients;
use Illuminate\Http\Request;

class VaccinatedPatientAPIController extends AppBaseController
{
    /**
     *
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        if(getLoggedinPatient()) 
        {
            $vaccinatedPatientsData = VaccinatedPatients::where('patient_id', getLoggedInUser()->patient->id)->get();
            
            $data = [];
            foreach ($vaccinatedPatientsData as $vaccinatedPatientData) {
                $data[] = $vaccinatedPatientData->prepareVaccinationData();
            }
            
            return $this->sendResponse($data, "Noticeboard Retrieved Successfully");
        }
    }
}
