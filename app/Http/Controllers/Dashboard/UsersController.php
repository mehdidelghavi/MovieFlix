<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Users\StoreUserRequest;
use App\Http\Requests\Dashboard\Users\UpdateUserRequest;
use App\Models\Users;
use App\Services\Contracts\UserServiceInterface;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Morilog\Jalali\Jalalian;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class UsersController extends Controller
{

    public function __construct(private UserServiceInterface $userService){}
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()){
            return $this->userService->getDatatable();
        }
        $data = $this->userService->getData();
        return view("Dashboard.Users.index", ['roles' => $data['roles']]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = $this->userService->create();
        return view("Dashboard.Users.create", ['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $createUser = $this->userService->store($request->except('_token'));
        if ($createUser){
            return redirect()->back()->with('success','کاربر با موفقیت افزوده شد');
        } else {
            return redirect()->back()->with('failed','مشکلی در افزودن کاربر پیش آمد');
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
    public function edit(Users $user)
    {
        $userEditable = $user;
        $roles = $this->userService->edit($userEditable);
        return view("Dashboard.Users.edit", compact('userEditable', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, Users $user)
    {
        $updateUser = $this->userService->update($request->validated(), $user);
        if ($updateUser){
            return redirect()->route("dashboard.users")->with('success','کاربر با موفقیت ویرایش شد');
        } else {
            return redirect()->back()->with('failed','مشکلی در ویرایش کاربر پیش آمد');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Users $user)
    {
        $deleteUser = $this->userService->delete($user);
        if ($deleteUser){
            return redirect()->back()->with('success','کاربر با موفقیت حذف شد.');
        } else {
            return redirect()->back()->with('failed','متاسفانه کاربر حذف نشد.');
        }
    }

    public function multiDelete(Request $request){
        $request->validate([
            'users' => ['required', 'array']
        ]);
        $deleteUsers = $this->userService->multiDelete($request->input('users'));
        if ($deleteUsers){
            return redirect()->back()->with('success', 'کاربران با موفقیت حذف شدند');
        } else {
            return redirect()->back()->with('failed', 'متاسفانه کاربران حذف نشدند');
        }
    }
}
