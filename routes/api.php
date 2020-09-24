<?php

use App\Http\Controllers\SurveyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => 'user'], function(){
    Route::POST('register', 'UserController@register');
    Route::POST('login', 'UserController@login');
    Route::get('/survey_list', 'SurveyController@survey_list');
    Route::POST('/fetch_questions/{id}', 'QuestionController@latest_question');
    Route::POST('/submit_answers', 'SurveyController@submit_survey');
    Route::get('/rightanswers_list/{id}', 'SurveyController@get_rightanswers');
});

//Route::group(['prefix' => 'admin','middleware' => ['assign.guard:admins','jwt.auth']],function ()
Route::group(['prefix' => 'admin'], function(){
    Route::POST('register', 'AdminController@admin_register');
    Route::POST('login', 'AdminController@admin_login');
});

Route::group(['prefix' => 'admin','middleware' => ['assign.guard:admins','jwt.auth']],function () {
    Route::get('logout', 'AdminController@admin_logout');
    Route::post('create_survey', 'SurveyController@store_survey');
    Route::get('/get_survey/{id}', 'SurveyController@fetch_survey');
    Route::post('/create_questioniers/{id}', 'QuestionController@questions_choices');
    Route::get('/question_list/{id}', 'QuestionController@get_questions');
    Route::get('/latest_question/{id}', 'QuestionController@latest_question');
    Route::get('/edit_surveys/{survey_id}/{question_id}', 'QuestionController@edit_survey');
    Route::post('/update_survey/{survey_id}', 'QuestionController@update_survey');
    Route::delete('/delete_survey/{survey_id}', 'QuestionController@delete_survey');
    Route::get('/survey_list', 'SurveyController@survey_list');
    Route::delete('/delete_main_survey/{survey_id}', 'SurveyController@delete_survey');

});
