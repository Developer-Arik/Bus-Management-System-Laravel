<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    function index(){
        if(Auth::guard('admin')->check()){
            return redirect('admin/dashboard');
        }

        return redirect('admin/login');
    }
    function login(Request $request){
        $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);

        $user = Admin::where('email',$request->email)->first();

        if(Admin::where('email',$request->email)->count()===0){
            return redirect()->back()->withErrors(['email' => 'Email not Found'])->withInput();
        }

        if(Hash::check($request->password,$user->password)){
            Auth::guard('admin')->loginUsingId($user->id,true);

            return redirect('admin/dashboard');
        }else{
            return redirect()->back()->withErrors(['password' => 'Password Incorrect'])->withInput();
        }
    }
    function logout(Request $request){
        Auth::guard('admin')->logout();
        $request->session()->flush();

        return redirect('/admin/login');
    }
    function updateProfile(Request $request){
        $request->validate([
            "name" => "required",
            "email" => "email|required",
            "password" => "required"
        ]);

        $user = Admin::where('email',$request->email)->first();

        if(Hash::check($request->password,$user->password)){
            Admin::where('id',$user->id)->update([
                "name" => $request->name,
                "email" => $request->email
            ]);

            return redirect()->back()->with('info-updated','Information Updated Succesfully');
        }else{
            return redirect()->back()->withErrors([
                "password" => "Password Incorrect"
            ])->withInput();
        }
    }
    function updatePassword(Request $request){
        $request->validate([
            "current_password" => "required",
            "password" => "required",
            "confirm_password" => "required|same:password"
        ]);

        $currentPassword = $request->current_password;
        $password = $request->password;

        $user = Admin::where('id',Auth::guard('admin')->user()->id)->first();

        if(Hash::check($currentPassword,$user->password)){
            $user->update([
                "password" => Hash::make($password)
            ]);

            return redirect()->back()->with('password-updated','Password Changed Succesfully');
        }else{
            return redirect()->back()->withErrors([
                "current_password" => "Password Incorrect"
            ])->withInput();
        }
    }
}
