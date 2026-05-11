<?php

namespace App\Services;

use App\Events\Dashboard\AdminActions;
use App\Services\Contracts\RoleServiceInterface;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class RoleService implements RoleServiceInterface{
    public function getDatatable(){
        $roles = Role::orderByDesc("id");
            return DataTables::of($roles)
                ->addColumn("actions", function ($roles){
                    return '<a href="' . route('dashboard.roles.destroy' , ['role' => $roles->id]) .'">
                                <button type="button" class="btn btn-icon btn-danger">
                                <span class="tf-icons bx bx-trash-alt"></span>
                                </button>
                            </a>
                            <a href="' . route('dashboard.roles.edit' , ['role' => $roles->id]) .'">
                                <button type="button" class="btn btn-icon btn-primary">
                                <span class="tf-icons bx bx-edit-alt"></span>
                                </button>
                            </a>';
                })
                ->rawColumns(['actions'])
                ->make(true);
    }

    public function store(array $data){
        $createRole = Role::create($data);
        event(new AdminActions(['causer' => auth()->user(), 'model' => $createRole], 'create', 'role'));
        return $createRole;
    }

    public function update(array $data, Role $role){
        $roleUpdated = $role->update($data);
        $role->syncPermissions($data['permissions']);
        event(new AdminActions(['causer' => auth()->user(), 'model' => $role], 'update', 'role'));
        return $roleUpdated;
    }

    public function delete(Role $role){
        $deleteRole = $role->delete();
        event(new AdminActions(['causer' => auth()->user(), 'model' => $role], 'delete', 'role'));
        return $deleteRole;
    }

    public function multiDelete(array $ids) {
        $roles = Role::whereIn("id", $ids)->get();
        $deleteRoles = Role::whereIn("id", $ids)->delete();
        foreach ($roles as $role){
            event(new AdminActions(['causer' => auth()->user(), 'model' => $role], 'delete', 'role'));
        }
        return $deleteRoles;
    }
}