<?php

use App\User;


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get("insert_admin","UserController@insertAdmin");
Route::get("delete_user/{id}",'UserController@delete_user')->middleware(['auth']);
Route::post("edit_user/{id}",'UserController@edit_user')->middleware(['auth']);
Route::get
		("add_user/bulk_user_registeration",
			'UserController@bulkRegisteration')
								->middleware(['auth']);

Route::auth();

Route::get('/home', 'HomeController@index');
Route::get('/show_users', 'HomeController@showUsers')->middleware(['auth']);
Route::get('/my_projects', 'HomeController@myProjects')->middleware(['auth']);
Route::get('/show_all_projects', 'HomeController@showAllProjects')->middleware(['auth']);

Route::get("create_project","ProjectController@index")->middleware(['auth']);
Route::post("create_project","ProjectController@create_project")->middleware(['auth']);
Route::post("edit_project/{id}",'ProjectController@edit_project')->middleware(['auth']);
Route::get("delete_project/{id}",'ProjectController@delete_project')->middleware(['auth']);
Route::get("add_questioner/{project_id}",'QuestionerController@view_add_questioner_form')->middleware(['auth']);
Route::post("add_questioner",'QuestionerController@add_questioner')->middleware(['auth']);
Route::get("create_questioner",'QuestionerController@view_create_questioner_form')->middleware(['auth']);
Route::post("create_questioner",'QuestionerController@create_questioner')->middleware(['auth']);
Route::get
	('/show_questioners', 'HomeController@showQuestioners')->middleware(['auth']);
Route::post("edit_questioner/{id}",'QuestionerController@edit_questioner')->middleware(['auth']);
Route::get("delete_questioner/{id}",'QuestionerController@delete_questioner')->middleware(['auth']);

Route::get
	('/questions_page/{questioner_id}', 'HomeController@showQuestions')->middleware(['auth']);

Route::post
	('/add_question/toQuestioner_{questioner_id}', 'QuestionController@view_create_question_form')->middleware(['auth']);
Route::post
	('/insert_question', 'QuestionController@insertQuestion')->middleware(['auth']);
