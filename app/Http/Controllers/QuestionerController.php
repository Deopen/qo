<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Questioner;
use App\User;
use Auth;

class QuestionerController extends Controller
{
    public function view_add_questioner_form($project_id) {
    	// show all questioner
    	// send questioner to form
    	return view("add_questioner",["project_id"=>$project_id]);
    }//end view add questioner form
    

    public function view_create_questioner_form() {
    	// show all questioner
    	// send questioner to form
    	return view("create_questioner");
    }//end view add questioner form
    

	public function create_questioner(Request $req) {
    	//var_dump($req->all());
		//validating thins
		if (Auth::user()->isAdmin()) {
			$questioner=new Questioner();
			$questioner->name=$req->input('name');
			$questioner->description=$req->input('description');
			$questioner->save();
			return redirect('show_questioners');
		}//end if its admin
    }//end create questioner

    public function add_questioner(Request $req){
    	echo $req->input('project_id')."<br>";
    	echo $req->input('name')."<br>";
    	echo $req->input('description');
    	//log adding questioner
    }//end add questioner

    public function edit_questioner(Request $req,$id) {

    	if (Auth::user()->isAdmin()) {

    		$questioner = 
    		Questioner::where('id',$id)->first();
    		$questioner->name=$req->input('name');
    		$questioner->description=$req->input('description');
    		$questioner->save();
    		return back();

    	}//end is admin

    }//end edit questioner

    public function delete_questioner($id) {

    	if (Auth::user()->isAdmin()) {

    		$questioner = 
    		Questioner::where('id',$id)->first();
    		$questioner->delete();
    		return back();

    	}//end is admin

    }//end edit questioner


}
