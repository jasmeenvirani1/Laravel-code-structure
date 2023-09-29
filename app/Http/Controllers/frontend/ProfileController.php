<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Request;
use App\Models\Certificate;
use App\Models\Keyword;
use App\Models\Service;
use App\Models\Subscription;
use App\Models\User;

class ProfileController extends Controller
{

    public $modual_name = "";
    public $title = "";
    public $view = "";
    public $userData;

    public function __construct()
    {
        $this->view = 'front.profile';
        $this->title = 'Profie';
        $this->modual_name = 'Profile';

        $this->middleware(function ($request, $next) {
            $this->userData = session('UserSession');
            return $next($request);
        });
    }

    public function GetProfile($id)
    {
        $user = User::where('id', $id)->get('role_id');
        if (!isset($user[0])) {
            prx('Nof found');
        } else {
            $role_id = $user[0]->role_id;
        }
        if ($role_id == 2) {
            $return_data = [];
            $return_data['site_title'] = trans($this->title);
            $return_data['sub_header'] = $this->title;
            $userId = $id;
            $userData = User::join('providers', 'providers.user_id', '=', 'users.id')->where('users.id', $userId)->get(['users.*', 'providers.city', 'providers.about']);
            $serviceData = Service::join('users_services', 'users_services.service', '=', 'services.id')->where('users_services.user_id', $userId)->get();
            $keywordData = Keyword::where('user_id', $userId)->get();

            $return_data['service_list'] = $serviceData;
            $return_data['keyword_list'] = $keywordData;
            $return_data['certificate_list'] = Certificate::where('user_id', $userId)->get();
            $return_data['user_data'] = $userData[0];

            $return_data['owner'] = 'provider';

            return view($this->view, array_merge($return_data));
        } else if ($role_id == 3) {
            $return_data = [];
            $return_data['site_title'] = trans($this->title);
            $return_data['sub_header'] = $this->title;
            $userId = $id;
            $userData = User::join('seekers', 'seekers.user_id', '=', 'users.id')->where('users.id', $userId)->get(['users.*','seekers.about']);
            $serviceData = Service::join('users_services', 'users_services.service', '=', 'services.id')->where('users_services.user_id', $userId)->get();
            $keywordData = Keyword::where('user_id', $userId)->get();

            $return_data['service_list'] = $serviceData;
            $return_data['keyword_list'] = $keywordData;
            $return_data['certificate_list'] = Certificate::where('user_id', $userId)->get();
            $return_data['user_data'] = $userData[0];

            return view('front.seeker-profile', array_merge($return_data));
        }
    }

    public function GetSeekerProfile()
    {

        $userData = $this->userData;
        $userId = $userData['id'];
        $return_data['site_title'] = trans($this->title);
        $return_data['sub_header'] = $this->title;
        $userData = User::join('seekers', 'seekers.user_id', '=', 'users.id')->where('users.id', $userId)->get();
        $return_data['user_data'] = $userData;
        $return_data['owner'] = 'seeker';
        return view($this->view, array_merge($return_data));
    }
}
