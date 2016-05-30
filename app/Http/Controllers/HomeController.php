<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Project;
use App\Questioner;
use App\Question;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {

        //{"id":2,"name":"omid","username":"deopen","email":"","access_level":"subject","created_at":"2016-05-11 12:13:41","updated_at":"2016-05-17 19:02:41"} 
        
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$this->bulkRegisteration();
        return $this->myProjects();
    }//end index


    public function showUsers() {
        if (Auth::user()->isAdmin()){
            return view('home',[
                "access_level"=>Auth::user()->access_level,
                "users"=>Auth::user()->getAllUsers()
                    ]);
        }else{
            return back();
        }//end if is admin
    }//end show users

    public function myProjects() {
        if (Auth::user()->isProjectOwner()){
            return view('home',[
                "access_level"=>Auth::user()->access_level,
                "projects"=>Auth::user()->getMyProjects()
                    ]);
        }else{
            return back();
        }//end if is project owner

    }//end show users

    public function showAllProjects() {
        if (Auth::user()->isAdmin()){
            return view('home',[
                "access_level"=>Auth::user()->access_level,
                "projects"=>Project::all()
                    ]);
        }else{
            return back();
        }//end if is project owner

    }//end show users


    public function showQuestioners(){

        return view('home',[
            "access_level"=>Auth::user()->access_level,
            "questioners"=>Questioner::all()
                ]);
        
    }//end show questioners

    public function showQuestions($questioner_id){
        $questioner=Questioner::where('id',$questioner_id)->first();
        $questions=
        Question::where('questioner_id',$questioner_id)->get();
        
        return view('questions_page',
            ['access_level'=>Auth::user()->access_level,
            'questions'=>$questions,
            'questioner_id'=>$questioner_id]);

    }//end show questions

}
