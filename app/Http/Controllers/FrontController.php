<?php

namespace App\Http\Controllers;

use App\User;
use App\State;
use App\Package;
use App\PackageMaster;
use Illuminate\Http\Request;
use App\Traits\ImageUploadTrait;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\RegisterRequest;



class FrontController extends Controller
{

  public function PostBookTicket(REQUEST $request)
  {

    $admin_email = config('constants.email');
    $data = $request->all();


    $package = Package::where('id', $request->frm_package_id)->first();
    $user_id = session()->get('UserSession.id');
    $agent = User::where('id', $user_id)->first();
    $data['package_name'] = $package->name;
    $data['departure_date'] = $package->date;
    $data['company_name'] = $agent->company_name;
    $data['mobile'] = $agent->mobile;

    $emails = [$admin_email, $agent->email];


    Mail::send('front.email.book_ticket', $data, function ($message) use ($emails) {
      $message->to($emails)->subject('Agent Series Booking');
    });

    return response()->json(['status' => '200', 'message' => 'Success! We will contact you within 24 hours']);
  }

  public function BookTicket(REQUEST $request, $package_id)
  {
    $return_data = array();

    $package_id = Crypt::decryptString($package_id);
    $package = Package::where('id', $package_id)->first();
    $user_id = session()->get('UserSession.id');
    $return_data['agent'] = User::where('id', $user_id)->first();

    //prx($return_data['agent']);
    if ($package) {
      $return_data['package'] =  $package;
    } else {
      \Session::flash("message", "Invalid URL");
      return redirect()->back();
    }

    $return_data['site_title'] = trans('Book Ticket') . ' | ' . $this->data['site_title'];

    return view('front.book_ticket.index', array_merge($return_data));
  }
  public function Packages(REQUEST $request)
  {
    $return_data = array();
    $return_data['site_title'] = trans('Packages') . ' | ' . $this->data['site_title'];
    $packages = [];
    $master_package_list = PackageMaster::where('deleted', '1')->where('status', '1')->get();

    foreach ($master_package_list as $list) {
      $packages[$list->id] = Package::where('master_package_id', $list->id)->where('deleted', '1')->where('status', '1')->get();
    }

    $return_data['packages'] = $packages;
    $return_data['master_package_list'] = $master_package_list;



    return view('front.packages.index', array_merge($return_data));
  }

  public function Index(REQUEST $request)
  {
    $return_data = array();
    $return_data['site_title'] = trans('Agent Register') . ' | ' . $this->data['site_title'];
    
    return view('front/index', array_merge($return_data));

  }


  public function PostRegister(RegisterRequest $request)
  {
    //prx('test');

    $data = $request->all();

    $firststring = substr($data['company_name'], 0, 4);
    $secondstring = substr($data['mobile'], 0, 5);
    $password = $firststring . '@' .    $secondstring;
    $data['password'] = Hash::make($password);


    //prx($data['password']);
    $kpl_licence_img = ImageUploadTrait::uploadImage($request->file('kpl_licence_img'), 'kpl_licence');
    $business_card_img = ImageUploadTrait::uploadImage($request->file('business_card_img'), 'business_card');

    $data['kpl_licence_img'] = $kpl_licence_img;
    $data['business_card_img'] = $business_card_img;
    $data['active_type'] = '0';

    $kpl_licence_file = public_path('upload/kpl_licence/' . $kpl_licence_img);
    $business_card_file = public_path('upload/business_card/' . $business_card_img);

    unset($data["_token"]);
    $agent_id = User::insert($data);
    $email = config('constants.email');
    $state = State::find($request->state_id);
    $data['state_name'] = $state->name;



    Mail::send('front.email.email_verification', $data, function ($message) use ($email, $kpl_licence_file, $business_card_file) {
      $message->to($email)->subject('New Agent Register Successfully');
    });

    \Session::flash("message", "Registration Successfully !! We will review your application within 24 hours");
    return redirect()->back();
  }
}
