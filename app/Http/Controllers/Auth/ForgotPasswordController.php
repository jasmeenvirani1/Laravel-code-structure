<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Brian2694\Toastr\Facades\Toastr;
use URL;
use DB;
use Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Redirect;
use Cookie;
use Illuminate\Support\Facades\Crypt;

class ForgotPasswordController extends Controller
{
    public function View(Request $request)
    {
        $return_data = array();
        $return_data['site_title'] = 'Forgot Password' . ' | ' . $this->data['site_title'];
        return view('front.forgot_password', array_merge($return_data));
    }

    public function EmailPassword(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required',

        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors([
                'email' => 'The  email field is required.',
            ])->withinput();
        }

        $email = $request->email;
        $data = User::where('email', $email)->first();
        if ($data) {
            if ($data->status == '0') {
                $message = 'Your Account is InActive Please contact Support Team';
            } elseif ($data->deleted == '0') {
                $message = 'Your Account is Suspended Please contact Support Team';
            } else {
                $update_status = DB::table('password_resets')->insert([
                    'email' => $email,
                    'token' => Str::random(30),
                    'created_at' => Carbon::now()
                ]);
                if ($update_status) {
                    $tokenData = DB::table('password_resets')
                        ->where('email', $email)->first();
                    $token = $tokenData->token;
                    $data = [
                        'email' => Crypt::encryptString($email),
                        'token' => $token,
                    ];

                    Mail::send('front.email.pwd_reset', $data, function ($message) use ($email) {
                        $message->to($email)->subject('Password reset Request');
                    });
                    \Session::flash("message", "Password reset link has been sent to register email.");
                    return redirect()->back();
                }
            }
            return redirect()->back()->withErrors(['email' => $message,])->withinput();
        } else {
            return redirect()->back()->withErrors([
                'email' => 'Invalid Email id ! please contact admin',
            ])->withinput();
        }
        \Session::flash("message", "Password reset link has been sent to the email.");
        return redirect()->back();
    }

    public function ResetPassword(Request $request)
    {
        $return_data = array();
        $return_data['email'] = '';
        $return_data['token'] = '';
        $error = '';
        $return_data['site_title'] = 'Reset Password' . ' | ' . $this->data['site_title'];

        $request->session()->forget('error');
        if (isset($request->t)  && isset($request->t)) {
            try {
                $email = Crypt::decryptString($request->e);
                $tokenData = DB::table('password_resets')
                    ->where('token', $request->t)->where('email',  $email)->first();
                if ($tokenData) {
                    $return_data['email'] = $request->e;
                    $return_data['token'] = $request->t;
                } else {
                    $error = "Invalid Token or email";
                }
            } catch (\Exception $e) {
                $error = "Invalid Token or email";
            }
        } else {
            $error = "Invalid Token or email";
        }
        if ($error != '') {
            \Session::flash("error", $error);
        }
        return view('front.reset_password', array_merge($return_data));
    }
    public function UpdatePassword(Request $request)
    {

        $request->validate([
            'new_password' => 'min:6|required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'min:6'
        ]);


        if (isset($request->email)  && isset($request->token)) {
            try {

                $email = Crypt::decryptString($request->email);
                $updatePassword = DB::table('password_resets')
                    ->where([
                        'email' => $email,
                        'token' => $request->token
                    ])
                    ->first();
                if (!$updatePassword) {
                    \Session::flash("message", 'Invalid email or  token!');
                    return back()->withInput();
                }

                $user = User::where('email', $email)
                    ->update(['password' => Hash::make($request->password)]);
                DB::table('password_resets')->where(['email' => $email])->delete();
                \Session::flash("message", 'Your password has been changed!');
                return redirect(route('login'));
            } catch (\Exception $e) {
                return redirect(route('login'))->with('error', 'Invalid Token or email');
            }
        } else {
            return redirect(route('login'))->with('error', 'Something went wrong please try again');
        }
    }
}
