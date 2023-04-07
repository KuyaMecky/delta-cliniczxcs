<?php

use App\Http\Controllers\API\AppointmentAPIController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BillAPIController;
use App\Http\Controllers\API\DocumentAPIController;
use App\Http\Controllers\API\InvoiceAPIController;
use App\Http\Controllers\API\LiveConsultationAPIController;
use App\Http\Controllers\API\NoticeboardAPIController;
use App\Http\Controllers\API\DiagnosisTestAPIController;
use App\Http\Controllers\API\PatientAdmissionAPIController;
use App\Http\Controllers\API\PrescriptionAPIController;
use App\Http\Controllers\API\PatientCaseAPIController;
use App\Http\Controllers\API\UserAPIController;
use App\Http\Controllers\API\VaccinatedPatientAPIController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

    Route::post('login', [AuthController::class, 'login']);
    Route::post('/forgot-password', [AuthController::class, 'sendPasswordResetLinkEmail'])->middleware('throttle:5,1')->name('password.email');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.reset');
    Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('logout', [AuthController::class, 'logout']);

    // update user profile
    Route::get('edit-profile', [UserAPIController::class, 'editProfile'])->name('edit-profile');
    Route::post('update-profile', [UserAPIController::class, 'updateProfile'])->name('update-profile');
    Route::patch('/change-password', [UserAPIController::class, 'changePassword'])->name('user.changePassword');

    //notice-boards
    Route::get('/notice-board', [NoticeboardAPIController::class, 'index']);
    Route::post('/notice-board-show/{id}', [NoticeboardAPIController::class, 'show']);


    Route::group(['middleware' => ['role:Admin|Patient']], function () {
        
        //Appointments
        Route::get('appointments', [AppointmentAPIController::class, 'index']);
        Route::post('/appointment-filter', [AppointmentAPIController::class, 'filter']);
        Route::post('/cancel-appointment', [AppointmentAPIController::class, 'cancelAppointment']);
        Route::post('/delete-appointment', [AppointmentAPIController::class, 'destroy']);
        Route::get('/doctor-department', [AppointmentAPIController::class, 'getDoctorDepartment']);
        Route::post('/doctor/{id}', [AppointmentAPIController::class, 'getDoctors']);
        Route::post('/slot-booking', [AppointmentAPIController::class, 'bookingSlots']);
        Route::post('/appointment-create', [AppointmentAPIController::class, 'store']);

        //Bills
        Route::get('bills', [BillAPIController::class, 'index']);
        Route::get('bills/{id}', [BillAPIController::class, 'show']);

        //Live Consultation
        Route::get('live-consultation', [LiveConsultationAPIController::class, 'index']);
        Route::get('live-consultation/{id}', [LiveConsultationAPIController::class, 'show']);

        //documents
        Route::get('/documents', [DocumentAPIController::class, 'index']);
        Route::get('/document-type', [DocumentAPIController::class, 'getDocumentTypes']);
        Route::post('/document-store', [DocumentAPIController::class, 'create']);
        Route::post('/document-update/{id}', [DocumentAPIController::class, 'update']);
        Route::get('/document-delete/{id}', [DocumentAPIController::class, 'destroy']);
        Route::get('/document-download/{id}', [DocumentAPIController::class, 'downloadDocs']);

        //Diagnosis Test
        Route::get('diagnosis', [DiagnosisTestAPIController::class, 'index']);
        Route::get('diagnosis/{id}', [DiagnosisTestAPIController::class, 'show']);
        //Patient Admissions
        Route::get('patient-admissions', [PatientAdmissionAPIController::class, 'index']);
        Route::get('patient-admissions/{id}', [PatientAdmissionAPIController::class, 'show']);


        //Patient Cases
        Route::get('patient-cases', [PatientCaseAPIController::class, 'index']);
        Route::get('patient-cases/{id}', [PatientCaseAPIController::class, 'show']);


        //vaccinated patient
        Route::get('/vaccinated-patient', [VaccinatedPatientAPIController::class, 'index']);

        //invoice 
        Route::get('/invoices', [InvoiceAPIController::class, 'index']);
        Route::get('/invoice/{id}', [InvoiceAPIController::class, 'show']);

        //Prescriptions
        Route::get('patient-prescription', [PrescriptionAPIController::class, 'index']);
        Route::get('patient-prescription/{id}', [PrescriptionAPIController::class, 'show']);

    });
});
