@extends('layouts.app')

@section('content')

<link rel="stylesheet" type="text/css" href="{{ asset('css/home.css') }}">
<div class="container">
        <div class="row">
        <div class="col-md-10 col-md-offset-1">

            <div class="panel panel-default">

                <div class="panel-heading" style="
                text-align:center;
                background-color:hsla(170,40%,70%,0.7);
                ">
                <strong>
                {{$access_level}} panel
                </strong>
                </div>  
                
                <div class="panel-body" style="
                background-color:hsla(130,60%,10%,0.25);

                ">

                <!---
                <aside>
                    <ul class="nav nav-pills nav-stacked">
                    <li><a href="add_user/bulk_user_registeration">Bulk Registeration</a></li>
                    <li><a href="register">New User</a></li>
                    <li><a href="create_project">New Project</a></li>
                    <li><a href="my_projects">My Projects</a></li>
                    <li><a href="create_questioner">New Questioner</a></li>
                    <li><a href="create_questioner">Questioners</a></li>
                    <li><a href="show_all_projects">All Projects</a></li>
                    <li><a href="show_users">Users</a></li>
                    </ul>
                </aside>
                -->
                <aside>
                <ul class="nav nav-pills nav-justified">
                     
                    <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" 
                    href="#">Project
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <li><a href="create_project">New Project</a></li>
                      <li><a href="show_all_projects">All Projects</a></li>
                      <li><a href="my_projects">My Projects</a></li> 
                    </ul>
                    </li>

                    <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" 
                    href="#">Questioner
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <li><a href="create_questioner">New Questioner</a></li>
                      <li><a href="show_questioners">All Questioners</a></li> 
                    </ul>
                    </li>

                    <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" 
                    href="#">User
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <li><a href="register">New User</a></li>
                      <li><a href="add_user/bulk_user_registeration">Bulk User Registeration</a></li>
                      <li><a href="show_users">All Users</a></li>
                    </ul>
                    </li>

                </ul>
                </aside>

                <div class="user_tbl" id="user_tbl">
                

                    @if(isset($users))
                        <table class="users">

                        <tr>
                        <th>id</th>
                        <th>username</th>
                        <th>name</th>
                        <th>family</th>
                        <th>gender</th>
                        <th>age</th>
                        <th>email</th>
                        <th>access_level</th>
                        <th>edit</th>
                        <th>delete</th>
                        </tr>    
                        @foreach($users as $user)
                        <form method='POST' id="form_{{ $user->id }}" action='edit_user/{{$user->id}}'>
                        {!! csrf_field() !!}

                        <tr id="usr_row_{{$user->id}}"> 

                        <td id="id.field.{{$user->id}}">{{$user->id}}</td>
                        <td id="username.field.{{$user->id}}">{{$user->username}}</td>
                        <td id="name.field.{{$user->id}}">{{$user->name}}</td>
                        <td id="family.field.{{$user->id}}">{{$user->family}}</td>
                        <td id="gender.field.{{$user->id}}">{{$user->gender}}</td>
                        <td id="age.field.{{$user->id}}">{{$user->age}}</td>
                        <td id="email.field.{{$user->id}}">{{$user->email}}</td>
                        
                        <td id="access_level.field.{{$user->id}}" style="
                        @if($user->access_level=="admin")
                        color: rgba(255,0,0,0.65);
                        font-weight: bold;
                        @endif
                        ">
                        {{$user->access_level}}
                        </td>

                        
                        <td id="edit_td_{{$user->id}}"><input id="edit_btn_{{$user->id}}" type="button" value="edit" onclick="edit_user({{$user->id}})"></td>

                        <td><input type="button" value="delete" onclick="location.href='delete_user/{{$user->id}}'"></td>
                        
                        
                        </tr>
                        </form>
                        @endforeach
                        </table>

                    @endif

                    @if(isset($projects))
                        <table class="users">

                        <tr>
                        <th>id</th>
                        <th>project name</th>
                        <th>owner</th>
                        <th>questioner count</th>
                        <th>add questioner</th>
                        <th>edit</th>
                        <th>delete</th>
                        </tr>    
                        @foreach($projects as $project)
                        <form method='POST' id="form_{{ $project->id }}" action='edit_project/{{$project->id}}'>
                        {!! csrf_field() !!}

                        <tr id="prj_row_{{$project->id}}"> 
                        <td id="id.field.{{$project->id}}">{{$project->id}}</td>
                        <td id="name.field.{{$project->id}}">{{$project->name}}</td>
                        <td id="owner.field.{{$project->id}}">{{$project->getOwnerUsername()}}</td>
                        <td id="questioner_count.field.{{$project->id}}">{{$project->questioner_count}}</td>
                        
                        <td><input id="add_btn_{{$project->id}}" type="button" value="add" onclick="location.href='add_questioner/{{$project->id}}'"></td>


                        <td id="edit_td_{{$project->id}}"><input id="edit_btn_{{$project->id}}" type="button" value="edit" onclick="edit_project({{$project->id}})"></td>

                        <td><input type="button" value="delete" onclick="location.href='delete_project/{{$project->id}}'"></td>
                        
                        
                        </tr>
                        </form>
                        @endforeach
                        </table>

                    @endif

                    @if(isset($questioners))
                        <table class="users">

                        <tr>
                        <th>id</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Questions count</th>
                        <th>Show Questions</th>
                        <th>Edit</th>
                        <th>Delete</th>
                        </tr>    
                        @foreach($questioners as $questioner)
                        <form method='POST' id="form_{{ $questioner->id }}" action='edit_questioner/{{$questioner->id}}'>
                        {!! csrf_field() !!}

                        <tr id="qstner_row_{{$questioner->id}}"> 
                        <td id="id.field.{{$questioner->id}}">{{$questioner->id}}</td>
                        <td id="name.field.{{$questioner->id}}">{{$questioner->name}}</td>

                        <td id="description.field.{{$questioner->id}}">{{$questioner->description}}</td>
                        
                        <td id="questions_count.field.{{$questioner->id}}">{{$questioner->questions_count}}</td>
                        
                        <td><input id="add_btn_{{$questioner->id}}" type="button" value="show questions" onclick="location.href='questions_page/{{$questioner->id}}'"></td>


                        <td id="edit_td_{{$questioner->id}}"><input id="edit_btn_{{$questioner->id}}" type="button" value="edit" onclick="edit_questioner({{$questioner->id}})"></td>

                        <td><input type="button" value="delete" onclick="location.href='delete_questioner/{{$questioner->id}}'"></td>
                        
                        
                        </tr>
                        </form>
                        @endforeach
                        </table>

                    @endif

                </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    var editing=new Array();

    function getEl(id){
        return document.getElementById(id)
    }//end get el
    
    function doEditableThisCell(cellId){


        var el = getEl(cellId)
        var oldName=(el.innerHTML).trim()
        if (oldName=="")
            oldName=""
        //alert(oldName)
        var fieldName=cellId.split(".")[0]
        var id=cellId.split(".")[cellId.split(".").length-1]
        //alert(fieldName)
        var inputType=fieldName==="email"?'email':'text'
        el.innerHTML="<input type='"+inputType+"' name='"+fieldName+"' style='text-align: center'  value='"+oldName+"' size='"+oldName.length+"' form='form_"+id+"'>"
        //alert(el.innerHTML)
        

    }//end doing editable

    function addFormToRow(id) {

        var el=getEl("edit_td_"+id)
        var editBtn=getEl("edit_btn_"+id)
        
        editBtn.addEventListener("click",function () {getEl("form_"+id).submit()})
        window.addEventListener("keydown",
            function (event) { 
                if(event.keyCode==13) 
                    getEl("form_"+id).submit()}
                )
        
    }//end adding form to row

    function edit_user(id){
        //alert("edit function runed")   
        if (editing.indexOf(id)==-1) {
            editing.push(id)
            doEditableThisCell("name.field."+id)
            doEditableThisCell("family.field."+id)
            doEditableThisCell("age.field."+id)
            doEditableThisCell("gender.field."+id)
            doEditableThisCell("username.field."+id)
            doEditableThisCell("email.field."+id)
            doEditableThisCell("access_level.field."+id)
            addFormToRow(id)
        }else{
            editing.pop(id)
        }//end if else being in editing mode

    }//end edit user



    function edit_project(id){
        //alert("edit function runed")   
        if (editing.indexOf(id)==-1) {
            editing.push(id)
            doEditableThisCell("name.field."+id);
            addFormToRow(id)
        }else{
            editing.pop(id)
        }//end if else being in editing mode

    }//end edit user

    function edit_questioner(id){
        //alert("edit function runed")   
        if (editing.indexOf(id)==-1) {
            editing.push(id)
            doEditableThisCell("name.field."+id);
            doEditableThisCell("description.field."+id);
            addFormToRow(id)
        }else{
            editing.pop(id)
        }//end if else being in editing mode

    }//end edit user


</script>

@endsection
