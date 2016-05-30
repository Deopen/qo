<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Project;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */



    public function isAdmin() {
        return ($this->access_level=="admin");
    }//end is admin

    public function isProjectOwner() {
        return ($this->isAdmin() or $this->access_level=="project_owner");
    }//end is admin

    public function getAllUsers() {

        if ($this->isAdmin())
            return User::all(); 

    }//end show users if admin

    public function getMyProjects() {

        return Project::where('owner_id',$this->id)->get();

    }//end get my projects

    protected $fillable = [
        'name','family','username','gender','age', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
