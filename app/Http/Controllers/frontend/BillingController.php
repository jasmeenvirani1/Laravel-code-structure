<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\BillingRequest;
use App\Http\Requests\Request;
use App\Models\CardDetail;
use App\Models\PrivacyDeatil;
use App\Models\Provider;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class BillingController extends Controller
{
    public function Index()
    {
        $return_data['site_title'] = trans('Biling');
        return view('front.billing.index', array_merge($return_data));
    }

    // public function Payment(BillingRequest $request)
    public function Payment(BillingRequest $request)
    {
        $status = $this->InsertUser($request, 1);
        if ($status == 1) {
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

    public function InsertUser(Request $request, $payment = 0)
    {
        $row_date = mktime(0, 0, 0, $request->month, 1, $request->year);
        $expiry_date = date("Y-m-d", $row_date);


        $created_at = GetTodayDate();
        $data = session()->all();
        $userData = $data['userData'][0];
        $model_save = User::insertGetId([
            'name' => $userData['name'],
            'role_id' => $userData['role_id'],
            'profile_image' => 'backend/upload/user2-160x160.jpg',
            'cover_image' => 'backend/upload/profile_cover_defult.png',
            'email' => $userData['email'],
            'password' => $userData['password'],
            'plan_id' => $userData['plan_id'],
            'plan_purchase_status' => $payment,
            'created_at' => $created_at,
            'updated_at' => $created_at,
            'location' => $request['city'],
        ]);

        $user_id = $model_save;

        Provider::insert([
            'user_id' => $user_id,
            'country' => $request->country,
            'city' => $request->city,
            'postal_code' => $request->zip_code,
            'created_at' => $created_at,
            'phone' => $request->phone,
        ]);



        PrivacyDeatil::insert([
            'user_id' => $user_id,
            'created_at' => $created_at,
            'updated_at' => $created_at,
        ]);

        CardDetail::insert([
            'user_id' => $user_id,
            'plan_id' => $userData['plan_id'],
            'card_number' => $request->card_number,
            'created_at' => $created_at,
            'updated_at' => $created_at,
            'expiry_date' => $expiry_date,
            'cvv' => $request->cvv,
            'billing_address' => $request->billing_address,
            'billing_address_2' => $request->billing_address_2,
        ]);

        if ($model_save) {
            Session::put('UserSession', ['id' => $model_save, 'name' => $userData['name'], 'role_id' => $userData['role_id'], 'email' => $userData['email']]);
            Session::forget('userData');
            return 1;
        } else {
            return 0;
        }
    }
}
