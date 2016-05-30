<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;
use App\Project;
use Log;


class ProjectController extends Controller
{
    public function index() {

    	return view('create_project');

    }//end index

    public function edit_project(Request $req,$id) {

    	$curr=Auth::user();
    	$proj=Project::where('id',$id)->first();

    	if ($curr->isAdmin() or $curr->id==$proj->owner_id){
    		$proj->name=trim($req->input('name'));
    		$proj->save();
    		Log::info
    			($curr->username.' edit project with id '.$id);
    		return back();
    	}//end if

    }//end edit project


    public function delete_project(Request $req,$id) {

    	$curr=Auth::user();
    	$proj=Project::where('id',$id)->first();

    	if ($curr->isAdmin() or $curr->id==$proj->owner_id){
    		$proj->delete();
    		Log::info
    			($curr->username.' delete project with id '.$id);
    		return back();
    	}//end if

    }//end edit project

    public function create_project(Request $req) {

	    if ($req->user()->isProjectOwner()){
	    	$proj=new Project();
	    	$proj->name=$req->input('name');
	    	$proj->owner_id=$req->user()->id;
	    	$proj->save();

	    	Log::info("Project ".$proj->name." created by ".$req->user()->username);

    	}//if project owner

    	return redirect('home');	

    }//end create project
}
