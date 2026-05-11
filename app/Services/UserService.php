<?php

namespace App\Services;

use App\Events\Dashboard\AdminActions;
use App\Events\Dashboard\UsersEvent;
use App\Models\Users;
use App\Services\Contracts\FileServiceInterface;
use App\Services\Contracts\UserServiceInterface;
use DB;
use Morilog\Jalali\Jalalian;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class UserService implements UserServiceInterface{

    public function getData(){
        $roles = Role::select('id', 'name', 'guard_name')->withCount('users')->where('guard_name', 'web')->get();
        $data = [
            'roles' => $roles
        ];
        return $data;
    }

    public function __construct(
        private FileServiceInterface $fileService
    ) {}
    public function getDatatable(){ 
            return DataTables::of(Users::select('id', 'avatar', 'email', 'phone', 'created_at', 'updated_at')->orderByDesc('id'))
            ->editColumn("name", function ($users){
                return $users->name . " " . $users->family;
            })
            ->editColumn("avatar", function ($users){
                if ($users->avatar != null){
                    return '<img src="' . asset("storage/users/" . $users->avatar) . '" width="80" height="80" style="border-radius: 15px;">';
                } else {
                    return "<div style='width: 80px;height:80px; background-color: #eee; border-radius: 15px;display: flex; align-items:center; justify-content:center'>No Picture</div>";
                }
            })
            ->editColumn("created_at", function ($users){
                return Jalalian::forge($users->created_at)->format("Y-m-d H:i:s");
            })
            ->editColumn("updated_at", function ($users){
                return Jalalian::forge($users->updated_at)->format("Y-m-d H:i:s");
            })
            ->addColumn('role', function ($users){
                $userRoles = $users->roles->pluck('name')->toArray();
                return implode(", ", $userRoles);
            })
            ->addColumn("actions", function ($users){
                return '<a href="' . route('dashboard.users.destroy' , ['user' => $users->id]) .'">
                            <button type="button" class="btn btn-icon btn-danger">
                              <span class="tf-icons bx bx-trash-alt"></span>
                            </button>
                        </a>
                        <a href="' . route('dashboard.users.edit' , ['user' => $users->id]) .'">
                            <button type="button" class="btn btn-icon btn-primary">
                              <span class="tf-icons bx bx-edit-alt"></span>
                            </button>
                        </a>';
            })
            ->rawColumns(["avatar", "actions"])
            ->make(true);
    }

    public function create(){
        return Role::all();
    }

    public function store(array $data){
        $data['phone'] = str_replace(' ','', $data['phone']);
        return DB::transaction(function () use ($data) {

            if (isset($data['avatar'])) {
                $data['avatar'] = $this->fileService->upload($data['avatar'], 'users');
            }
            $userCreated = Users::create($data);
            $userCreated->syncRoles($data['roles']);
            $userCreated->refresh();
            $eventData = [
                'causer' => auth()->user(),
                'model' => $userCreated
            ];
            event(new AdminActions($eventData, "create", "user"));
            return $userCreated;
        });
    }

    public function edit(Users $user){
        return Role::all();;
    }

    public function update(array $data, Users $user){
        $data['phone'] = str_replace(' ','', $data['phone']);
        if (isset($data['password'])){
            $userData['password'] = $data['password'];
        }
        if (!isset($data['roles'])){
            $data['roles'] = null;
        }
        return DB::transaction(function () use ($user,$data) {

            if (isset($data['avatar'])) {
                $this->fileService->delete('users/', $user->avatar);
                $data['avatar'] = $this->fileService->upload($data['avatar'], 'users');
            }

            $user->syncRoles($data['roles']);
            $user->refresh();
            auth()->user()->refresh();
            $eventData = [
                'causer' => auth()->user(),
                'model' => $user
            ];
            event(new AdminActions($eventData, "create", "user"));
            return $user->update($data);
        });
    }

    public function delete(Users $user){
        return DB::transaction(function () use ($user) {

            $this->fileService->delete('users/', $user->avatar);
            $eventData = [
                'causer' => auth()->user(),
                'model' => $user
            ];
            event(new AdminActions($eventData, "create", "user"));

            return $user->delete();
        });

    }

    public function multiDelete(array $ids) {
        return DB::transaction(function () use ($ids) {

            $users = Users::whereIn('id', $ids)->get();

            foreach ($users as $user) {
                $this->fileService->delete('users', $user->avatar);
                $eventData = [
                    'causer' => auth()->user(),
                    'model' => $user
                ];
                event(new AdminActions($eventData, "delete", "user"));
            }

            return Users::whereIn('id', $ids)->delete();
        });
    }
}