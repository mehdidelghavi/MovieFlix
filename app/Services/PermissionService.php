<?php

namespace App\Services;

use App\Events\Dashboard\AdminActions;
use App\Services\Contracts\PermissionServiceInterface;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\DataTables;

class PermissionService implements PermissionServiceInterface{
    public function getDatatable(){
        $permissions = Permission::orderByDesc("id");
        return DataTables::of($permissions)
            ->addColumn("actions", function ($permissions){
                return '<a href="' . route('dashboard.permissions.destroy' , ['permission' => $permissions->id]) .'">
                            <button type="button" class="btn btn-icon btn-danger">
                            <span class="tf-icons bx bx-trash-alt"></span>
                            </button>
                        </a>
                        <a href="' . route('dashboard.permissions.edit' , ['permission' => $permissions->id]) .'">
                            <button type="button" class="btn btn-icon btn-primary">
                            <span class="tf-icons bx bx-edit-alt"></span>
                            </button>
                        </a>';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function store(array $data){
        $createPermission = Permission::create($data);
        event(new AdminActions(['causer' => auth()->user(), 'model' => $createPermission], 'create', 'permission'));
        return $createPermission;
    }

    public function update(array $data, Permission $permission){
        $updatePermission = $permission->update($data);
        event(new AdminActions(['causer' => auth()->user(), 'model' => $permission], 'update', 'permission'));
        return $updatePermission;
    }

    public function delete(Permission $permission){
        $deletePermission = $permission->delete();
        event(new AdminActions(['causer' => auth()->user(), 'model' => $permission], 'delete', 'permission'));
        return $deletePermission;
    }

    public function multiDelete(array $ids) {
        $permissions = Permission::whereIn("id", $ids)->get();
        $deletePermissions = Permission::whereIn("id", $ids)->delete();
        foreach ($permissions as $permission){
            event(new AdminActions(['causer' => auth()->user(), 'model' => $permission], 'delete', 'permission'));
        }
        return $deletePermissions;
    }
}