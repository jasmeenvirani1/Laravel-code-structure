<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\UserService;


class MatchesController extends Controller
{
    public $modual_name = "";
    public $title = "";
    public $view = "";
    public $userData;


    public function __construct()
    {
        $this->modual_name = 'matches';
        $this->title = 'Matches';
        $this->view = 'backend.matches.';
        $this->middleware(function ($request, $next) {
            $this->userData = session('UserSession');
            return $next($request);
        });
    }

    public function Index(Request $request)
    {
        $return_data = [];

        $return_data['site_title'] = trans($this->title);
        $return_data['sub_header'] = $this->title;
        $userId = $this->userData['id'];
        // $return_data['flit_feed'] = GetSetting('flit-feed');

        $created_at = GetTodayDate();
        $created_at = date('Y-m-d', strtotime('-5 day', strtotime($created_at)));

        $sql = Answer::join('options', 'options.id', '=', 'answers.opction_id')->orderBy('answers.created_at', 'desc')->where('user_id', $userId)->where('status', '1')->take(5);
        $return_data['recent_provider_profile_image'] = $this->GetMatchProvider($sql);

        $sql = Answer::join('options', 'options.id', '=', 'answers.opction_id')->orderBy('answers.created_at', 'desc')->where('user_id', $userId)->where('status', '1')->where('answers.deleted', '1');
        $return_data['all_over_provider_profile_image'] = $this->GetMatchProvider($sql);

        $sql = Answer::join('options', 'options.id', '!=', 'answers.opction_id')->where('user_id', $userId);
        $return_data['suggested'] = $this->GetMatchProvider($sql);

        return view($this->view . 'index', array_merge($return_data));
    }

    public function ClearRecentall()
    {
        $userId = $this->userData['id'];
        Answer::where('user_id', $userId)->where('status', '1')->update(['status' => '0']);
        return response()->json([
            'status' => 200,
            'message' => 'Recent clear succesfully',
        ]);
    }

    public function ClearAll()
    {
        $userId = $this->userData['id'];
        $model = Answer::where('user_id', $userId)->where('status', '1')->update(['status' => '0', 'deleted' => '0']);
        return response()->json([
            'status' => 200,
            'message' => 'All provider clear succesfully',
        ]);
    }

    function GetMatchProvider($sql)
    {
        $answerData = $sql->get();
        $serviceIds = array();
        $userData = array();
        $userImages = array();

        foreach ($answerData as $answer) {
            $serviceIds[] .= $answer->service_id;
            $userData = UserService::join('users', 'users.id', '=', 'users_services.user_id')->where('users_services.service', $answer->service_id)->get(['users.profile_image']);
            foreach ($userData as $users) {
                $userImages[] = $users->profile_image;
            }
        }
        return array_unique($userImages);
    }
}
