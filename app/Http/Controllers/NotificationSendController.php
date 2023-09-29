<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class NotificationSendController extends Controller
{
    public $userData;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->userData = session('UserSession');
            return $next($request);
        });
    }

    public function index()
    {
        return view('notify');
    }

    public function updateDeviceToken(Request $request)
    {
        $user_id = $this->userData['id'];
        $device_token = $request->token;
        User::where('id', $user_id)->update(['device_token' => $device_token]);
        return response()->json(['Token successfully stored.']);
    }

    public function sendNotification($userid = 1, $title = "sdfsdf", $message = "f")
    {
        $url = 'https://fcm.googleapis.com/fcm/send';

        $FcmToken = User::where('id', $userid)->pluck('device_token')->all();

        $serverKey = env('FCMSERVERKEY');

        $data = [
            "registration_ids" => $FcmToken,
            "notification" => [
                "title" => $title,
                "body" => $message,
            ],
        ];
        $encodedData = json_encode($data);

        $headers = [
            'Authorization:key=' . $serverKey,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);
        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        // Close connection
        curl_close($ch);
        // FCM response
        // dd($result);
        // Prx($result);
    }
}
