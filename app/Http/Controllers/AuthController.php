<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;




class AuthController extends Controller
{
    // عرض صفحة تسجيل الدخول
    public function showLogin()
    {
        return view('auth.login');
    }

    // معالجة تسجيل الدخول
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/home');
        }

        return back()->withErrors(['email' => __('messages.invalid_credentials')])->withInput();
    }

    // عرض صفحة التسجيل
    public function showRegister()
    {
        return view('auth.register');
    }

    // معالجة التسجيل
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email'=> $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);
        return redirect('/home');


    }
    // عرض صفحة نسيت كلمة المرور
public function showForgotPassword()
{
    return view('auth.forgot-password');
}


// عرض صفحة إعادة تعيين كلمة المرور
public function showResetPassword($token)
{
    return view('auth.reset-password', compact('token'));
}

// تحديث كلمة المرور
public function resetPassword(Request $request)
{
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|confirmed|min:6',
    ]);

    $status = Password::reset(
        $request->only(
            'email',
            'password',
            'password_confirmation',
            'token'
        ),
        function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password),
            ])->save();
        }
    );

    return $status === Password::PASSWORD_RESET
        ? redirect()->route('login')->with('status', __('messages.password_reset_success'))
        : back()->withErrors(['email' => __($status)]);
}

public function sendResetLink(Request $request)
{
    $request->validate([
        'email' => ['required', 'email', 'exists:users,email'],
    ], [
        'email.exists' => __('messages.email_not_found'),
    ]);

    // نرسل الرابط (حتى لو الإيميل ما يوصل حالياً)
    Password::sendResetLink(
        $request->only('email')
    );

    // ⬅️ التحويل للصفحة الرئيسية
    return redirect()->route('home')
        ->with('status', __('messages.password_reset_link_sent'));
}


}
