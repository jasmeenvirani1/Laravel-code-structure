<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use App\Http\Requests\WorkoutCategoryRequest as ModualRequest; // QuestionRequest know as a ModualRequest.
use App\Http\Requests\OptionRequest; // QuestionRequest know as a ModualRequest.
use App\Models\WorkoutCategory as Model; // Question know as a Model.
use App\Models\Option as OptionModel; // Question know as a Model.
use App\Models\Service;
use App\Models\WorkoutSubCategory;

class WorkoutController extends Controller
{
    public $modual_name = "";
    public $title = "";
    public $view = "";

    public function __construct()
    {
        $this->modual_name = 'workout category';
        $this->title = 'Workout Category';
        $this->view = 'backend.workout_category.';
    }

    public function Index(Request $request)
    {
        $return_data = [];

        $return_data['site_title'] = trans($this->title);
        $return_data['sub_header'] = 'Customer';
        $return_data['services_list'] = Service::where(['status' => '1'], ['deleted' => '1'])->get(['name', 'id']);

        return view($this->view . 'index', array_merge($return_data));
    }

    public function FetchWorkoutCategory(Request $request)
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
                        $status = "<button  class='btn badge badge-light-danger' onclick=ChangeStatus(" . $row->id . ",'1')>Inactive</button>";
                    } else {
                        $status = "<button class='btn badge badge-success h4' onclick=ChangeStatus(" . $row->id . ",'0') >Active</button>";
                    }
                    return $status;
                })
                ->addColumn('action', function ($row) {
                    $actionBtn =
                        "<button class='btn btn-warning add_option' data-id=" .
                        $row->id .
                        "><i class='feather icon-plus'></i></button>&nbsp
                    <button class='btn btn-primary edit-workout-category' data-id=" .
                        $row->id .
                        "><i class='feather icon-edit'></i></button>&nbsp
                    <button class='btn btn-danger delete-workout-category' data-id=" .
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
        $created_at = GetDateTime();

        $model_save = Model::insert([
            'name' => $request->name,
            'created_at' => $created_at,
            'updated_at' => $created_at,
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Workout category add succesfully',
        ]);
    }
    public function Edit(Request $request)
    {
        $user_detail = Model::where('id', $request->workoutId)->get(['name', 'id']);

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
            'name' => $request->name,
            'updated_at' => $current_date_time,
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Workout category update succesfully',
        ]);
    }

    public function Delete(Request $request)
    {
        $update_status = Model::where('id', $request->workoutId)->update(['deleted' => '0']);
        $update_status = WorkoutSubCategory::where('cat_id', $request->workoutId)->update(['deleted' => '0']);

        return response()->json([
            'status' => 200,
            'message' => 'Workout category deleted succesfully',
        ]);
    }
    public function ChangeStatus(Request $request)
    {
        Model::where('id', $request->id)->update(['status' => $request->status]);
        WorkoutSubCategory::where('cat_id', $request->id)->update(['status' => $request->status]);

        return response()->json([
            'status' => 200,
            'message' => 'User Status Update Succesfully',
        ]);
    }

    public function StoreSubWorkout(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);


        $created_at = GetDateTime();

        $model_save = WorkoutSubCategory::insert([
            'cat_id' => $request->id,
            'name' => $request->name,
            'created_at' => $created_at,
            'updated_at' => $created_at,
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Sub workout categorys added succesfully',
        ]);
    }

    public function GetSubWorkout(Request $request)
    {
        if ($request->ajax()) {
            $count = 0;
            $data = WorkoutSubCategory::join('workout_categorys', 'workout_categorys.id', '=', 'workout_sub_categorys.cat_id')->where('workout_sub_categorys.deleted', '1')
                ->where('workout_sub_categorys.cat_id', $request->questionId)
                ->latest('workout_sub_categorys.created_at')
                ->get(['workout_sub_categorys.name', 'workout_sub_categorys.id']);

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $actionBtn = "<a href=javascript:void(0) class='delete-option text-danger' data-id=" . $row->id . '><i class="feather icon-trash-2"></i></a>&nbsp';
                    return $actionBtn;
                })
                ->make(true);
        }
    }

    public function DeleteSubWorkout(Request $request)
    {
        $update_status = WorkoutSubCategory::where('id', $request->id)->update(['deleted' => '0']);

        return response()->json([
            'status' => 200,
            'message' => 'Workout sub category deleted succesfully',
        ]);
    }
}
