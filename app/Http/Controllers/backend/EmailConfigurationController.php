<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use App\Http\Requests\EmailConfigurationRequest as ModualRequest; // SubscriptionRequest know as a ModualRequest.
use App\Models\EmailConfiguration as Model; // Keyword know as a Model.
use Illuminate\Contracts\Session\Session;

class EmailConfigurationController extends Controller
{
    public $modual_name = "";
    public $title = "";
    public $view = "";
    public $userData;

    public function __construct()
    {
        $this->modual_name = 'email-configuration';
        $this->title = 'Email Configuration';
        $this->view = 'backend.email-configuration.';
        $this->middleware(function ($request, $next) {
            $this->userData = session('UserSession');
            return $next($request);
        });
    }

    public function Index(Request $request)
    {
        $return_data = [];
        $data =  Model::get();
        $return_data['data'] = $data;
        $return_data['site_title'] = trans($this->title);
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

   

    public function Update(ModualRequest $request)
    {
        $data = $request->all();
        unset($data['_token']);

        foreach($data as $list => $value){
            Model::where('key', $list)->update(['value'=>$value]);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Email Configyraction Update succesfully',
        ]);
    }

}
