<?php

use App\Package;
use App\Models\Project;
use App\Models\Team;
use App\Models\Customer;
use App\Models\Favourite;
use App\Models\User;
use App\Models\WorkProfile;
use App\Models\Item;
use App\Models\Installation;
use App\Models\Page;
use App\Models\Setting;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\NotificationSendController;



function Prx($arr)
{
    echo "<pre>";
    print_r($arr);
    die();
}


function GetName($action, $match_value)
{
    $select_data = '';

    if ($action == 'get_date_time_format') {
        $date_start_date_array_value = date('Y', strtotime($match_value));
        if ($date_start_date_array_value != '1970') {
            $select_data = date('Y-m-d H:i:s', strtotime($match_value));
        }
    } elseif ($action == 'get_date_format') {
        $date_start_date_array_value = date('Y', strtotime($match_value));
        if ($date_start_date_array_value != '1970') {
            $select_data = date('Y-m-d', strtotime($match_value));
        }
    } elseif ($action == 'get_default_date_time_format') {
        $date_start_date_array_value = date('Y', strtotime($match_value));
        if ($date_start_date_array_value != '1970') {
            $select_data = date('Y/m/d H:i:s', strtotime($match_value));
        }
    } elseif ($action == 'get_date_time_forma_24') {
        $to_date_start_date_array_value = date('d-m-Y g:i A', strtotime($match_value));
        $select_data = $to_date_start_date_array_value;
    } elseif ($action == 'get_date_time_indian_format') {
        ///from to till date draw will be running once created
        $select_data = date('d-m-Y H:i:s', strtotime($match_value));
    } elseif ($action == 'standard_time') {
        ///from to till date draw will be running once created
        $select_data = date('Y-m-d', strtotime($match_value));
    } elseif ($action == 'get_date_indian_format') {
        $to_date_start_date_array_value = date('d-m-Y', strtotime($match_value));
        $select_data = $to_date_start_date_array_value;
    } elseif ($action == 'get_time_format') {
        $date_start_date_array_value = date('Y', strtotime($match_value));
        if ($date_start_date_array_value != '1970') {
            $select_data = date('H:i', strtotime($match_value));
        }
    } elseif ($action == 'get_malaysia_date_format') {
        $date = new \DateTime($match_value);
        $select_data = $date->format("j M y");
    } elseif ($action == 'get_time_am_pm') {
        $select_data = date('g:i A', strtotime($match_value));
    }


    return $select_data;
}




function UserPasswordReset($user_id)
{

    $model = User::find($user_id);

    if ($model) {
        $model->password = Hash::make('12345678');
        $model->save();
    }


    return true;
}
function CreateUser($user_type)
{
    $password = '12345678';

    if ($user_type == 'customer') {
        $role_id = '2';
        $name = 'SCH' . rand(1111, 9999);
    }
    if ($user_type == 'team') {
        $role_id = '4';
        $name = 'T' . rand(11111, 99999);
    }
    $user_id = User::create([
        'name' => $name,
        'password' => Hash::make($password),
        'role_id' => $role_id
    ])->id;

    return $user_id;
}

function GetProjectList()
{
    $list = Project::where('status', '1')->where('deleted', '1')->get();

    return $list;
}


function GetWorkProfileName($work_profile_id)
{
    $WorkProfile = WorkProfile::where('id', $work_profile_id)->where('status', '1')->where('deleted', '1')->first();
    $name = '';
    if ($WorkProfile) {
        $name =  $WorkProfile->name;
    }

    return $name;
}



function GetProjectName($project_id)
{
    $project_name = Project::where('id', $project_id)->first();

    $name = '';
    if ($project_name) {
        $name = $project_name->name;
    }

    return $name;

    return $project_name->name;
}
function GetTeamName($team_id)
{

    $team_name = Team::where('id', $team_id)->first();
    $name = '';
    if ($team_name) {
        $name = $team_name->name;
    }
    return $name;
}



function GetCustomerName($customer_id)
{
    // Prx($team_id);
    $customer_name = Customer::where('id', $customer_id)->first();
    $name = '';
    if ($customer_name) {
        $name = $customer_name->name;
    }

    return $name;
}
function GetCustomerCode($customer_id)
{
    $customer_code = Customer::where('id', $customer_id)->first();
    $code = '';
    if ($customer_code) {
        $code = $customer_code->code;
    }
    return $code;
}
function GetWorkProfile($project_id)
{
    // Prx($team_id);
    $work_profile = WorkProfile::where('id', $project_id)->first();
    $name = '';
    if ($work_profile) {
        $name = $work_profile->name;
    }

    return $name;
}

function GetItemName($item_id)
{
    // Prx($team_id);
    $item_name = Item::where('id', $item_id)->first();
    $name = '';
    if ($item_name) {
        $name =  $item_name->name;
    }

    return $name;
}

function GetTeamUserName($team_id)
{

    $team_name = User::where('id', $team_id)->first();
    $name = '';
    if ($team_name) {
        $name = $team_name->name;
    }
    return $name;
}

