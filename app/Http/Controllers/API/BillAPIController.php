<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Models\Bill;

class BillAPIController extends AppBaseController
{

    public function index()
    {
        if(getLoggedinPatient())
        {
            $bills = Bill::where('patient_id', getLoggedInUser()->patient->id)->get();
            $data = [];
            foreach ($bills as $bill) {
                $data[] = $bill->prepareBills();
            }

            return $this->sendResponse($data, "Bills Retrieved Successfully");   
        }
    }

    public function show($id)
    {
        $bill = Bill::with(['billItems.medicine', 'patient', 'patientAdmission'])->find($id);

        return $this->sendResponse($bill->prepareBillDetails(), "Bill Retrieved Successfully");
    }
}
