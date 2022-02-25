<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Providers\RouteServiceProvider;
use http\Env\Response;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManagerLoginController extends Controller
{
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::MANAGER_DASHBOARD;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:manager')->except('logout');
    }

    public function showLoginForm()
    {
        return view('manager.auth.manager_login');
    }

    public function login(LoginRequest $request)
    {
        $request->validated();

        if (Auth::guard('manager')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            return response()->json([
                'status' => 1
            ]);
        }

        return response()->json([
            'title' => 'Error',
            'text' => 'Password or email does not match',
            'status' => 0
        ]);
    }


    public function logout(Request $request)
    {
        $this->guard()->logout();

        return redirect()->route('manager.login.form');
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('manager');
    }
}
