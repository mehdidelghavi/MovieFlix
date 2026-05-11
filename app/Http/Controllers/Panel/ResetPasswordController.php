<?php

namespace App\Http\Controllers\Panel;

use App\Events\UserPassword;
use App\Http\Controllers\Controller;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password as PwRule;

class ResetPasswordController extends Controller
{
    public function showResetForm(Request $request, $token){
        $email = $request->email;
        return view("Panel.reset-password", compact('token', 'email'));
    }

    public function reset(Request $request){
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', PwRule::min(8)->letters()->mixedCase()->numbers()->symbols()],
        ]);
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (Users $user, string $password) {
                $user->forceFill([
                    'password' => $password
                ])->save();
                event(new UserPassword($user));
            }
        );
        return $status === Password::PASSWORD_RESET
            ? redirect()->route('panel.login')->with('success', 'رمز عبور با موفقیت بازیابی شد')
            : back()->withErrors(['email' => [__($status)]]);
    }
}
