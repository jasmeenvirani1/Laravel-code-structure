<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Option;
use App\Models\Question;
use App\Models\Answer;

class MatchController extends Controller
{
    public $userData;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->userData = session('UserSession');
            return $next($request);
        });
    }

    public function Index()
    {
        if ($this->userData['role_id'] != 3) {
            return redirect(route('user.logout'));
        }
        $finalArr = array();
        $questionData = Question::orderBy('id', 'desc')->where('deleted', '1')->where('status', '0')->get(['id', 'question']);
        foreach ($questionData as $q) {
            $detail = array();
            $opctions = array();
            $opctionIds = array();
            $opctionData = Option::where('question_id', $q->id)->where('deleted', '1')->get();
            $detail['question_id'] = $q->id;
            $detail['question'] = $q->question;
            foreach ($opctionData as $opction) {
                $opctions[] = $opction->option;
                $opctionIds[] = $opction->id;
            }
            $detail['opction'] = $opctions;
            $detail['opction_ids'] = $opctionIds;
            $finalArr[] = $detail;
        }
        $return_data['question_list'] = $finalArr;
        $return_data['site_title'] = trans('Match');
        return view('front.match.index', array_merge($return_data));
    }
    public function AddMatch(Request $request)
    {
        Answer::where('user_id', $this->userData['id'])->update(['status' => '0']);

        foreach ($request->questionid as $questionId) {
            $keyName = 'opction' . $questionId;
            $opctionId = $request[$keyName];
            $createdAt = GetDateTime();
            Answer::insert(['user_id' => $this->userData['id'], 'question_id' => $questionId, 'opction_id' => $opctionId, 'created_at' => $createdAt, 'updated_at' => $createdAt]);
        }
        return response()->json([
            'status' => 1,
            'message' => 'Match added succesfully',
        ]);
    }
}
