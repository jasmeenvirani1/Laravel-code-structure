<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use App\Http\Requests\SubscriptionRequest as ModualRequest; // SubscriptionRequest know as a ModualRequest.
use App\Models\Permission as Model; // Question know as a Model.

class PermissionController extends Controller
{
    public $modual_name = "";
    public $title = "";
    public $view = "";

    public function __construct()
    {
        $this->modual_name = 'permission';
        $this->title = 'Permission';
        $this->view = 'backend.permission.';
    }

    public function Index(Request $request)
    {
        $return_data = [];

        $return_data['site_title'] = trans($this->title);
        $return_data['sub_header'] =  $this->title;

        return view($this->view . 'index', array_merge($return_data));
    }

    public function FetchPermission(Request $request)
    {
        if ($request->ajax()) {
            $count = 0;
            $data = Model::where('status', '1')->orderBy('title', 'DESC')->get();

            return DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('action', function ($row) {
                    $actionBtn =
                        "
                    <button class='btn btn-primary edit-" . $this->modual_name . "' data-id=" .
                        $row->id .
                        " data-label=" . $row->title . "><i class='feather icon-edit'></i></button>";
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
        $subscription_detail = Model::where('id', $request->id)->get(['roll_ids', 'id']);

        return response()->json([
            'status' => 200,
            'message' => 'subscription detail loaded successfully',
            'detail' => $subscription_detail,
        ]);
    }

    public function Update(ModualRequest $request)
    {
        $parmissions = array();
        if (isset($request->provider)) {
            array_push($parmissions, '2');
        }
        if (isset($request->seeker)) {
            array_push($parmissions, '3');
        }

        $parmissions = json_encode($parmissions);
        $current_date_time = GetDateTime();

        $model = Model::where('id', $request->id)->update([
            'id' => $request->id,
            'roll_ids' => $parmissions,
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
}
