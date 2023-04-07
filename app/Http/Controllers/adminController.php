<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Models\admin;
use App\Models\User;
use App\Repositories\adminRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class adminController extends AppBaseController
{
    /** @var adminRepository $adminRepository*/
    private $adminRepository;

    public function __construct(adminRepository $adminRepo)
    {
        $this->adminRepository = $adminRepo;
    }

    /**
     * Display a listing of the admin.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('admins.index');
    }

    /**
     * Show the form for creating a new admin.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $bloodGroup = getBloodGroups();
        
        return view('admins.create', compact('bloodGroup'));
    }

    /**
     * Store a newly created admin in storage.
     *
     * @param CreateAdminRequest $request
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CreateAdminRequest $request)
    {
        $input = $request->all();
        $input['status'] = isset($input['status']) ? 1 : 0;

        $this->adminRepository->store($input);

        Flash::success(__('messages.admin') . ' ' . __('messages.common.saved_successfully'));

        return redirect(route('admins.index'));
    }

    /**
     * Display the specified admin.
     *
     * @param int $id
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function show($id)
    {
        $admin = $this->adminRepository->find($id);

        if (empty($admin)) {
            Flash::error('Admin not found');

            return redirect(route('admins.index'));
        }

        return view('admins.show')->with('admin', $admin);
    }

    /**
     * Show the form for editing the specified admin.
     *
     * @param \App\Models\User $admin
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(User $admin)
    {
        $bloodGroup = getBloodGroups();

        return view('admins.edit', compact('admin', 'bloodGroup'));
    }

    /**
     * Update the specified admin in storage.
     *
     * @param \App\Models\User $admin
     * @param UpdateAdminRequest $request
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(User $admin, UpdateAdminRequest $request)
    {
        $input = $request->all();
        $input['status'] = isset($input['status']) ? 1 : 0;
        
        $admin = $this->adminRepository->update($admin, $input);

        Flash::success(__('messages.admin') . ' ' . __('messages.common.updated_successfully'));

        return redirect(route('admins.index'));
    }

    /**
     * Remove the specified admin from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(User $admin): \Illuminate\Http\JsonResponse
    {
        $admin->delete();

        return $this->sendSuccess(__('messages.admin') . ' ' . __('messages.common.deleted_successfully'));
    }
    
    public function activeDeactiveStatus($id)
    {
        $admin = User::findOrFail($id);
        $status = ! $admin->status;
        $admin->update(['status' => $status]);

        return $this->sendSuccess(__('messages.common.status_updated_successfully'));
    }
}
