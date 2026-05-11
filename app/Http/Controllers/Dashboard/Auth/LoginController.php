<?php

namespace App\Http\Controllers\Dashboard\Auth;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function index(){
        if (Auth::check() && (auth()->user()->hasRole("super") || auth()->user()->hasRole("admin"))){
            return redirect()->route("dashboard.index");
        } else{
            return view("Dashboard.Auth.login");
        }
        
    }

    public function authLogin(Request $request){
        $email = $request->input("email");
        $password = $request->input("password");
        if (!Auth::attempt($request->only('email', 'password'), true)){
            throw ValidationException::withMessages([
                'email' => ['ایمیل یا رمز عبور اشتباه است'],
            ]);
        } else {
            return redirect()->route("dashboard.index");
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