function GetDateTime()
{
    $date_time = date('Y-m-d H:i:s');
    return $date_time;
}

function GetTodayDate()
{
    $date = date('Y-m-d');
    return $date;
}

function GeDateTimeFormate()
{
    $date = new \DateTime();
    $date = $date->format("H:iA, d F y");

    return $date;
}

function GetBookingDateFormat($date)
{
    $date = new \DateTime($date);
    $date = $date->format("Y-m-d");

    return $date;
}

function GetDateFormat($date)
{
    $date = new \DateTime($date);
    $date = $date->format("d F Y");

    return $date;
}
function GetCountOfWork($id)
{
    return Installation::where('team_id', $id)->count();
}
function GetImagePath($installation_id = null, $work_profile_id = null, $customer_id = null)
{
    $path = "";
    if (strlen($installation_id) <= 0) {

        $customer_name = GetCustomerCode($customer_id);
        $customer_name = ReplaceStringsToLower($customer_name, " ", "_");
        $path .= $customer_name;


        $work_profile_data = WorkProfile::where('id', $work_profile_id)->get(['name']);
        $activity_name = $work_profile_data[0]->name;
        $customer_name = ReplaceStringsToLower($activity_name, " ", "_");
        $path .= '/' . $customer_name;
    } else {
        $installation_data = Installation::join('customers', 'customers.id', '=', 'installations.customer_id')
            ->join('work_profiles', 'work_profiles.id', '=', 'installations.work_profile_id')
            ->where('installations.id', $installation_id)->get(['customers.id as customer_id', 'work_profiles.name as activity_name']);


        $customer_name = GetCustomerCode($installation_data[0]->customer_id);
        $customer_name = ReplaceStringsToLower($customer_name, " ", "_");
        $path .=  'upload/' . $customer_name;

        $activity_name = $installation_data[0]->activity_name;
        $activity_name = ReplaceStringsToLower($activity_name, " ", "_");
        $path .= '/' . $activity_name . '/';
    }
    return $path;
}
function ReplaceStringsToLower($string, $remove_item, $replace_item)
{
    $str = strtolower(str_replace($remove_item, $replace_item, $string));
    return $str;
}
function GetRoleId($rollname)
{
    if ($rollname == 'provider') {
        $role_id = 2;
    } elseif ($rollname = "seeker") {
        $role_id = 3;
    } else {
        $role_id = 0;
    }
    return $role_id;
}
function DeleteDataByIdAndTableName($tabel_name, $id)
{
    DB::table($tabel_name)->where('id', $id)->delete();
}
function GetRoleName($role)
{
    $roles = ['1' => 'Admin', '2' => 'Provider', '3' => 'Seeker'];
    return $roles[$role];
}
function MakeDiveable($count)
{
    if ($count == 0) {
        $count = 1;
    }
    return $count;
}
function CheckPermissionForUser($modualName)
{
    $data = DB::table('permissions')->where('modual', $modualName)->get('roll_ids');
    try {
        $roll_id =  session('UserSession.role_id');
        if ($roll_id != 1) {
            $roll_ids_array = json_decode($data[0]->roll_ids);
            if (in_array($roll_id, $roll_ids_array)) {
                $value = true;
            } else {
                $value = false;
            }
        } else {
            $value = true;
        }
        return $value;
    } catch (Exception $e) {
        return false;
    }
}
function GetFooter()
{
    $footerData = Page::where('deleted', '1')->get();
    return $footerData;
}
function GetSetting($key)
{
    $settingData = Setting::where('key', $key)->get(['value']);
    if (isset($settingData[0])) {
        $value = $settingData[0]->value;
    } else {
        $value = '';
    }
    return  $value;
}
function GetCurrentProfile()
{
    $userId = session('UserSession')['id'];
    $data = User::where('id', $userId)->get('profile_image');
    return $data[0]->profile_image;
    // return  $userId;
}
function GetProviderFavouritCount($provider_id)
{
    $count = Favourite::where('favourite_id', $provider_id)->where('deleted', '1')->count();
    return $count;
}
function GetSeekerFavouritCount($seeker_id)
{
    $count = Favourite::where('user_id', $seeker_id)->where('deleted', '1')->count();
    return $count;
}
function GetDataUsingTabelAndId($tabel_name, $id)
{
    $data = DB::table($tabel_name)->where('id', $id)->get();
    return $data;
}
function sendNotifaction($userId, $title = "Flit", $message = "Flit")
{
    $notifaction = new NotificationSendController();
    $notifaction->sendNotification($userId, $title, $message);
}
function getIp()
{
    $ip = '103.105.235.246';
    if (isset($_SERVER['REMOTE_ADDR'])) {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
function getUserLocationData($ip = '103.105.235.246')
{
    $data = \Location::get($ip);
    return $data;
}
function GetProviderPlanStatus($id)
{
    $users = User::where('role_id', '2')->where('id', $id)->get('plan_purchase_status');
    return $users[0]->plan_purchase_status;
}
