<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use App\Http\Requests\QuestionRequest as ModualRequest; // QuestionRequest know as a ModualRequest.
use App\Http\Requests\OptionRequest; // QuestionRequest know as a ModualRequest.
use App\Models\Question as Model; // Question know as a Model.
use App\Models\Option as OptionModel; // Question know as a Model.
use App\Models\Service;

class QuestionController extends Controller
{
    public $modual_name = "";
    public $title = "";
    public $view = "";

    public function __construct()
    {
        $this->modual_name = 'question';
        $this->title = 'Question List';
        $this->view = 'backend.question.';
    }

    public function Index(Request $request)
    {
        $return_data = [];

        $return_data['site_title'] = trans($this->title);
        $return_data['sub_header'] = 'Customer';
        $return_data['services_list'] = Service::where(['status' => '1'], ['deleted' => '1'])->get(['name', 'id']);

        return view('backend.question.index', array_merge($return_data));
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
                        $status = "<button class='btn badge badge-success h4' onclick=ChangeStatus(" . $row->id . ",'1')>Active</button>";
                    } else {
                        $status = "<button class='btn badge badge-light-danger' onclick=ChangeStatus(" . $row->id . ",'0') >Inactive</button>";
                    }
                    return $status;
                })
                ->addColumn('action', function ($row) {
                    $actionBtn =
                        "<button class='btn btn-warning add_option' data-id=" .
                        $row->id .
                        "><i class='feather icon-plus'></i></button>&nbsp
                    <button class='btn btn-primary edit-question' data-id=" .
                        $row->id .
                        "><i class='feather icon-edit'></i></button>&nbsp
                    <button class='btn btn-danger delete-question' data-id=" .
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
            'question' => $request->question,
            'created_at' => $created_at,
            'updated_at' => $created_at,
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Question add succesfully',
        ]);
    }
    public function Edit(Request $request)
    {
        $user_detail = Model::where('id', $request->questionId)->get(['question', 'id']);

        return response()->json([
            'status' => 200,
            'message' => 'user_detail loaded successfully',
            'user_detail' => $user_detail,
        ]);
    }

    public function Update(ModualRequest $request)
    {
        $current_date_time = GetDateTime();
        $model = Model::where('id', $request->id)->update([
            'question' => $request->question,
            'updated_at' => $current_date_time,
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Question Update succesfully',
        ]);
    }

    public function Delete(Request $request)
    {
        $update_status = Model::where('id', $request->questionId)->update(['deleted' => '0']);

        return response()->json([
            'status' => 200,
            'message' => 'Question Deleted succesfully',
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

        $model_save = OptionModel::insert([
            'question_id' => $request->question_id,
            'option' => $request->option,
            'service_id' => $request->service_id,
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
        if ($request->ajax()) {
            $count = 0;
            $data = OptionModel::join('services', 'services.id', '=', 'options.service_id')->where('options.deleted', '1')
                ->where('options.question_id', $request->questionId)
                ->latest('options.created_at')
                ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = "<a href=javascript:void(0) class='delete-option text-danger' data-id=" . $row->id . '><i class="feather icon-trash-2"></i></a>&nbsp';
                    return $actionBtn;
                })
                ->addColumn('service', function ($row) {
                    return $row->name;
                })
                ->make(true);
        }
    }

    public function DeleteOption(Request $request)
    {
        $update_status = OptionModel::where('id', $request->optionId)->update(['deleted' => '0']);

        return response()->json([
            'status' => 200,
            'message' => 'Option Deleted succesfully',
        ]);
    }
}
