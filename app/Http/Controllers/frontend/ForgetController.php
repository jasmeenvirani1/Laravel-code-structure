<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ForgetPassword;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ForgetController extends Controller
{
    public $userData;
    public function __construct()
    {
        // $this->middleware(function ($request, $next) {
        //     $this->userData = session('UserSession');
        //     return $next($request);
        // });
    }

    public function Index()
    {
        return view('front.match.index');
    }

    public function CheckEmail(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
        ]);
        $data = User::where('email', $request->email);
        if ($data->count() == "1") {
            $arr = array();
            $arr['user_id'] = $data[0]->id;
            $arr['token'] = $this->RandomString(20);
            $arr['created_at'] = GetDateTime();
            $arr['updated_at'] = GetDateTime();
            ForgetPassword::insert($arr);

            $msg = "Mail sent succesfully";
        } else {
            $msg = "Email not found in our record";
        }
        return response()->json([
            'status' => 1,
            'message' => $msg,
        ]);
    }
    public function GetForgetPassword($token)
    {
        $tokenData = ForgetPassword::where('token', $token)->where('status', '1')->where('deleted', '1');
        if ($tokenData->count() == 1) {
            $return_data['token'] = $token;
            $return_data['data'] = $tokenData;
            return view();
        } else {
            return response()->json([
                'status' => 1,
                'message' => 'This Link is expir :(.',
            ]);
        }
    }
    public function SetPassword(Request $request)
    {
        $tokenData = ForgetPassword::where('token', $request->token)->where('status', '1')->where('deleted', '1');
        if ($tokenData->count() == 1) {
            $tokenData = $tokenData->get();
            $user_id = $tokenData[0]->user_id;

            ForgetPassword::where('user_id', $user_id)->update(['status' => '0']);
            $password = Hash::make($request->password);
            User::where('id', $user_id)->update(['password', $password]);
        }

        return response()->json([
            'status' => 1,
            'message' => 'Password change succesfully.',
        ]);
    }
    function RandomString($len)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randstring = '';
        for ($i = 0; $i < $len; $i++) {
            $randstring = $characters[rand(0, strlen($characters))];
        }
        return $randstring;
    }
}
