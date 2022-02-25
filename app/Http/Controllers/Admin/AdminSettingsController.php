<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Models\Admin\Admin;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminSettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function changePasswordForm()
    {

        return view('admin.auth.change_password');
    }

    public function updateNewPassword(Request $request)
    {
//        $validate = $request->validated();

        $validate = Validator::make($request->all(), [
            'old_password' => ['required', 'min:5' , new MatchOldPassword()],
            'new_password' => 'required|min:5',
            'new_confirm_password' => 'same:new_password',
        ],[
            'old_password.required' => 'Old password is required',
            'new_password.required' => 'Password field is required',
            'new_confirm_password.same' => 'New Password and confirm password must match',
        ]);
        if($validate->fails()){
            return response()->json([
                'title' => 'Error',
                'text' => $validate->errors()->all(),
                'status' => 0
            ]);
        }
        Admin::find(auth()->user()->id)
            ->update(['password' => Hash::make($request->new_password)]);
        return response()->json([
            'title' => "Password update!",
            'text' => "Password updated successfully!",
            'status' => 1
        ]);

    }
}
