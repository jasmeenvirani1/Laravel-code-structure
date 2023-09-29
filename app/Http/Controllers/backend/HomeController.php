<?php

namespace App\Http\Controllers\backend;

use Illuminate\Support\Facades\DB;
use App\Models\Project;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Favourite;
use App\Models\WorkProfile;
use App\Models\Installation;
use App\Models\Option;
use App\Models\Service;
use App\Models\Team;
use App\Models\UserService;
use Brian2694\Toastr\Facades\Toastr;
use DateTime;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

class HomeController extends Controller
{
    public $modual_name = "";
    public $title = "Dashbord";
    public $view = "";
    public $userData;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->userData = session('UserSession');
            return $next($request);
        });
    }

    public function Index()
    {
      
        $toDayDate = date('Y-m-d h:i:s');

        $datetime = new DateTime($toDayDate);
        $datetime->modify('-30 day');

        $datetime = new DateTime($toDayDate);
        $tomorrowDate = $datetime->modify('-1 day')->format('Y-m-d H:i:s');

        $datetime = new DateTime($toDayDate);
        $fiveDayBefore = $datetime->modify('-5 day')->format('Y-m-d');

        $datetime = new DateTime($toDayDate);
        $before_month_date =  $datetime->format('Y-m-d H:i:s');

        if ($this->userData['role_id'] == 1) {
            //User Card
            $return_data['total_user'] = User::where('role_id', '!=', '1')->where('deleted', '1')->count();
            $return_data['active_user'] = User::where('role_id', '!=', '1')->where('created_at', '>=', $tomorrowDate)->where('deleted', '1')->count();

            //Provider Card
            $return_data['total_provider'] = User::where('role_id', '2')->where('deleted', '1')->count();
            $return_data['total_subscribed_provider'] = User::where('role_id', '2')->where('plan_purchase_status', '1')->where('deleted', '1')->count();

            //Seeker Card
            $return_data['total_seekers'] = User::where('role_id', '3')->where('deleted', '1')->count();
            $return_data['total_subscribed_seekers'] = User::where('role_id', '3')->where('plan_purchase_status', '1')->where('deleted', '1')->count();

            //Total Payment
            $return_data['total_payment'] = 0;
            $return_data['total_month_payment'] = 0;

            //Latest Provider
            $return_data['latest_provider'] = User::leftJoin('subscription_plans', 'subscription_plans.id', '=', 'users.plan_id')->where('users.deleted', '1')->where('users.role_id', '2')->take(10)->get(['users.id', 'users.name', 'users.email', 'users.created_at', 'subscription_plans.type']);


            //Latest Seeker
            $return_data['latest_seeker'] = User::leftJoin('subscription_plans', 'subscription_plans.id', '=', 'users.plan_id')->where('users.deleted', '1')->where('users.role_id', '3')->take(10)->get(['users.id', 'users.name', 'users.email', 'users.created_at', 'subscription_plans.type']);

            //Latest Graph Data
            $toDayDate = date('Y-m-d', strtotime($fiveDayBefore));
            $provider_count = array();
            $seeker_count = array();
            $dates = array();
            $provider_sum = 0;
            $seeker_sum = 0;
            for ($i = 1; $i < 6; $i++) {

                $datetime = new DateTime($toDayDate);
                $date = $datetime->modify('+' . $i . 'day')->format('Y-m-d');
                $datetime = new DateTime($toDayDate);
                $tomorrow_date = $datetime->modify('-' . $i . 'day')->format('Y-m-d');

                array_push($dates, $date);

                $data = User::select(User::raw('count(*) as provider_count'))->groupBy('created_at')->where('role_id', '2')->Where('created_at', $date)->get();
                if (isset($data[0])) {
                    $count = $data[0]->provider_count;
                    if ($provider_sum < $count) {
                        $provider_sum = $provider_sum + $count;
                    }
                } else {
                    $count = 0;
                }
                array_push($provider_count, $count);

                $data = User::select(User::raw('count(*) as seeker_count'))->groupBy('created_at')->where('role_id', '3')->Where('created_at', $date)->get();
                if (isset($data[0])) {
                    $count = $data[0]->seeker_count;
                    if ($seeker_sum < $count) {
                        $seeker_sum = $seeker_sum + $count;
                    }
                } else {
                    $count = 0;
                }
                array_push($seeker_count, $count);
            }

            $return_data['provider_graph_data'] = json_encode($provider_count);
            $return_data['seeker_graph_data'] = json_encode($seeker_count);
            $return_data['date_graph_data'] = json_encode($dates);
            if ($provider_sum > $seeker_sum) {
                $return_data['y_axis'] = $provider_sum;
            } else {
                $return_data['y_axis'] = $seeker_sum;
            }
        } else if ($this->userData['role_id'] == '2') {
            $userId = $this->userData['id'];
            $service_sql =  UserService::where('user_id', $userId)->get('service');
            $service_list = $this->returnArray($service_sql, 'service');

            $opction_sql = Option::join('answers', 'answers.opction_id', '=', 'options.id')->join('users', 'users.id', '=', 'answers.user_id')->where('users.role_id', '3')->where('options.deleted', '1')->groupBy('answers.user_id')->orderBy('answers.created_at');
            $opction_list = $this->AppendFilterQuery('options.service_id', $service_list, $opction_sql)->get(['users.*']);
            $recent_list = $this->AppendFilterQuery('options.service_id', $service_list, $opction_sql)->take(5)->get(['users.*']);

            $return_data['all_match'] = $opction_list;
            $return_data['recent'] = $recent_list;
        } elseif ($this->userData['role_id'] == '3') {

            //total favourit seeker
            $return_data['favourite_provider'] = Favourite::where('user_id', '=', $this->userData['id'])->where('deleted', '1')->count();

            //total favourit seeker premium
            $return_data['total_subscribed_provider'] = User::join('favourites', 'favourites.favourite_id', '=', 'users.id')->where('users.plan_purchase_status', '=', '1')->where('favourites.user_id', $this->userData['id'])->where('users.deleted', '1')->count();
            $return_data['total_subscribed_seekers'] = $return_data['total_subscribed_provider'];

            //total favourit seeker unpremium
            $return_data['total_unsubscribed_provider'] = User::join('favourites', 'favourites.favourite_id', '=', 'users.id')->where('users.plan_purchase_status', '!=', '1')->where('favourites.user_id', $this->userData['id'])->where('users.deleted', '1')->count();

            //total favourit seeker earning
            $return_data['total_payment'] = 0;

            //Premium Seekers
            $return_data['premium_provider'] = User::leftJoin('subscription_plans', 'subscription_plans.id', '=', 'users.plan_id')->join('favourites', 'favourites.favourite_id', '=', 'users.id')->where('users.plan_purchase_status', '=', '1')->where('favourites.user_id', $this->userData['id'])->groupby('users.id')->take(10)->get(['users.id', 'users.name', 'users.email', 'users.created_at', 'subscription_plans.type']);

            //UnPremium Seekers
            $return_data['unpremium_seekers'] = User::leftJoin('subscription_plans', 'subscription_plans.id', '=', 'users.plan_id')->join('favourites', 'favourites.favourite_id', '=', 'users.id')->where('users.plan_purchase_status', '!=', '1')->where('favourites.user_id', $this->userData['id'])->groupby('users.id')->take(10)->get(['users.id', 'users.name', 'users.email', 'users.created_at', 'subscription_plans.type']);


            //Latest Graph Data
            $toDayDate = date('Y-m-d', strtotime($fiveDayBefore));
            $provider_count = array();
            $seeker_count = array();
            $dates = array();
            $provider_sum = 0;
            $seeker_sum = 0;
            for ($i = 1; $i < 6; $i++) {

                $datetime = new DateTime($toDayDate);
                $date = $datetime->modify('+' . $i . 'day')->format('Y-m-d');
                $datetime = new DateTime($toDayDate);
                $tomorrow_date = $datetime->modify('-' . $i . 'day')->format('Y-m-d');

                array_push($dates, $date);

                $data = User::select(User::raw('count(*) as provider_count'))->join('favourites', 'favourites.favourite_id', '=', 'users.id')->groupBy('users.created_at')->where('users.plan_purchase_status', '0')->where('favourites.user_id', $this->userData['id'])->where('users.role_id', '2')->Where('users.created_at', $date)->get();
                if (isset($data[0])) {
                    $count = $data[0]->provider_count;
                    if ($provider_sum < $count) {
                        $provider_sum = $provider_sum + $count;
                    }
                } else {
                    $count = 0;
                }
                array_push($provider_count, $count);

                $data = User::select(User::raw('count(*) as seeker_count'))->join('favourites', 'favourites.favourite_id', '=', 'users.id')->groupBy('users.created_at')->where('users.plan_purchase_status', '1')->where('favourites.user_id', $this->userData['id'])->where('users.role_id', '2')->Where('users.created_at', $date)->get();
                if (isset($data[0])) {
                    $count = $data[0]->seeker_count;
                    if ($seeker_sum < $count) {
                        $seeker_sum = $seeker_sum + $count;
                    }
                } else {
                    $count = 0;
                }
                array_push($seeker_count, $count);
            }

            $return_data['free_seeker_graph_data'] = json_encode($provider_count);
            $return_data['subscribed_seeker_graph_data'] = json_encode($seeker_count);
            $return_data['date_graph_data'] = json_encode($dates);
            if ($provider_sum > $seeker_sum) {
                $return_data['y_axis'] = $provider_sum;
            } else {
                $return_data['y_axis'] = $seeker_sum;
            }
        }

        $return_data['site_title'] = trans('Dashboard');
        if ($this->userData['role_id'] === '3') {
            $return_data = [];

            $return_data['site_title'] = trans($this->title);
            $return_data['sub_header'] = $this->title;
            $userId = $this->userData['id'];
            $return_data['flit_feed'] = GetSetting('flit-feed');

            $created_at = GetTodayDate();
            $created_at = date('Y-m-d', strtotime('-5 day', strtotime($created_at)));

            $sql = Answer::join('options', 'options.id', '=', 'answers.opction_id')->orderBy('answers.created_at', 'desc')->where('user_id', $userId)->where('status', '1')->where('answers.deleted', '1')->take(5);
            $return_data['recent_provider_profile_image'] = $this->GetMatchProvider($sql);

            $sql = Answer::join('options', 'options.id', '=', 'answers.opction_id')->orderBy('answers.created_at', 'desc')->where('user_id', $userId)->where('status', '1')->where('answers.deleted', '1');
            $return_data['all_over_provider_profile_image'] = $this->GetMatchProvider($sql);
            // prx($return_data);

            $sql = Answer::join('options', 'options.id', '!=', 'answers.opction_id')->where('user_id', $userId);
            $return_data['suggested'] = $this->GetMatchProvider($sql);

            return view('backend.matches.index', array_merge($return_data));
        }
        // prx($return_data);
        return view('backend.index', array_merge($return_data));
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
    public function returnArray($data, $key)
    {
        $arr = array();
        foreach ($data as $item) {
            array_push($arr, $item->$key);
        }
        return $arr;
    }
    public function AppendFilterQuery($data_base_fild_name, $arr, $sql)
    {
        if (count($arr) > 0) {
            return $sql = $sql->whereIn($data_base_fild_name, $arr);
        } else {
            return $sql;
        }
    }
}
