<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;

class Project extends Model
{
    public function getOwnerUsername() {

    	return User::where('id',$this->owner_id)->first()->username;
    }//end getProjectOwnerName
}
