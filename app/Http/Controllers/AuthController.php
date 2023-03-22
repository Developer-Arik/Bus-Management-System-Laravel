<?php

namespace App\Http\Controllers;

use App\Mail\EmailVerification;
use App\Mail\ForgotPassword;
use App\Models\Otp;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Config;

class AuthController extends Controller
{
    function login(Request $request){
        $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);

        $user = User::where('email',$request->email)->first();

        if(User::where('email',$request->email)->count()===0){
            return redirect()->back()->withErrors(['email' => 'Email not Found'])->withInput();
        }

        if(Hash::check($request->password,$user->password)){
            if($user->hasVerifiedEmail()) {
                Auth::loginUsingId($user->id,true);

                return redirect('/');
            }else{
                $otp = rand(1234,9999);

                Otp::create(["email" => $request->email,"otp" => $otp,"attempt" => 'verifyEmail',"expires_at" => Carbon::now()->addMinutes(2)]);

                Mail::to($request->email)->send(new EmailVerification($user->name,$otp));

                $request->session()->put("verify-email",["email" => $request->email,
                "code" => $otp]);

                return redirect('/verify-email');
            };
        }else{
            return redirect()->back()->withErrors(['password' => 'Password Incorrect'])->withInput();
        }
    }
    function register(Request $request){
        $request->validate([
            "name" => "required|min:10",
            "email" => "required|email|unique:users,email",
            "password" => "required|min:8",
            "confirm_password" => "required|same:password"
        ]);

        User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password)
        ]);

        $otp = rand(1234,9999);

        Otp::create(["email" => $request->email,"otp" => $otp,"attempt" => 'verifyEmail',"expires_at" => Carbon::now()->addMinutes(2)]);

        Mail::to($request->email)->send(new EmailVerification($request->name,$otp));

        $request->session()->put("verify-email",["email" => $request->email,
        "code" => $otp]);

        return redirect('/verify-email');
    }
    function logout(Request $request){
        Auth::logout();
        $request->session()->flush();

        return redirect('/');
    }
    function verifyEmail(Request $request){
        $email = $request->session()->get('verify-email')['email'];
        $user = User::where('email',$email)->first();

        $request->validate([
            "code" => "required"
        ]);
        $code = $request->code;

        $otp = Otp::where('otp',$code)->where('email',$email)->where('attempt','verifyEmail')->first();

        if($otp){
            if((int)$code===$otp->otp){
                if(Carbon::now()->isBefore(Carbon::parse($otp->expires_at))){

                    User::where(["id" => $user->id])->update([
                        "email_verified_at" => Carbon::now()
                    ]);

                    Auth::loginUsingId($user->id,true);

                    Otp::where('otp',$code)->where('email',$email)->update([
                        "expires_at" => Carbon::now()
                    ]);

                    $request->session()->forget('verify-email');

                    return redirect('/');
                }else{
                    return redirect()->back()->withErrors([
                        "code" => "OTP Expired"
                    ])->withInput();
                }
            }else{
                return redirect()->back()->withErrors([
                    "code" => "Invalid OTP"
                ])->withInput();
            }
        }else{
            return redirect()->back()->withErrors([
                "code" => "Invalid OTP"
            ])->withInput();
        }
    }
    function showVerifyEmail(Request $request){
        if($request->session()->get('verify-email')){
            $email = $request->session()->get('verify-email');

            $otp = Otp::where('email',$email)->get();

            $otpNumber = 0;

            for ($i=0; $i < sizeof($otp); $i++) {
                if(Carbon::now()->isBefore(Carbon::parse($otp[$i]->expires_at))===true){
                    $otpNumber++;
                }
            };

            if($otpNumber<1){
                return redirect()->route('login');
            }

            return view('auth.verifyemail',$email);
        }else{
            return abort(404);
        }
    }
    function sendForgotPassword(Request $request){
        $request->validate([
            "email" => "required|email"
        ]);

        $email = $request->email;

        if(User::where('email',$email)->count()===0){
            return response([
                "message" => "No Users Found"
            ],400);
        }

        $otp = rand(1000,9999);

        $otp = Otp::create(["email" => $email,"otp" => $otp,"attempt" => 'forgotPassword',"expires_at" => Carbon::now()->addMinutes(2)]);

        Mail::to($request->email)->send(new ForgotPassword(User::where('email',$email)->first()->name,$otp->otp));

        $request->session()->put("forgot-password",["email" => $request->email]);

        if($otp){
            return response([
                "message" => "An OTP verification code has been sent to $email"
            ],200);
        }else{
            return response([
                "message" => "Otp not send"
            ],400);
        }
    }
    function verifyForgotPassword(Request $request){
        $request->validate([
            "code" => "required"
        ]);

        $email = $request->email;
        $code = $request->code;

        $otp = Otp::where('email',$email)->where('otp',$code)->where('attempt','forgotPassword')->first();

        if($otp){
            if(Carbon::now()->isBefore(Carbon::parse($otp->expires_at))){
                Otp::where('otp',$code)->where('email',$email)->update([
                    "expires_at" => Carbon::now()
                ]);

                $userEmail = User::where('email',$email)->first()->email;

                $token = Str::random(60);

                DB::table('password_resets')->insert([
                    'email' => $userEmail,
                    'token' => $token,
                    'created_at' => Carbon::now()
                ]);

                return response([
                    "token" => $token
                ],200);
            }else{
                return response([
                    "message" => "OTP verification code expired"
                ],400);
            }
        }
        else{
            return response([
                "message" => "Invalid Code"
            ],400);
        }
    }
    function resetPassword(Request $request){
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|same:confirm_password',
            'confirm_password' => "required"
        ]);
        $expiresIn = Config::all()["auth"]["passwords"]["users"]["expire"];
        $row = DB::table('password_resets')->where('email', $request->email)->where('token',$request->token)->where('created_at','>',Carbon::now()->subMinutes($expiresIn))->get();

        if($row->count()<1){
            return abort(404);
        }

        $user = User::where('email',$request->email)->first();
        $user->update(['password' => Hash::make($request->password)]);

        Auth::login($user);

        return redirect('/');
    }
    function showResetPasswordForm(Request $request){
        $expiresIn = Config::all()["auth"]["passwords"]["users"]["expire"];
        $token = $request->route('token');
        $email = $request->session()->get('forgot-password')['email'];

        $row = DB::table('password_resets')->where('email', $email)->where('token',$token)->where('created_at','>',Carbon::now()->subMinutes($expiresIn))->get();

        if($row->count()<1){
            return abort(404);
        }

        return view('auth.resetPassword',['token' => $token,"email" => $email]);
    }
    function updateProfile(Request $request){
        $request->validate([
            "c_name" => "required",
            "cur_password" => "required",
            "c_password" => "required|min:10",
            "cnf_password" => "required|same:c_password"
        ]);
        $user = User::where('id',Auth::user()->id)->first();
        if(Hash::check($request->cur_password,$user->password)){
            $user->update([
                "password" => Hash::make($request->c_password)
            ]);

            return redirect()->route('profile')->with("Success","Information Updated Succesfully");
        }else{
            return redirect()->route('profile')->withErrors(['cur_password' => "Current Parrword Incorrect"])->withInput();
        }
    }
}
