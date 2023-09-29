<?php

namespace App\Http\Controllers\backend;

// use App\User;
use Illuminate\Http\Request;
use App\Traits\ImageUploadTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Certificate;
use App\Models\FitnessGoal;
use App\Models\Provider;
use App\Models\ProviderGoal;
use App\Models\ProviderWorkout;
use App\Models\Seeker;
use App\Models\Service;
use App\Models\User;
use App\Models\UserService;
use App\Models\UsersService;
use App\Models\WorkoutSubCategory;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class UsersController extends Controller
{
    public $modual_name = "";
    public $title = "";
    public $view = "";
    public $userData;

    public function __construct()
    {
        $this->modual_name = 'users';
        $this->title = 'Users';
        $this->view = 'backend.user.';
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
        return view($this->view . 'index', array_merge($return_data));
    }

    public function FetchUsers(Request $request)
    {

        if ($request->ajax()) {
            $count = 0;
            $data = User::where('deleted', '1')->where('role_id', '!=', '1');
            if ($request->user_role_id != 0) {
                $data = $data->where('role_id', $request->user_role_id);
            }
            $data = $data->orderBydesc('id')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    if ($row->status == '0') {
                        $status = "<button class='btn badge badge-light-danger' onclick=ChangeStatus(" . $row->id . ",'1')>Inactive</button>";
                    } else {
                        $status = "<button class=' btn badge badge-success h4' onclick=ChangeStatus(" . $row->id . ",'0') > Active</button>";
                    }
                    return $status;
                })
                ->addColumn('type', function ($row) {
                    if ($row->role_id == '1') {
                        $type = '<div class="progress mt-1" style="height:4px;"><div class="progress-bar bg-danger  text-center rounded" role="progressbar" style="width: 60%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div></div>';
                    } elseif ($row->role_id == '2') {
                        $type = 'Provider' . '<div class="progress mt-1 text-center" style="height:4px;margin-left: 29%; width: 53%"><div class="progress-bar text-center  bg-sucess   rounded" role="progressbar" style="width: 70%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div></div>';
                    } elseif ($row->role_id == '3') {
                        $type = 'Seeker' . '<div class="progress mt-1 text-center" style="height:4px;margin-left: 29%; width: 53%"><div class="progress-bar text-center  bg-warning   rounded" role="progressbar" style="width: 70%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div></div>';
                    }
                    return $type;
                })
                ->addColumn('action', function ($row) {
                    if ($row->role_id == '3') {
                        $actionBtn = "<a href='" . route('admin.user.edit', array('id' => $row->id)) . "' class='btn btn-primary'  data-toggle='tooltip' data-placement='bottom' title='' data-original-title='tooltip on bottom'><i class='feather icon-edit'></i></a>&nbsp<button class='btn btn-danger delete-user' data-id=" . $row->id . "><i class='feather icon-trash-2'></i></button>";
                    } else {
                        $actionBtn = "<a href='" . route('admin.user.edit', array('id' => $row->id)) . "' class='btn btn-primary'  data-toggle='tooltip' data-placement='bottom' title='' data-original-title='tooltip on bottom'><i class='feather icon-edit'></i></a>&nbsp<button class='btn btn-danger delete-user' data-id=" . $row->id . "><i class='feather icon-trash-2'></i></button>";
                    }
                    return $actionBtn;
                })
                ->rawColumns(['status', 'action', 'type'])
                ->make(true);
        }
    }

    public function Store(Request $request)
    {
        $validated = $request->validate([

            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $request->id,
            'password' => 'required',
        ]);

        $created_at = GetTodayDate();
        $password = Hash::make($request->password);
        $role_id = GetRoleId($request->role);
        $model_save = User::insertGetId([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $role_id,
            'password' => $password,
            'created_at' => $created_at,
        ]);
        $user_id = $model_save;

        Provider::insert([
            'user_id' => $user_id,
            'profile_image' => 'backend/upload/user2-160x160.jpg',
            'created_at' => $created_at,
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'User add succesfully',
        ]);
    }

    public function Edit($id = null)
    {
        $provider_workout_lists = array();
        if ($this->userData['role_id'] == 1) {
            if ($id == null) {
                return redirect(route('user.logout'));
            }
            $editId = $id;
        } elseif ($id == null) {
            $editId = $this->userData['id'];
        } elseif ($this->userData['role_id'] != 1 && $this->userData['id'] != $id) {
            return redirect(route('user.logout'));
        } else {
            $editId = $id;
        }

        $return_data['site_title'] = trans($this->title) . ' | ' .  env('APP_NAME');
        $return_data['sub_header'] = $this->title;

        $user_id = $id;
        $user_detail = User::where('id', $editId)->get();
        if ($user_detail[0]->role_id == 2) {

            $return_data['user_detail'] = User::join('providers', 'providers.user_id', '=', 'users.id')->where('users.id', $editId)->first(['providers.*', 'users.role_id', 'users.id as user_id', 'users.email', 'users.name', 'users.password', 'users.profile_image', 'users.fees']);

            $workouts = WorkoutSubCategory::where('status', '1')->where('deleted', '1')->latest()->get();
            $return_data['workouts'] = $workouts;

            $provider_workout = ProviderWorkout::where('user_id', $editId)->latest()->get();
            foreach ($provider_workout as $workouts) {
                array_push($provider_workout_lists, $workouts['workout_id']);
            }
            $return_data['fitness_goals'] = FitnessGoal::where('deleted', '1')->where('status', '1')->get(['id', 'name']);

            $user_goal_data = ProviderGoal::where('user_id', $editId)->get(['goal_id']);
            $user_goal_ids = array();

            foreach ($user_goal_data as $user_goal) {
                array_push($user_goal_ids, $user_goal['goal_id']);
            }

            $return_data['provider_workout_list'] = $provider_workout_lists;
            $return_data['user_goal_ids'] = $user_goal_ids;

        } else if ($user_detail[0]->role_id == 3) {
            $return_data['user_detail'] = User::join('seekers', 'seekers.user_id', '=', 'users.id')->where('users.id', $editId)->first();
        }
        $user_services_data = UserService::where('user_id', $editId)->get(['service']);
        $user_service_ids = array();

        foreach ($user_services_data as $service) {
            array_push($user_service_ids, $service['service']);
        }

        $return_data['user_service_ids'] = $user_service_ids;

        $return_data['service'] = Service::where('deleted', '1')->where('status', '1')->get(['id', 'name', 'status']);

        $return_data['certificates'] = Certificate::where('user_id', $editId)->get(['id', 'image']);
        $return_data['site_title'] = trans('User Edit');
        $return_data['sub_header'] = $this->title;
        if ($user_detail[0]->role_id == '2') {
            return view($this->view . 'provider-edit', array_merge($return_data));
        } else {
            return view($this->view . 'seeker-edit', array_merge($return_data));
        }
    }

    public function UpdateProvider(UserRequest $request)
    {

        $input = $request->all();
        $current_date_time = GetDateTime();
        $input['created_at'] = $current_date_time;
        $user_id = $request->user_id;
        if (isset($request->new_password) && strlen($request->new_password) > 4) {
            $password = Hash::make($request->password);
            $model = User::where('id', $user_id)->update([
                'password' => $password,
                'updated_at' => $current_date_time,
            ]);
        }

        if ($files = $request->file('image')) {
            foreach ($files as $file) {
                $name = ImageUploadTrait::uploadImage($file, 'certificate');
                $arr['user_id'] = $user_id;
                $arr['image'] = $name;
                $arr['created_at'] = $current_date_time;
                Certificate::insert($arr);
            }
        }
        User::where('id', $user_id)->update(['fees' => $request->fees]);
        UsersService::where('user_id', $user_id)->delete();
        $input['service'] = array_unique($input['service']);
        foreach ($input['service'] as $service) {
            UsersService::insert([
                "user_id" => $user_id,
                "service" => $service,
                "created_at" => $current_date_time
            ]);
        }

        ProviderWorkout::where('user_id', $user_id)->delete();
        $input['workout'] = array_unique($input['workout']);
        foreach ($input['workout'] as $workout) {
            ProviderWorkout::insert([
                "user_id" => $user_id,
                "workout_id" => $workout,
                "created_at" => $current_date_time
            ]);
        }

        ProviderGoal::where('user_id', $user_id)->delete();
        $input['goals'] = array_unique($input['goals']);
        foreach ($input['goals'] as $goal_id) {
            ProviderGoal::insert([
                "user_id" => $user_id,
                "goal_id" => $goal_id,
                "created_at" => $current_date_time
            ]);
        }

        unset($input['_token'], $input['user_id'], $input['name'], $input['new_password'], $input['image'], $input['service'], $input['fees'], $input['workout'], $input['goals']);
        $model = Provider::where('user_id', $user_id)->update($input);
        return response()->json([
            'status' => 200,
            'message' => 'User Update succesfully',
        ]);
    }

    public function UpdateSeeker(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required',
            'name' => 'required',
            'address' => 'required',
            'country' => 'required',
            'city' => 'required',
            'postal_code' => 'required',
            'mobile' => 'required|numeric|digits:10',
            'phone' => 'required|numeric|digits:10',
            'about' => 'required',
        ]);

        $input = $request->all();
        $current_date_time = GetTodayDate();
        $input['created_at'] = $current_date_time;
        $password = Hash::make($request->password);
        $user_id = $request->user_id;
        $model = User::where('id', $user_id)->update([
            'password' => $password,
            'updated_at' => $current_date_time,
        ]);



        unset($input['_token'], $input['user_id'], $input['name'], $input['new_password']);
        $model = Seeker::where('user_id', $user_id)->update($input);
        return response()->json([
            'status' => 200,
            'message' => 'User Update succesfully',
        ]);
    }


    public function UploadProfilePictuer(Request $request)
    {
        $user_id = $request->user_id;
        if (isset($request->largeProfileImage) && $request->largeProfileImage == '1') {
            if ($file = $request->file('image')) {
                $name = ImageUploadTrait::uploadImage($file, 'cover_profile');
                $name = '/backend/upload/cover_profile/' . $name;
                User::where('id', $user_id)->Update(['cover_image' => $name]);
            }
        } else {
            if ($file = $request->file('image')) {
                $name = ImageUploadTrait::uploadImage($file, 'provider_profile');
                $name = '/backend/upload/provider_profile/' . $name;
                User::where('id', $user_id)->Update(['profile_image' => $name]);
            }
        }
        return response()->json([
            'status' => 200,
            'message' => 'User Update succesfully',
        ]);
    }

    public function Delete(Request $request)
    {
        $update_status = User::where('id', $request->userId)->update(['deleted' => '0']);

        return response()->json([
            'status' => 200,
            'message' => 'User Deleted succesfully',
        ]);
    }
    public function ChangeStatus(Request $request)
    {
        User::where('id', $request->userId)->update(['status' => $request->status]);
        return response()->json([
            'status' => 200,
            'message' => 'User Status Update Succesfully',
        ]);
    }

    public function DeleteCertificate(Request $request)
    {
        $id = $request->image_id;
        $file_name = $request->image_name;
        DeleteDataByIdAndTableName('certificates', $id);
        $data = ImageUploadTrait::removeImage($file_name, 'backend\upload\certificate');
        return response()->json([
            'status' => 200,
            'message' => 'Certificates Delete Succesfully',
        ]);
    }
    public function UploadProviderVideo(Request $request)
    {
        $request->validate([
            'video' => 'required|mimes:mp4,mov,ogg',
        ]);

        $user_id = $request->user_id;
        if ($file = $request->file('video')) {
            $name = ImageUploadTrait::uploadImage($file, 'profile_video');
            $name = '/backend/upload/profile_video/' . $name;
            User::where('id', $user_id)->Update(['profile_video' => $name]);
        }
        return response()->json([
            'status' => 200,
            'message' => 'User Updated Succesfully',
        ]);
    }
}
