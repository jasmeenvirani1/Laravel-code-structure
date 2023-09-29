<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CardDetail;
use App\Models\Seeker;
use App\Models\User;
use App\Models\PrivacyDeatil;
use Illuminate\Support\Facades\Hash;

class UserSettingController extends Controller
{
    public $modual_name = "";
    public $title = "";
    public $view = "";
    public $userData = "";

    public function __construct()
    {
        $this->modual_name = 'permission';
        $this->title = 'Permission';
        $this->view = 'backend.user-setting.';
        $this->middleware(function ($request, $next) {
            $this->userData = session('UserSession');
            return $next($request);
        });
    }

    public function Index(Request $request)
    {
        $return_data = [];
        $userData = User::where('id', $this->userData['id'])->get();
        $return_data['privacy_deatil'] = PrivacyDeatil::where('user_id', $this->userData['id'])->get();

        $return_data['user_data'] = $userData;
        $return_data['site_title'] = trans($this->title);
        if ($this->userData['role_id'] == '2') {
            $return_data['card_detail'] = CardDetail::where('user_id', $this->userData['id'])->get();
        }
        $return_data[''] = trans($this->title);
        return view($this->view . 'index', array_merge($return_data));
    }

    public function UpdateUser(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $this->userData['id'],
            'location' => 'required'
        ]);

        $updatArr = [
            'name' => $request->name,
            'email' => $request->email,
            'location' => $request->location,
            'instagram' => $request->instagram,
            'tiktok' => $request->tiktok,
            'facebook' => $request->facebook,
            'youtube' => $request->youtube,
            'twitter' => $request->twitter,
            'linkedin' => $request->linkedin,
        ];
        User::where('id', $this->userData['id'])->update($updatArr);


        return response()->json([
            'status' => 200,
            'message' => 'User Setting Update succesfully',
        ]);
    }
    public function UpdatePrivacy(Request $request)
    {
        $privacyData = $request->all();
        $userId = $this->userData['id'];
        $privacy = array('profile_public', 'chat_button', 'email', 'social_media_link', 'location');
        $updateData = array('profile_public' => '0', 'chat_button' => '0', 'email' => '0', 'social_media_link' => '0', 'location' => '0');
        foreach ($privacy as $value) {
            if (array_key_exists($value, $privacyData)) {
                $updateData[$value] = '1';
            }
        }
        PrivacyDeatil::where('user_id', $userId)->update($updateData);
        return response()->json([
            'status' => 200,
            'message' => 'Privacy Changed succesfully',
        ]);
    }
    public function UpdateNotification(Request $request)
    {
        $privacyData = $request->all();
        $userId = $this->userData['id'];

        $userData = array('login_time_notifaction', 'recive_email_notifaction', 'newsletter_notifaction');
        $updateData = array('login_time_notifaction' => '0', 'recive_email_notifaction' => '0', 'newsletter_notifaction' => '0');
        foreach ($userData as $value) {
            if (array_key_exists($value, $privacyData)) {
                $updateData[$value] = '1';
            }
        }
        User::where('id', $userId)->update($updateData);
        return response()->json([
            'status' => 200,
            'message' => 'Privacy Changed succesfully',
        ]);
    }
    public function UpdateSecurity(Request $request)
    {
        $two_factora_authorization = '0';
        $validated = $request->validate([
            'confirm_password' => 'same:password|min:4',
        ]);
        if (array_key_exists('two_factora_authorization', $request->all())) {
            $two_factora_authorization = '1';
        }
        User::where('id', $this->userData['id'])->update(['two_factora_authorization' => $two_factora_authorization]);
        if (strlen($request->confirm_password) > 4) {
            $password = Hash::make($request->confirm_password);
            User::where('id', $this->userData['id'])->update(['password' => $password]);
        }
        return response()->json([
            'status' => 200,
            'message' => 'Security Changed succesfully',
        ]);
    }
    public function UpdateBilling(Request $request)
    {
        $validated = $request->validate([
            'card_number' => 'required|min:16|max:16',
        ]);
        $renew_automatic = '0';
        if (array_key_exists('renew_automatic', $request->all())) {
            $renew_automatic = '1';
        }
        CardDetail::where('user_id', $this->userData['id'])->update(['renew_automatic' => $renew_automatic,'card_number'=>$request->card_number]);
        return response()->json([
            'status' => 200,
            'message' => 'Payment detail Changed succesfully',
        ]);
    }
}
