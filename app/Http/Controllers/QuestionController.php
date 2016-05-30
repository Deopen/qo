<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;
use App\Question;
use App\Questioner;
use Auth;

class QuestionController extends Controller
{
    public function view_create_question_form(Request $req,$questioner_id){

    	return view('insert_question',['questioner_id'=>$questioner_id]);
    }//end view create question form

    public function insertQuestion(Request $req){

    	if (Auth::user()->isAdmin()) {
    		$questioner_id=trim($req->input('questioner_id'));
    		$question=new Question();
    		$question->questioner_id=$questioner_id;
    		$question->content=trim($req->input('content'));
    		$question->save();
    		$questioner=Questioner::where('id',$questioner_id)->first();
    		$questioner->questions_count=$questioner->questions_count+1;
    		$questioner->save();
    	}//end if is admin

    }//end insert question


}
