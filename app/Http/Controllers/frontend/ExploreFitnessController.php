<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Favourite;
use App\Models\FitnessGoal;
use App\Models\Keyword;
use App\Models\ProviderGoal;
use App\Models\ProviderWorkout;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserService;
use App\Models\WorkoutCategory;
use App\Models\WorkoutSubCategory;

class ExploreFitnessController extends Controller
{
    public $userData;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->userData = session('UserSession');
            return $next($request);
        });
    }
    public function Index(Request $request)
    {
        $userId = $this->userData['id'];

        if ($this->userData['role_id'] != 3) {
            return redirect(route('user.logout'));
        }

        $numOfFilter = count($request->all());
        $likesProvider = array();
        $location_filter_arr = array();
        $service_filter_arr = array();
        $workout_filter_arr = array();
        $goal_filter_arr = array();

        if (isset($request->service)) {
            $service_filter_arr = $request->service;
        }

        //location
        $provider_list = User::where('users.status', '1')->where('users.deleted', '1')->where('users.role_id', '2');
        if (!isset($request->location)) {
            $data = GetDataUsingTabelAndId('users', $userId);
            $location = $data[0]->location;
            if (strlen($location) <= 0) {
                if (isset($ip) && strlen($ip) > 0) {
                    $location = getUserLocationData($ip);
                } else {
                    $location = getUserLocationData();
                }
                $location = $location->cityName;
            }
            $provider_list = $provider_list->where('users.location', 'like', '%' . $location . '%');
        } elseif (isset($request->location)) {
            $provider_list = $provider_list->where('location', $request->location);
            $location_filter_arr =  [];
        }
        //keyword
        if (isset($request->keyword)) {
            $keyword_user_data = Keyword::where('keyword', $request->keyword);
            $userIds = array();
            foreach ($keyword_user_data->get() as $users) {
                array_push($userIds, $users->user_id);
            }
            $provider_list = $this->AppendFilterQuery('id', $userIds, $provider_list);
        }
        //service
        if (isset($request->service)) {
            $user_service_sql = UserService::where('id', '!=', '')->groupBy('user_id');
            $user_service_sql = $this->AppendFilterQuery('service', $request->service, $user_service_sql);
            $userIds = array();
            foreach ($user_service_sql->get() as $users) {
                array_push($userIds, $users->user_id);
            }
            $provider_list = $this->AppendFilterQuery('id', $userIds, $provider_list);
            $service_filter_arr =  $request->service;
        }

        //workout        
        if (isset($request->workout)) {
            $userIds = array();
            $workout_user_sql = ProviderWorkout::where('status', '1')->where('deleted', '1');
            $workout_user_sql = $this->AppendFilterQuery('workout_id', $request->workout, $workout_user_sql);

            foreach ($workout_user_sql->get() as $workout_user_list) {
                array_push($userIds, $workout_user_list->user_id);
            }
            if (count($userIds) > 0) {
                $provider_list = $this->AppendFilterQuery('id', $userIds, $provider_list);
            } else {
                $provider_list = $provider_list->where('id', '=', '');
            }
            $workout_filter_arr = $request->workout;
        }

        $workouts_list = array();
        $workout_category = WorkoutCategory::where('status', '1')->where('deleted', '1')->latest()->get();

        foreach ($workout_category as $workouts) {
            $subdata = array();
            $list['id'] = $workouts->id;
            $list['name'] = $workouts->name;
            $workout_sub_category_list = WorkoutSubCategory::where('cat_id', $workouts->id)->where('status', '1')->where('deleted', '1')->latest()->get();
            foreach ($workout_sub_category_list as $sub_category) {
                $sub_categorys['sub_id'] = $sub_category->id;
                $sub_categorys['name'] = $sub_category->name;
                $subdata[] = $sub_categorys;
            }
            $list['sub_workouts'] = $subdata;
            $workouts_list[] = $list;
        }
        $return_data['workouts_list'] = $workouts_list;

        //Price
        if (isset($request->price)) {
            $provider_list = $provider_list->where('users.fees', '<=', $request->price);
        }

        $like_list = Favourite::where('user_id', $this->userData['id'])->where('status','1')->where('deleted','1')->get(['favourite_id']);

        foreach ($like_list as $list) {
            array_push($likesProvider, $list->favourite_id);
        }

        $top_price = User::where('status', '1')->where('deleted', '1')->where('role_id', '2')->max('fees');
        $return_data['top_price'] = floor($top_price);

        if (isset($request->price)) {
            $return_data['price'] = floor($top_price);
        } else {
            $return_data['price'] = floor($return_data['top_price'] / 2);
        }

        //GOALS/INTERESTS
        if (isset($request->golas)) {
            $userIds = array();
            $provider_goal_sql = ProviderGoal::where('status', '1')->where('deleted', '1');
            $provider_goal_sql = $this->AppendFilterQuery('goal_id', $request->golas, $provider_goal_sql);
            foreach ($provider_goal_sql->get() as $provider_goal_list) {
                array_push($userIds, $provider_goal_list->user_id);
            }
            if (count($userIds) > 0) {
                $provider_list = $this->AppendFilterQuery('id', $userIds, $provider_list);
            } else {
                $provider_list = $provider_list->where('id', '=', '');
            }
            $goal_filter_arr = $request->golas;
        }


        $goal_list = FitnessGoal::where('status', '1')->where('deleted', '1')->latest()->get();
        $return_data['goal_list'] = $goal_list;

        $return_data['provider_list'] = $provider_list->get(['id as user_id', 'profile_image']);

        $return_data['num_of_filter'] =  $numOfFilter;
        $return_data['location_list'] =  User::where('role_id', '2')->where('location', '!=', 'NULL')->where('users.status', '1')->where('users.deleted', '1')->where('users.role_id', '2')->groupBy('location')->get('location', 'id');
        $return_data['service_list'] =  Service::where('status', '1')->where('deleted', '1')->get(['name', 'id']);
        $return_data['like_list'] = $likesProvider;
        $return_data['location_filter_arr'] = $location_filter_arr;
        $return_data['service_filter_arr'] = $service_filter_arr;
        $return_data['workout_filter_arr'] = $workout_filter_arr;
        $return_data['goal_filter_arr'] = $goal_filter_arr;
        $return_data['site_title'] = trans('Explore Fitness');

        return view('front.explore-fitness.index', array_merge($return_data));
    }

    public function AddFavouriteProvider(Request $request)
    {
        if ($request->deleteStatus == 0) {
            $date = GetDateTime();
            $data = Favourite::insert(['user_id' => $this->userData['id'], 'favourite_id' => $request->providerId, 'created_at' => $date, 'updated_at' => $date]);
            sendNotifaction($request->providerId, 'Added', 'You are added in favourites list');
        } else {
            $data = Favourite::where('user_id', $this->userData['id'])->where('favourite_id', $request->providerId)->delete();
        }
        return $data;
    }
    public function AppendFilterQuery($data_base_fild_name, $arr, $sql)
    {
        if (count($arr) > 0) {
            return $sql = $sql->whereIn($data_base_fild_name, $arr);
        } else {
            return $sql;
        }
    }
    public function Getkeyword()
    {
        $data = Keyword::where('status', '1')->where('deleted', '1')->groupBy('keyword')->get();
        return response()->json([
            'status' => '1',
            'data' => $data,
        ]);
    }
    public function GetProviderCitys()
    {
        $data = User::where('status', '1')->where('deleted', '1')->where('location', '!=', '')->where('users.role_id', '2')->groupBy('location')->get(['location']);
        return response()->json([
            'status' => '1',
            'data' => $data,
        ]);
    }
}
