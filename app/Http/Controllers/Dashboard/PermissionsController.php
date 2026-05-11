<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Permissions\StorePermissionRequest;
use App\Http\Requests\Dashboard\Permissions\UpdatePermissionRequest;
use App\Services\Contracts\PermissionServiceInterface;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\DataTables;

class PermissionsController extends Controller
{

    public function __construct(private PermissionServiceInterface $permissionService){}
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()){
            return $this->permissionService->getDatatable();
        }
        return view("Dashboard.Permissions.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("Dashboard.Permissions.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePermissionRequest $request)
    {
        $createPermission = $this->permissionService->store($request->validated());
        if ($createPermission){
            return redirect()->route('dashboard.permissions')->with("success", "مجوز با موفقیت ثبت شد");
        } else {
            return redirect()->back()->with("failed", "خطایی در ثبت مجوز رخ داد");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        return view("Dashboard.Permissions.edit", compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePermissionRequest $request, Permission $permission)
    {
        $updatePermission = $this->permissionService->update($request->validated(), $permission);
        if ($updatePermission){
            return redirect()->route('dashboard.permissions')->with("success", "مجوز با موفقیت ویرایش شد");
        } else {
            return redirect()->back()->with("failed", "خطایی در ویرایش مجوز رخ داد");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        $deletePermission = $this->permissionService->delete($permission);
        if ($deletePermission){
            return redirect()->route('dashboard.permissions')->with("success", "مجوز با موفقیت حذف شد");
        } else {
            return redirect()->back()->with("failed", "خطایی در حذف مجوز رخ داد");
        }
    }

    public function multiDelete(Request $request){
        $request->validate([
            'permissions' => ['required', 'array']
        ]);
        $deletePermissions = $this->permissionService->multiDelete($request->input('permissions'));
        if ($deletePermissions){
            return redirect()->back()->with('success', 'مجوز ها با موفقیت حذف شدند');
        } else {
            return redirect()->back()->with('failed', 'متاسفانه مجوز ها حذف نشدند');
        }
    }
}
