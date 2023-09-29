<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use App\Http\Requests\KeywordRequest as ModualRequest; // SubscriptionRequest know as a ModualRequest.
use App\Models\Keyword as Model; // Keyword know as a Model.
use Illuminate\Contracts\Session\Session;

class KeywordController extends Controller
{
    public $modual_name = "";
    public $title = "";
    public $view = "";
    public $userData;

    public function __construct()
    {
        $this->modual_name = 'keyword';
        $this->title = 'Keyword';
        $this->view = 'backend.keyword.';
        $this->middleware(function ($request, $next) {
            $this->userData = session('UserSession');
            return $next($request);
        });
    }

    public function Index(Request $request)
    {
        $return_data = [];
        $return_data['site_title'] = trans($this->title) ;

        $return_data['sub_header'] = $this->title;

        return view($this->view . 'index', array_merge($return_data));
    }

    public function FetchKeyword(Request $request)
    {

        if ($request->ajax()) {
            $userId = $this->userData['id'];

            $data = Model::where('deleted', '1')->where('user_id', $userId)
                ->latest()
                ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    if ($row->status == '0') {
                        $status = "<button class='btn badge badge-light-danger' onclick=ChangeStatus(" . $row->id . ",'1') title='Inactive'>Inactive</button>";
                    } else {
                        $status = "<button class='btn badge badge-success h4' onclick=ChangeStatus(" . $row->id . ",'0')  title='Active'>Active</button>";
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
            'keyword' => $request->keyword,
            'user_id' => $this->userData['id'],
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
        $keyword_detail = Model::where('id', $request->id)->get(['id','keyword']);

        return response()->json([
            'status' => 200,
            'message' => 'keyword detail loaded successfully',
            'detail' => $keyword_detail,
        ]);
    }

    public function Update(ModualRequest $request)
    {
        $current_date_time = GetDateTime();
        $model = Model::where('id', $request->id)->update([
            'keyword' => $request->keyword,
            'updated_at' => $current_date_time,
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Keyword Update succesfully',
        ]);
    }

    public function Delete(Request $request)
    {
        $update_status = Model::where('id', $request->id)->update(['deleted' => '0']);

        return response()->json([
            'status' => 200,
            'message' => 'Keyword Deleted succesfully',
        ]);
    }

    public function ChangeStatus(Request $request)
    {
        Model::where('id', $request->id)->update(['status' => $request->status]);
        return response()->json([
            'status' => 200,
            'message' => 'Keyword Update Succesfully',
        ]);
    }
}
