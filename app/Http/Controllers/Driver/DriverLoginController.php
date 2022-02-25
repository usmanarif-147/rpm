<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DriverLoginController extends Controller
{
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::DRIVER_DASHBOARD;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:driver')->except('logout');
    }

    public function showLoginForm()
    {
        return view('driver.auth.driver_login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
                'email' => 'required|email',
                'password' => 'required|min:6'
            ]
        );

        if (Auth::guard('driver')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            return redirect()->intended(route('driver.dashboard'));
        }

        return redirect()->back()->withInput($request->only('email', 'remember'));
    }


    public function logout(Request $request)
    {
        $this->guard()->logout();

//        $request->session()->invalidate();

        return redirect()->route('driver.login.form');
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('driver');
    }
}
