<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use App\Http\Requests\SubscriptionRequest as ModualRequest; // SubscriptionRequest know as a ModualRequest.
use App\Models\Subscription as Model; // Question know as a Model.

class SubscriptionController extends Controller
{
    public $modual_name = "";
    public $title = "";
    public $view = "";

    public function __construct()
    {
        $this->modual_name = 'subscription';
        $this->title = 'Subscription Plan';
        $this->view = 'backend.subscription.';
    }

    public function Index(Request $request)
    {
        $return_data = [];

        $return_data['site_title'] = trans($this->title) ;
        $return_data['sub_header'] = 'Subscription';

        return view($this->view.'index', array_merge($return_data));
    }

    public function FetchSubscription(Request $request)
    {
        if ($request->ajax()) {
            $count = 0;
            $data = Model::where('deleted', '1')
                ->latest()
                ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    if ($row->status == '0') {
                        $status = "<button class='btn badge badge-light-danger' onclick=ChangeStatus(" . $row->id . ",'1')>Inactive</button>";
                    } else {
                        $status = "<button class='btn badge badge-success h4' onclick=ChangeStatus(" . $row->id . ",'0') >Active</button>";
                    }
                    return $status;
                })
                ->addColumn('action', function ($row) {
                    $actionBtn =
                        "
                    <button class='btn btn-primary edit-" . $this->modual_name . "' data-id=" .
                        $row->id .
                        "><i class='feather icon-edit'></i></button>&nbsp
                    <button class='btn btn-danger delete-" . $this->modual_name . "' data-id=" .
                        $row->id .
                        "><i class='feather icon-trash-2'></i></button>";
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
            'message' => ucwords($this->modual_name).' add succesfully',
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
}
