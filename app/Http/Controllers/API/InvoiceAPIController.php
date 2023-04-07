<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceAPIController extends AppBaseController
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
            $invoices = Invoice::where('patient_id', getLoggedInUser()->patient->id)->get();
            $data = [];
            foreach ($invoices as $invoice) {
                $data[] = $invoice->prepareInvoice();
            }
            return $this->sendResponse($data, "Invoices Retrieved Successfully");
        }
    }

    /**
     * @param $id
     *
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id): \Illuminate\Http\JsonResponse
    {
        $invoice = Invoice::with(['patient.patientUser','invoiceItems'])->find($id);
        
        return $this->sendResponse($invoice->prepareInvoiceDetails(), "Invoice Retrieved Successfully");
    }
}
