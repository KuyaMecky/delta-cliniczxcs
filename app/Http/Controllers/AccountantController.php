<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAccountantRequest;
use App\Http\Requests\UpdateAccountantRequest;
use App\Models\Account;
use App\Models\Secretary;
use App\Models\EmployeePayroll;
use App\Models\User;
use App\Queries\AccountantDataTable;
use App\Repositories\AccountantRepository;
use DataTables;
use Exception;
use Flash;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class AccountantController extends AppBaseController
{
    /** @var AccountantRepository */
    private $accountantRepository;

    public function __construct(AccountantRepository $accountantRepo)
    {
        $this->accountantRepository = $accountantRepo;
    }

    /**
     * Display a listing of the Secretary.
     *
     * @param  Request  $request
     *
     * @throws Exception
     *
     * @return Factory|View
     */
    public function index()
    {
        $data['statusArr'] = Secretary::STATUS_ARR;

        return view('accountants.index', $data);
    }

    /**
     * Show the form for creating a new Secretary.
     *
     * @return Factory|View
     */
    public function create()
    {
        $bloodGroup = getBloodGroups();

        return view('accountants.create', compact('bloodGroup'));
    }

    /**
     * Store a newly created Secretary in storage.
     *
     * @param  CreateAccountantRequest  $request
     *
     * @return RedirectResponse|Redirector
     */
    public function store(CreateAccountantRequest $request)
    {
        $input = $request->all();
        $input['status'] = isset($input['status']) ? 1 : 0;

        $accountant = $this->accountantRepository->store($input);

        Flash::success(__('messages.accountant.accountants') . ' ' . __('messages.common.saved_successfully'));

        return redirect(route('accountants.index'));
    }

    /**
     * Display the specified Secretary.
     *
     * @param  Secretary  $accountant
     *
     * @return Factory|View
     */
    public function show(Secretary $accountant)
    {
        $payrolls = $accountant->payrolls;

        return view('accountants.show', compact('accountant', 'payrolls'));
    }

    /**
     * Show the form for editing the specified Secretary.
     *
     * @param  Secretary  $accountant
     *
     * @return Factory|View
     */
    public function edit(Secretary $accountant)
    {
        $user = $accountant->user;
        $bloodGroup = getBloodGroups();

        return view('accountants.edit', compact('user', 'accountant', 'bloodGroup'));
    }

    /**
     * Update the specified Secretary in storage.
     *
     * @param  Secretary  $accountant
     * @param  UpdateAccountantRequest  $request
     *
     * @return RedirectResponse|Redirector
     */
    public function update(Secretary $accountant, UpdateAccountantRequest $request)
    {
        $input = $request->all();
        $input['status'] = isset($input['status']) ? 1 : 0;

        $accountant = $this->accountantRepository->update($accountant, $input);

        Flash::success(__('messages.accountant.accountants') . ' ' . __('messages.common.updated_successfully'));

        return redirect(route('accountants.index'));
    }

    /**
     * Remove the specified Secretary from storage.
     *
     * @param  Secretary  $accountant
     *
     * @throws Exception
     *
     * @return JsonResponse
     */
    public function destroy(Secretary $accountant)
    {
        $empPayRollResult = canDeletePayroll(EmployeePayroll::class, 'owner_id', $accountant->id, $accountant->user->owner_type);
        if ($empPayRollResult) {
            return $this->sendError(__('messages.accountant.accountants') . ' ' . __('messages.common.cant_be_deleted'));
        }
        $accountant->user()->delete();
        $accountant->address()->delete();
        $accountant->delete(); 

        return $this->sendSuccess(__('messages.accountant.accountants') . ' ' . __('messages.common.deleted_successfully'));
    }

    /**
     * @param  int  $id
     *
     * @return JsonResponse
     */
    public function activeDeactiveStatus($id)
    {
        $accountant = Secretary::findOrFail($id);
        $status = ! $accountant->user->status;
        $accountant->user()->update(['status' => $status]);

        return $this->sendSuccess(__('messages.common.status_updated_successfully'));
    }
}
