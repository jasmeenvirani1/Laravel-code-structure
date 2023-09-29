<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use App\Http\Requests\FavouritesRequest as ModualRequest; // FavouritesRequest know as a ModualRequest.
use App\Models\Favourite as Model; // Favourite Model know as a Model.
use App\Models\Favourite;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Session\Session;

class FavouriteController extends Controller
{
    public $modual_name = "";
    public $title = "";
    public $view = "";
    public $userData;


    public function __construct()
    {
        $this->modual_name = 'favourite';
        $this->title = 'Favourite';
        $this->view = 'backend.favourite.';
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
        $role_id = $this->userData['role_id'];
        if ($role_id == '3') {

            $favourite = Favourite::join('users', 'users.id', '=', 'favourites.favourite_id')->where('favourites.user_id', $userId)->where('favourites.deleted', '1')->orderBy('favourites.created_at', 'desc')->take(4)->get();
            $return_data['favourite_recent'] = $favourite;
            $favourite = Favourite::join('users', 'users.id', '=', 'favourites.favourite_id')->where('favourites.user_id', $userId)->where('favourites.deleted', '1')->get();
            $return_data['favourite_all'] = $favourite;
        } elseif ($role_id == '2') {
            $lastSevenDayes = Carbon::now()->subDays(7);
            $userId = $this->userData['id'];
            $favourite = Favourite::join('users', 'users.id', '=', 'favourites.user_id')->where('favourites.favourite_id', $userId)->where('favourites.deleted', '1')->orderBy('favourites.created_at', 'desc')->where('favourites.created_at', '>=', $lastSevenDayes)->get();
            $return_data['favourite_recent'] = $favourite;

            $favourite = Favourite::join('users', 'users.id', '=', 'favourites.user_id')->where('favourites.favourite_id', $userId)->where('favourites.deleted', '1')->where('role_id', '3')->get();
            $return_data['favourite_all'] = $favourite;
        }

        return view($this->view . 'index', array_merge($return_data));
    }

    public function FetchFavourite(Request $request)
    {
        if ($request->ajax()) {
            $userId = $this->userData['id'];
            $role_id = $this->userData['role_id'];

            if ($role_id == 2) {
                $sql = Model::join('users', 'users.id', '=', 'favourites.user_id')
                    ->join('seekers', 'seekers.user_id', '=', 'favourites.user_id')
                    ->where('favourites.favourite_id', '=', $userId);
            } elseif ($role_id == 3) {
                $sql = Model::join('users', 'users.id', '=', 'favourites.favourite_id')
                    ->join('providers', 'providers.user_id', '=', 'favourites.favourite_id')
                    ->where('favourites.user_id', '=', $userId);
            }

            $data = $sql->where('favourites.deleted', '1')->latest('favourites.created_at')->get();
            // prx($data);
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn =
                        "<button class='btn btn-danger delete-" . $this->modual_name . "' data-id=" .
                        $row->id .
                        " title='Delete'><i class='feather icon-trash-2'></i></button>";
                    return $actionBtn;
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
    }

    public function Store(ModualRequest $request)
    {
        $created_at = GetTodayDate();

        $model_save = Model::insert([
            'type' => $request->type,
            'price' => $request->price,
            'description' => $request->description,
            'created_at' => $created_at,
            'updated_at' => $created_at,
        ]);

        return response()->json([
            'status' => 200,
            'message' => ucwords($this->modual_name) . ' add succesfully',
        ]);
    }

    public function Edit(Request $request)
    {
        $subscription_detail = Model::where('id', $request->id)->get(['price', 'type', 'id', 'description']);

        return response()->json([
            'status' => 200,
            'message' => 'subscription detail loaded successfully',
            'detail' => $subscription_detail,
        ]);
    }

    public function Update(ModualRequest $request)
    {
        $current_date_time = GetDateTime();
        $model = Model::where('id', $request->id)->update([
            'price' => $request->price,
            'type' => $request->type,
            'description' => $request->description,
            'updated_at' => $current_date_time,
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Subscription Update succesfully',
        ]);
    }

    public function Delete(Request $request)
    {
        $update_status = Model::where('id', $request->id)->update(['deleted' => '0']);

        return response()->json([
            'status' => 200,
            'message' => 'Subscription Deleted succesfully',
        ]);
    }

    public function ChangeStatus(Request $request)
    {
        Model::where('id', $request->id)->update(['status' => $request->status]);
        return response()->json([
            'status' => 200,
            'message' => 'Subscription Update Succesfully',
        ]);
    }
    
    public function ClearAllFavourite(Request $request)
    {
        $roleId = $this->userData['role_id'];
        $userId = $this->userData['id'];
        if ($roleId == '2') {
            Favourite::where('favourite_id', $userId)->update(['deleted' => '0']);
        } elseif ($roleId == '3')
            Favourite::where('user_id', $userId)->update(['deleted' => '0']);
        return response()->json([
            'status' => 200,
            'message' => 'All clear succesfully',
        ]);
    }
}
