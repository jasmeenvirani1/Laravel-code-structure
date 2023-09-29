<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\FeedbackRequest;
use App\Models\Feedback;
use Illuminate\Http\Request;
use App\Models\Subscription;

class FeedbackController extends Controller
{
    public function Index()
    {
        $return_data['subscription_plans'] = Subscription::where('deleted', '1')->where('status', '1')->get();
        $return_data['site_title'] = trans('Match');

        return view('front.feedback.index', array_merge($return_data));
    }
    public function Store(FeedbackRequest $request)
    {
        $feedback = new Feedback();
        $feedback->fristname = $request->firstname;
        $feedback->lastname = $request->lastname;
        $feedback->email = $request->email;
        $feedback->feedback = $request->feedback;
        $feedback->created_at = GetDateTime();
        $feedback->updated_at = GetDateTime();
        $feedback->save();
        
        return response()->json([
            'status'=>1,
            'message' => 'Feedbackl add succesfully',
        ]);
    }
}
