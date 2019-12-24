@extends('pages.layout')

@section('page-embed-styles')
    <style>
        .container.well.well-lg {
            padding-top: 1%;
        }

        .container .row .col-sm-8 div.profile-pix h2 {
            color: #000000;
            text-align: center;
            font-weight: bold;
            margin-top: 1em;
        }

        .container .row .col-sm-10 div.detail p {
            color: darkgrey;
            text-align: center;
            font-weight: bold;
        }

        .container .row .col-sm-10 div.detail .panel-body label{
            color: darkgrey;
        }


    </style>
@endsection

@section('profile-link')
    <li><a href="{{ url('/teacher/profile') }}">Home</a></li>
@endsection

@section('logout-link')
    <li><a style="color: #ffffff;" href="/teacher/logout">Logout</a></li>
@endsection

@section('content')
    <div class="container well well-lg">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <div class="col-sm-10 col-sm-offset-1 detail">
                    <div class="panel-heading">
                        <p>Upload Result Details. PLease do this carefully as results uploaded are not editable. </p>
                    </div>
                    <div class="panel panel-body">
                        <table class="table table-hover text-justify " style="color:#000000">
                            <form class="form-horizontal" role="form" method="POST" action="{{ url('teacher/view-result')}}">
                            <tbody>
                                <tr>
                                    <td>School: </td> <td> {{$teacher->school->name}}</td>
                                </tr>
                                <tr>
                                    <td>Current Session:</td> <td>{{$academic_session->name}}</td>
                                </tr>
                                <tr>
                                    <td>Select Class:</td> <td>
                                        <select class="form-control text-center" name="class_id" >
                                            @foreach ($classes as $class)
                                                <option class="text-center" 
                                                @if($teacher->class->id == $class->id)
                                                    selected="selected"
                                                @endif

                                                value="{{$class->id}}">{{$class->name}} 
                                                @if($teacher->class->id == $class->id)
                                                    - (My class) 
                                                @endif
                                            </option>
                                            @endforeach
                                        </select>
                                        </td>
                                </tr>
                                </tbody>
                                <tbody>
                                    
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                    <input type="hidden" name="teacher_id" value="{{$teacher->id}}">
                                    <input type="hidden" name="class_id" value="{{$teacher->class->id}}">
                                    <input type="hidden" name="school_id" value="{{$teacher->school->id}}">

                                <tr>
                                    <td>Class Grouping</td> 
                                    <td>
                                        <select class="form-control text-center" name="group_d" >
                                            @foreach ($group as $class)
                                                <option class="text-center"  value="{{$class->id}}">{{$class->name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Select Term</td> 
                                    <td><select class="form-control text-center" name="term" >
                                            @foreach ($terms as $term)
                                                <option value="{{$term->id}}">{{$term->name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    </tr>
                                        
                                    <tr>
                                        <td></td> 
                                        <td>
                                            <button type="submit" class="btn btn-primary">Create</button>
                                        </td>
                                    </tr>
                                </form>
                            </tbody>
                        </table>

                            <div style="color: black;" class="panel-body">
                                @if (isset($results))
                                    @if ($results->count() > 0)
                                        <div class="content-panel">
                                            <table style="color: black" class="table table-striped table-advance table-hover">
                                                <thead>
                                                <tr>
                                                    <th>Student</th>
                                                    <th> Score</th>
                                                    <th>Grade </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($results as $result)
                                                    <tr>
                                                        <td>{{$result->resultStudent->name}}</td>
                                                        <td>{{$result->score}}</td>
                                                        <td>{{\App\Result::processResult($result->score)}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <div>No Results Available.</div>
                                    @endif
                                @endif
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

