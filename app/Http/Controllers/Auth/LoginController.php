<?php

namespace App\Http\Controllers\Auth;


use Cookie;
use App\Models\User;
use App\Models\Project;
use App\Models\Team;
use App\Models\Customer;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\PrivacyDeatil;
use App\Models\Provider;
use App\Models\Seeker;
use App\Models\SocialMediaLink;
use App\Models\Subscription;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\frontend\BillingController;
use App\Models\CardDetail;

class LoginController extends Controller
{
    public function View(Request $request)
    {
        $return_data['site_title'] = trans('Login');

        return view('front.login.login', array_merge($return_data));
    }

    public function Postlogin(Request $request)
    {
        $validation = Validator::make(
            $request->all(),
            [
                'email' => 'required|email',
                'password' => 'required',
            ]
        );

        if ($validation->fails()) {

            return response()->json([
                "message" => 'The given data was invalid.',
                'status' => 422,
                'errors' => $validation->errors(),
            ]);
        } else {
            $email = $request->email;
            $password = $request->password;
            $user_login = User::where('email', $email)->first();

            if (!$user_login) {
                return response()->json([
                    'status' => 422,
                    'errors' => ['other-error' => 'Email is Invalid'],
                ]);
            }

            if ($user_login->status == '0') {
                return response()->json([
                    'status' => 422,
                    'errors' => ['other-error' => 'Email is Inactive Please contact Administrator!'],
                ]);
            } elseif ($user_login->deleted == '0') {
                return response()->json([
                    'status' => 422,
                    'errors' => ['other-error' => 'Email is deleted Please contact Administrator'],
                ]);
            } elseif ($user_login && Hash::check($password, $user_login->password)) {

                $role = $user_login->role_id;
                Session::put('UserSession', ['id' => $user_login->id, 'name' => $user_login->name, 'role_id' => $user_login->role_id, 'email' => $user_login->email]);

                return response()->json([
                    'status' => 200,
                    'data' =>  ['redirect' => 'user.home'],
                ]);
            } else {
                return response()->json([
                    'status' => 422,
                    'errors' => ['other-error' => 'Plz enter valid email and password'],
                ]);
            }
        }
    }


    public function CreateAccount($id = null)
    {
        if (!isset($id)) {
            return redirect(route('front.pricing'));
        }
        $return_data['subscription_plans'] = Subscription::where('deleted', '1')->where('status', '1')->get();
        $return_data['plan_id'] = $id;

        $return_data['site_title'] = trans('Creat Account');

        return view('front.create_account.index', array_merge($return_data));
    }

    public function PostCreateAccount(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:users,email',
            'name' => 'required',
            'password' => 'required|min:4',
        ]);

        $password = Hash::make($request->password);
        $role_id = GetRoleId($request->role);

        $data = array([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $password,
            'profile_image' => 'backend/upload/user2-160x160.jpg',
            'cover_image' => 'backend/upload/profile_cover_defult.png',
            'plan_id' => $request->plan_id,
            'role_id' => $role_id,
        ]);
        Session::put('userData', $data);
        $data = session()->all();
        return response()->json([
            'status' => 200,
            'message' => 'User add succesfully',
        ]);
    }

    public function logout(Request $request)
    {
        Session::forget('UserSession');
        if (!Session::has('UserSession')) {
            Session::flash('message', 'You have been successfully logout');
            return redirect(route('front.login'));
        }
    }
    public function Show(Request $request)
    {
        $data = session()->all();
        prx($data);
    }
    public function SeekerSingup(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:users,email',
            'username' => 'required',
            'password' => 'required|min:4',
        ]);
        $created_at = GetTodayDate();
        $data = [
            'role_id' => '3',
            'name' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'profile_image' => 'backend/upload/user2-160x160.jpg',
            'cover_image' => 'backend/upload/profile_cover_defult.png',
            'plan_id' => '0',
            'plan_purchase_status' => '0',
            'created_at' => $created_at,
            'updated_at' => $created_at,
        ];
        $userId = User::insertGetId($data);
        Seeker::insert(['user_id' => $userId, 'created_at' => $created_at, 'updated_at' => $created_at]);
        PrivacyDeatil::insert(['user_id' => $userId, 'created_at' => $created_at, 'updated_at' => $created_at]);
        Session::put('UserSession', ['id' => $userId, 'name' => $request->username, 'role_id' => '3', 'email' => $request->email]);
        return response()->json([
            'status' => 200,
            'message' => 'User add succesfully',
        ]);
    }
    public function FreeProviderSingUp(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'plan_id' => 'required'
        ]);

        $password = Hash::make($request->password);
        $role_id = '2';
        $created_at = GetTodayDate();

        $userData = $request->all();
        $model_save = User::insertGetId([
            'name' => $userData['name'],
            'role_id' => $role_id,
            'email' => $userData['email'],
            'password' => $password,
            'profile_image' => 'backend/upload/user2-160x160.jpg',
            'cover_image' => 'backend/upload/profile_cover_defult.png',
            'plan_id' => $userData['plan_id'],
            'plan_purchase_status' => '0',
            'created_at' => $created_at,
            'updated_at' => $created_at,
        ]);
        $user_id = $model_save;
        Provider::insert([
            'user_id' => $user_id,
            'postal_code' => $request->zip_code,
            'created_at' => $created_at,
        ]);
        PrivacyDeatil::insert([
            'user_id' => $user_id,
            'created_at' => $created_at,
            'updated_at' => $created_at,
        ]);
        CardDetail::insert([
            'user_id' => $user_id,
            'plan_id' => $userData['plan_id'],
            'created_at' => $created_at,
            'updated_at' => $created_at,
        ]);
        if ($model_save) {
            Session::put('UserSession', ['id' => $model_save, 'name' => $userData['name'], 'role_id' => $role_id, 'email' => $userData['email']]);
            Session::forget('userData');
            return response()->json([
                'status' => 200,
                'message' => 'User add succesfully',
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'message' => 'Something went wrong',
            ]);
        }
    }
}
