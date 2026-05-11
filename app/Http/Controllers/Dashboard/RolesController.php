<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Roles\StoreRoleRequest;
use App\Http\Requests\Dashboard\Roles\UpdateRoleRequest;
use App\Services\Contracts\RoleServiceInterface;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class RolesController extends Controller
{
    public function __construct(private RoleServiceInterface $roleService){}
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()){
            return $this->roleService->getDatatable();
        }
        return view("Dashboard.Roles.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("Dashboard.Roles.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        $createRole = $this->roleService->store($request->validated());
        if ($createRole){
            return redirect()->route('dashboard.roles')->with("success", "نقش با موفقیت ثبت شد");
        } else {
            return redirect()->back()->with("failed", "خطایی در ثبت نقش رخ داد");
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
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('Dashboard.Roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $updateRole = $this->roleService->update($request->validated(), $role);
        if ($updateRole){
            return redirect()->route('dashboard.roles')->with("success", "نقش با موفقیت ویرایش شد");
        } else {
            return redirect()->back()->with("failed", "خطایی در ویرایش نقش رخ داد");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $deleteRole = $this->roleService->delete($role);
        if ($deleteRole){
            return redirect()->route('dashboard.roles')->with("success", "نقش با موفقیت حذف شد");
        } else {
            return redirect()->back()->with("failed", "خطایی در حذف نقش رخ داد");
        }
    }

    public function multiDelete(Request $request){
        $request->validate([
            'roles' => ['required', 'array']
        ]);
        $deleteRoles = $this->roleService->multiDelete($request->input('roles'));
        if ($deleteRoles){
            return redirect()->back()->with('success', 'نقش ها با موفقیت حذف شدند');
        } else {
            return redirect()->back()->with('failed', 'متاسفانه نقش ها حذف نشدند');
        }
    }
}
