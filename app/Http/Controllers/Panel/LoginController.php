<?php

namespace App\Http\Controllers\Panel;

use App\Events\UserLoggedIn;
use App\Events\UserRegistered;
use App\Http\Controllers\Controller;
use App\Models\Users;
use App\Services\Contracts\FileServiceInterface;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Spatie\Activitylog\Facades\Activity;

class LoginController extends Controller
{

    public function __construct(private FileServiceInterface $fileService){}
    public function login(){
        if (Auth::check()){
            return redirect()->route('panel.index');
        } else {
            return view('Panel.login');
        }
    }

    public function doLogin(Request $request){
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);
        $email = $request->input("email");
        $password = $request->input("password");
        $remember = false;
        if ($request->filled('remember')){
            $remember = 1;
        }
        if (!Auth::attempt($request->only('email', 'password'), $remember)){
            throw ValidationException::withMessages([
                'email' => ['ایمیل یا رمز عبور اشتباه است'],
            ]);
        } else {
            $request->session()->regenerate();
            event(new UserLoggedIn(auth()->user()));
            return redirect()->route("panel.index");
        }
    }

    public function register(){
        return view("Panel.register");
    }

    public function doRegister(Request $request){
        $request->validate([
            'name' => ['required', 'string'],
            'family' => ['required', 'string'],
            'email' => ['required', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(8)->letters()->mixedCase()->numbers()->symbols()]
        ]);
        $userData = $request->except('_token');
        if ($request->has('avatar')){
            $userData['avatar'] = $this->fileService->upload($request->file('avatar'), 'users');
        }
        $createUser = Users::create($userData);
        if ($createUser){
            event(new UserRegistered($createUser));
            if (!Auth::attempt($request->only('email', 'password'), false)){
                throw ValidationException::withMessages([
                    'email' => ['ایمیل یا رمز عبور اشتباه است'],
                ]);
            } else {
                $request->session()->regenerate();
                return redirect()->route("panel.index");
            }
        } else {
            return redirect()->back()->with('failed', 'متاسفانه خطایی در ثبت نام رخ داد مجدد تلاش کنید');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('panel.login')->with("success", "با موفقیت از حساب کاربری خارج شدید");
    }
}
