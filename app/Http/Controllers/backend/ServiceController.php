<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use App\Http\Requests\ServiceRequest as ModualRequest; // QuestionRequest know as a ModualRequest.
use App\Http\Requests\OptionRequest; // QuestionRequest know as a ModualRequest.
use App\Models\Service as Model; // Question know as a Model.

class ServiceController extends Controller
{
    public $modual_name = "";
    public $title = "";
    public $view = "";

    public function __construct()
    {
        $this->modual_name = 'service';
        $this->title = 'Service List';
        $this->view = 'backend.service.';
    }

    public function Index(Request $request)
    {
        $return_data = [];

        $return_data['site_title'] = trans($this->title) ;
        $return_data['sub_header'] = 'Service';
        return view('backend.service.index', array_merge($return_data));
    }

    public function FetchQuestion(Request $request)
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
                    <button class='btn btn-primary edit-service' data-id=" .
                        $row->id .
                        "><i class='feather icon-edit'></i></button>&nbsp
                    <button class='btn btn-danger delete-service' data-id=" .
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
            'name' => $request->name,
            'created_at' => $created_at,
            'updated_at' => $created_at,
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Service add succesfully',
        ]);
    }
    public function Edit(Request $request)
    {
        $service_detail = Model::where('id', $request->id)->get(['name', 'id']);

        return response()->json([
            'status' => 200,
            'message' => 'user_detail loaded successfully',
            'detail' => $service_detail,
        ]);
    }

    public function Update(ModualRequest $request)
    {
        $current_date_time = GetDateTime();
        $model = Model::where('id', $request->id)->update([
            'name' => $request->name,
            'updated_at' => $current_date_time,
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Service Update succesfully',
        ]);
    }

    public function Delete(Request $request)
    {
        $update_status = Model::where('id', $request->id)->update(['deleted' => '0']);

        return response()->json([
            'status' => 200,
            'message' => 'Service Deleted succesfully',
        ]);
    }

    public function ChangeStatus(Request $request)
    {
        Model::where('id', $request->id)->update(['status' => $request->status]);
        return response()->json([
            'status' => 200,
            'message' => 'User Status Update Succesfully',
        ]);
    }

    public function StoreOption(OptionRequest $request)
    {
        $created_at = GetTodayDate();

        $model_save = Model::insert([
            'question_id' => $request->question_id,
            'option' => $request->option,
            'created_at' => $created_at,
            'updated_at' => $created_at,
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Option added succesfully',
        ]);
    }

    public function GetOption(Request $request)
    {
        //prx($_GET);
        if ($request->ajax()) {
            $count = 0;
            $data = Model::where('deleted', '1')
                ->where('question_id', $request->questionId)
                ->latest()
                ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = "<a href=javascript:void(0) class='delete-option text-danger' data-id=" . $row->id . '><i class="feather icon-trash-2"></i></a>&nbsp';
                    return $actionBtn;
                })
                ->make(true);
        }
    }

    public function DeleteOption(Request $request)
    {
        $update_status = Model::where('id', $request->optionId)->update(['deleted' => '0']);

        return response()->json([
            'status' => 200,
            'message' => 'Option Deleted succesfully',
        ]);
    }
}
