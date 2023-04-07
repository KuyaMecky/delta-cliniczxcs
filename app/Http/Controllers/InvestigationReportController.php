<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateInvestigationReportRequest;
use App\Http\Requests\UpdateInvestigationReportRequest;
use App\Models\Document;
use App\Models\InvestigationReport;
use App\Models\Patient;
use App\Models\User;
use App\Queries\InvestigationReportDataTable;
use App\Repositories\InvestigationReportRepository;
use Carbon\Carbon;
use DataTables;
use Exception;
use Flash;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Storage;
use Str;

class InvestigationReportController extends AppBaseController
{
    /** @var InvestigationReportRepository */
    private $investigationReportRepository;

    public function __construct(InvestigationReportRepository $investigationReportRepo)
    {
        $this->investigationReportRepository = $investigationReportRepo;
    }

    /**
     * Display a listing of the InvestigationReport.
     *
     * @param  Request  $request
     *
     * @throws Exception
     *
     * @return Factory|View
     */
    public function index()
    {
        $data['statusArr'] = InvestigationReport::STATUS_ARR;

        return view('investigation_reports.index', $data);
    }

    /**
     * Show the form for creating a new InvestigationReport.
     *
     * @return Factory|View
     */
    public function create()
    {
        $status = InvestigationReport::STATUS;
        $patients = $this->investigationReportRepository->getPatients();
        $doctors = $this->investigationReportRepository->getDoctors();

        return view('investigation_reports.create', compact('status', 'patients', 'doctors'));
    }

    /**
     * Store a newly created InvestigationReport in storage.
     *
     * @param  CreateInvestigationReportRequest  $request
     *
     * @return RedirectResponse|Redirector
     */
    public function store(CreateInvestigationReportRequest $request)
    {
        $input = $request->all();
        $patientId = Patient::with('patientUser')->whereId($input['patient_id'])->first();
        $birthDate = $patientId->patientUser->dob;
        $reportDate = Carbon::parse($input['date'])->toDateString();
        if (! empty($birthDate) && $reportDate < $birthDate) {
            Flash::error('Investigation report date should not be smaller than patient birth date.');

            return redirect()->back()->withInput($input);
        }
        $this->investigationReportRepository->store($input);
        Flash::success(__('messages.investigation_report.investigation_report') . ' ' . __('messages.common.saved_successfully'));

        return redirect(route('investigation-reports.index'));
    }

    /**
     * @param  InvestigationReport  $investigationReport
     *
     * @return Factory|RedirectResponse|Redirector|View
     */
    public function show(InvestigationReport $investigationReport)
    {
        $investigationReport = $this->investigationReportRepository->find($investigationReport->id);
        if (empty($investigationReport)) {
            Flash::error('Investigation Report not found');

            return redirect(route('investigation-reports.index'));
        }

        return view('investigation_reports.show')->with('investigationReport', $investigationReport);
    }

    /**
     * Show the form for editing the specified InvestigationReport.
     *
     * @param  InvestigationReport  $investigationReport
     *
     * @return Factory|View
     */
    public function edit(InvestigationReport $investigationReport)
    {
        $status = InvestigationReport::STATUS;
        $patients = $this->investigationReportRepository->getPatients();
        $doctors = $this->investigationReportRepository->getDoctors();
        $fileExt = pathinfo($investigationReport->attachment_url, PATHINFO_EXTENSION);

        return view('investigation_reports.edit',
            compact('investigationReport', 'status', 'patients', 'doctors', 'fileExt'));
    }

    /**
     * Update the specified InvestigationReport in storage.
     *
     * @param  InvestigationReport  $investigationReport
     * @param  UpdateInvestigationReportRequest  $request
     *
     * @return RedirectResponse|Redirector
     */
    public function update(InvestigationReport $investigationReport, UpdateInvestigationReportRequest $request)
    {
        if (empty($investigationReport)) {
            Flash::error('Investigation Report not found');

            return redirect(route('investigation-reports.index'));
        }
        $input = $request->all();
        $patientId = Patient::with('patientUser')->whereId($input['patient_id'])->first();
        $birthDate = $patientId->patientUser->dob;
        $reportDate = Carbon::parse($input['date'])->toDateString();
        if (! empty($birthDate) && $reportDate < $birthDate) {
            Flash::error(__('messages.investigation_report.birth_date_validation'));

            return redirect()->back()->withInput($input);
        }
        $this->investigationReportRepository->update($input, $investigationReport->id);
        Flash::success(__('messages.investigation_report.investigation_report') . ' ' . __('messages.common.updated_successfully'));

        return redirect(route('investigation-reports.index'));
    }

    /**
     * Remove the specified InvestigationReport from storage.
     *
     * @param  InvestigationReport  $investigationReport
     *
     * @throws Exception
     *
     * @return JsonResponse
     */
    public function destroy(InvestigationReport $investigationReport)
    {
        $investigationReport->delete();

        return $this->sendSuccess(__('messages.investigation_report.investigation_report') . ' ' . __('messages.common.deleted_successfully'));
    }

    /**
     * @param  InvestigationReport  $investigationReport
     *
     * @throws FileNotFoundException
     *
     * @return ResponseFactory|\Illuminate\Http\Response
     */
    public function downloadMedia(InvestigationReport $investigationReport)
    {
        /** @var Media $documentMedia */
        $documentMedia = $investigationReport->media[0];
        $documentPath = $documentMedia->getPath();
        if (config('app.media_disc') === 'public') {
            $documentPath = (Str::after($documentMedia->getUrl(), '/uploads'));
        }

        $file = Storage::disk(config('app.media_disc'))->get($documentPath);

        $headers = [
            'Content-Type'        => $investigationReport->media[0]->mime_type,
            'Content-Description' => 'File Transfer',
            'Content-Disposition' => "attachment; filename={$investigationReport->media[0]->file_name}",
            'filename'            => $investigationReport->media[0]->file_name,
        ];

        return response($file, 200, $headers);
    }
}
