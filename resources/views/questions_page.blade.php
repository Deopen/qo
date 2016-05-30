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
                      <li><a href="/show_questioners">All Questioners</a></li> 
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
                <div class="persian_question">
                    @foreach($questions as $question)
                    
                    {{$question->content}}<br><br>
                    <input type="radio"><span class="persian_option">&nbsp&nbsp{{$question->options}}</p><br>
                    
                    @endforeach
                </div>

                <div class="form-group">
                    
                     <form class="form-horizontal" role="form" method="POST" action="{{ url('/add_question') }}/toQuestioner_{{$questioner_id}}">
                        {!! csrf_field() !!}
                        
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-btn fa-plus"></i>Add Question
                        </button>
                        

                </div>
                        

                </div>
            </div>
        </div>
    </div>
</div>


@endsection
