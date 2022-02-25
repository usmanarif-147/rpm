<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::ADMIN_DASHBOARD;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm()
    {
        return view('admin.auth.admin_login');
    }

    public function login(LoginRequest $request)
    {
        $request->validated();

        $attempt = Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember);
        if ($attempt) {
            return redirect()->intended(route('admin.dashboard'));
        }
        if(!$attempt){
            return redirect()->back()->with('failed', 'Password or email does not match');
        }
        return redirect()->back();
    }


    public function logout(Request $request)
    {
        $this->guard()->logout();

//        $request->session()->invalidate();

        return redirect()->route('admin.login.form');
    }


    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }
}
