<?php

namespace App\Http\Controllers;

use App\Choice;
use App\Questionier;
use App\rightanswer;
use App\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class QuestionController extends Controller
{
    public function __construct()
    {
        Auth::shouldUse('admins');
    }

    // create questions
    public function questions_choices(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'question' => 'required|string',
            'choices.*' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(
                ['question_errors' => $validator->errors()],
                422
            );
        }

        $data['survey_id'] = $id;
        $data['question'] = $request->question;

        if (Questionier::create($data)) {
            $questions = Questionier::where('question', '=', $request->question)->get();
            foreach ($questions as $question) {
            }
            foreach($request->choice_details as $choice_detail){
                //print_r($result->survey_id) ;
                    $choice = new Choice([
                      'survey_id' =>$id,
                      'questionier_id' => $question->id,
                      'choices' => $choice_detail['choice_name'],
                      'options' => $choice_detail['option'],
                    ]);
                    $choice->save();
            }

            Rightanswer::create(
                [
                    'survey_id' => $id,
                    'questionier_id' => $question->id,
                    'right_answer' => $request->right_answer,
                ]

            );
        }
    }

    public function get_questions(Request $request, $id)
    {
        //    $data = Questionier::with('choices')->where('survey_id', '=', $id)
        //    ->latest()
        //    ->first();

        return Questionier::with('choices')
            ->where('survey_id', '=', $id)
            ->get();


        //return response()->json(['questions' => $questions]);

    }

    public function latest_question(Request $request, $id)
    {
        //return Questionier::latest()->get();
        return Questionier::with('choices', 'rightanswer')
            ->where('survey_id', '=', $id)
            ->orderBy('id', 'desc')
            ->get();
        // return response()->json([
        //     'last_data' => $data,
        // ]);
    }

    public function edit_survey(Request $request, $survey_id, $question_id)
    {
        return Questionier::with('choices')
        ->where('survey_id', '=', $survey_id)
        ->where('id', '=', $question_id)
        ->get();
    }

    public function update_survey(Request $request)
    {
        $update_question = Questionier::findOrFail($request->question_id);
        $update_question->question = $request->question;
        //$update_question->save();
        if($update_question->save()){
            foreach($request->choices as $choice)
            {
                $id = $choice['id'];
                $choices = $choice['choices'];
                $choice = Choice::findOrFail($id);

                $choice->update([
                     'choices' => $choices,
                ]);
            }

        }
    }

    public function delete_survey(Request $request)
    {
        if(Questionier::destroy($request->question_id)){
            $collection = collect($request->choices);
            $choices_ids = $collection->pluck('id');
            Choice::destroy(collect($choices_ids));
        }

    }


}
