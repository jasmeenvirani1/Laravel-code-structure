<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use App\Http\Requests\SettingRequest as ModualRequest; // SettingRequest know as a ModualRequest.
use App\Models\Setting as Model; // Setting know as a Model.

class SettingController extends Controller
{
    public $modual_name = "";
    public $title = "";
    public $view = "";

    public function __construct()
    {
        $this->modual_name = 'setting';
        $this->title = 'Setting';
        $this->view = 'backend.setting.';
    }

    public function Index(Request $request)
    {
        $return_data = [];

        $return_data['site_title'] = trans($this->title) ;
        $return_data['sub_header'] =  $this->title;

        return view($this->view . 'index', array_merge($return_data));
    }

    public function FetchSetting(Request $request)
    {
        if ($request->ajax()) {
            $count = 0;
            $data = Model::orderBy('title', 'DESC')->get();

            return DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('action', function ($row) {
                    $actionBtn =
                        "
                    <button class='btn btn-primary edit-" . $this->modual_name . "' data-id=" .
                        $row->id . "><i class='feather icon-edit'></i></button>";
                    return $actionBtn;
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
    }

   
    public function Edit(Request $request)
    {
        $subscription_detail = Model::where('id', $request->id)->get(['value', 'title', 'id']);

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
            'value' => $request->value,
            'updated_at' => $current_date_time,
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Subscription Update succesfully',
        ]);
    }
}
