<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\User;
use Faker\Core\Uuid;
use App\Models\Option;
use App\Models\Question;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Validator;

class quizController extends Controller
{
    public function quizform(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'name' => 'required|min:4|max:30',
            'descp' => 'required|min:10|max:100'
        ]);
        if ($validator->fails()) {
            // return redirect('/login')->withErrors($validator)
            // ->withInput();
        }

        $uuid = rand(0, 999999); // Adjust the range as needed
        while (DB::table('quizzes')->where('id', $uuid)->exists()) {
            // If not unique, generate a new random number
            $uuid = rand(0, 100000);
        }
        session(['quizID' => $uuid]);
        $quiz = Quiz::create([
            'title' => $req->name,
            'description' => $req->descp,
            'id' => $uuid,
        ]);
        return redirect('/createquiz');
    }

    public function createques(Request $req)
    {
    //    return $req->correct_option==4;
        // $quiz = Quiz::with('questions.options', 'attemptedusers')->find();
        $qid = null;

        // Create a new question
        $newquestion = Question::create([
            'ques' => $req->ques,
            'quiz_id' => session('quizID'),
        ]);

        // Get the ID of the newly created question
        $qid = $newquestion->id;

        // Create multiple options for the question
        $newoptionsData = [
            [
                'opt' => $req->opt1,
                'question_id' => $qid,
                'result' => ($req->correct_option == 1),

            ],
            [
                'opt' => $req->opt2,
                'question_id' => $qid,
                'result' => ($req->correct_option == 2),

            ],
            [
                'opt' => $req->opt3,
                'question_id' => $qid,
                'result' => ($req->correct_option == 3),

            ],
            [
                'opt' => $req->opt4,
                'question_id' => $qid,
                'result' => ($req->correct_option == 4),
            ],
        ];

        // Use the Option model's create method within an array of data
        $newoptions = Option::insert($newoptionsData);

        return redirect('/createquiz');
    }

    public function allquiz()
    {
        $user = User::find(session('loginID'));
        $quizzes = Quiz::with('questions.options')->get();
        if ($user) {
            // return $quizzes;
            return view('allquiz', ['user' => $user, 'quizzes' => $quizzes]);
        } else {
            return 'User not found';
        }
    }
    public function squiz($qid)
    {
        $user = User::find(session('loginID'));
        $quiz = Quiz::with('questions.options')->where('id', $qid)->first();
        if ($user) {
            return view('aquiz', ['user' => $user, 'quiz' => $quiz]);
        } else {
            return 'User not found';
        }
    }
    public function quizsubmit(Request $req, $id)
    {
        // return $req;
        $quiz = Quiz::with('questions.options')->where('id', $id)->first();
        $response = [];
        $score = 0;
        $res = [];

        $index = $quiz->questions[0]->id;

        $outer = 0;
        foreach ($quiz->questions as $question) {
            $ans = Option::where('opt', $req[$index])->first();
            $res[$index] = $req[$index];
            if ($ans->result) {
                $score = $score + 1;
                $response[$outer] = "Correct Answer !!!";
            } else {
                $response[$outer] = "Wrong Answer !!!";
            }
            $outer = $outer + 1;
            $index = $index + 1;
        }
        // return $res;
        // $serializedReq = serialize($req);
        $response['score'] = $score;
        return back()->with(['response' => $response, 'inpt' => $res]);
    }
}
