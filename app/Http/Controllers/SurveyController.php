<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Rightanswer;
use App\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SurveyController extends Controller
{
    public function __construct(){

        Auth::shouldUse('admins');
    }

    public function store_survey(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'purpose' => 'required|string',
            'score' => 'required|numeric',
        ]);


        if(Survey::create($data)){
            $surveys = Survey::where('title', '=', $request->title)->get();
            foreach ($surveys as $survey) {
            }
            return response()->json([
                'survey_id' => $survey->id,
            ]);
        }
    }

    public function fetch_survey($id)
    {
        $survey = Survey::find($id);
        return response()->json([
            'survey' => $survey,
        ]);
    }

    public function survey_list()
    {
        return Survey::latest()->get();
    }

    public function delete_survey($id)
    {
        Survey::destroy($id);
    }

    public function submit_survey(Request $request)
    {

        $results = $request->results;
        foreach($results as $result){
            //print_r($result->survey_id) ;
                $answer = new Answer([
                  'survey_id' => $result['survey_id'],
                  'questionier_id' => $result['question'],
                  'choice_id' => $result['answer'],
                ]);
                $answer->save();
        }

    }

    public function get_rightanswers($id)
    {
        $collections =  Rightanswer::where('survey_id', $id)->latest()->get();
        return $collections->pluck('right_answer');
    }
}
