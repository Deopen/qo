<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;
use App\User;
use App\Project;
use Storage;
use DateTime;
use Log;

class UserController extends Controller
{
    //

	public function isFieldExistWithValue($fieldName,$fieldValue) {

		$res=User::where($fieldName,$fieldValue)->count();
        if ($res){
            //echo $username."->true<br>";
            return true;
        }else{
            //echo $username."->false<br>";
            return false;
        }

	}//end is field exist or empty

	public function isAdminExist() {

		return $this->isFieldExistWithValue('access_level','admin');

	}//end is admin exisrt


    public function isUsernameExistOrEmpty($username) {

        if (!isset($username))
            return true;

        return $this->isFieldExistWithValue('username',$username);
        

    }//end is username exist


    public function insertAdmin() {

    	if (!$this->isAdminExist()){
    		$admin=new User();
    		$admin->username="deopen";
    		$admin->access_level='admin';
    		$admin->password=bcrypt('omid123');
    		$admin->save();
    		return back();
    	}// end if admin not exist

	}//end insert admin


    public function edit_user(Request $req,$id){
        //var_dump($req->input("name"));
        if (Auth::user()->isAdmin()){

            $user=User::find(trim($id));
            $user->name=trim($req->input("name"));
            $user->family=trim($req->input("family"));
            $user->username=trim($req->input("username"));
            $user->gender=trim($req->input("gender"));
            $user->age=trim($req->input("age"));
            $user->email=trim($req->input("email"));
            $user->access_level=trim($req->input("access_level"));
            
            Log::info('User with id '.$id
                .' has been edited by admin '.
                Auth::user()->username);
            
            $user->save();
            return back();
        }//end if isAdmin
        return back();
    }//end edit user


    public function usernameGenerator($name,$family) {
        return substr($name,0,1)."_".$family."_".rand(1,1000);
    }//end username generator


    public function delete_user($id){
        
        if (Auth::user()->isAdmin()){
            $user=User::find($id);
            $user->delete();
            Log::info('User with id '.$id.
                ' has been deleted by admin '.Auth::user()->username);
            return back();

        }//end if isAdmin
    }//end delete user


    public function bulkRegisteration(){

        if (Auth::user()->isAdmin()) {
            
            $bulkInput_lineByLine=
                explode('endinput',Storage::get("members.bulk.input.txt")) ;
            Log::info
            ('Bulk registeration has been start by admin '.
              Auth::user()->username);

            //var_dump($bulkInput_lineByLine[12]);

            foreach ($bulkInput_lineByLine as $line) {
                if (strlen(trim($line))<=1) {continue;}//skip line
                $newUser = new User();
                
                //echo "<br>";
                $fields=explode(' ',$line);
                foreach ($fields as $field) {
                    if (strlen(trim($field))<=1) {continue;}//skip field
                    $sepratedKeyValue=explode(":",$field);
                    try{
                        $fieldName=trim(strtolower($sepratedKeyValue[0]));
                        $fieldValue=trim($sepratedKeyValue[1]);
                        //echo $fieldName."===>".$fieldValue."<br>";
                        $newUser->$fieldName=$fieldValue;
                    }catch(\Exception $e){
                        $err_msg="<font color='red'> ERROR IN READING BULK:<br>Err==>Field:".
                        $field."<br> line: ".$line." Len:".strlen($field)."</font><br>".
                        $e->getMessage()."<br>";
                        echo $err_msg;
                        Log::error("HTML ERROR MESSAGE: ".$err_msg);
                    }//end try catch
                    
                    //echo $field."<br>";
                }//end foreach field

                
                
                while($this->isUsernameExistOrEmpty($newUser->username)){
                    $newUser->username=$this->usernameGenerator($newUser->name,$newUser->family);
                }//end while if username exist
            
                
                $newUser->password=bcrypt('omid123');
                try{
                	$newUser->access_level="subject";//security
                    $newUser->save();
                    Log::info
                    ('User '.$newUser->username.' added in Bulk Mode by admin '.
                        Auth::user()->username);

                }catch(\Exception $e){
                    $err_msg="<font color='red'> ERROR >>>STORING<<< BULK:<br>Err==>Field:".
                        $field."<br> line: ".$line." Len:".strlen($field)."</font><br>".
                        $e->getMessage()."<br>";
                    echo $err_msg;
                    Log::error("HTML ERROR MESSAGE: ".$err_msg);
                }//end try catch
                

                //echo $line."<br>";
            }//end foreach bulk
            //rename:
            $now = new DateTime();
            $now = $now->format('Y_m_d_H_i_s');
            Storage::move("members.bulk.input.txt","members.bulk.input.imported_".$now.".txt");
            return back();
        }//end if isAdmin
    }//end bulk registeration method


}
