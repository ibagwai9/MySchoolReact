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
                <div class="col-sm-8 col-sm-offset-2 detail">
                    <div class="panel-heading">
                        <p>Upload Result Details. PLease do this carefully as results uploaded are not editable. </p>
                    </div>
                    <div class="panel panel-body">
                        <table class="table table-hover text-justify " style="color:#000000">
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    {{$errors->first()}}
                                </div>
                            @endif
                            <tbody>
                                <tr>
                                    <td>Current Session:</td> <td>{{$academic_session->name}}</td>
                                </tr>
                                <tr>
                                    <td>Class Name:</td> <td>{{$teacher->class->name}}</td>
                                </tr>
                                <tr>
                                    <td>School: </td> <td> {{$teacher->school->name}}</td>
                                </tr>
                                </tbody>
                                <tbody>
                                    <form class="form-horizontal" role="form" method="POST" action="{{ url('teacher/new-record')}}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                    <input type="hidden" name="teacher_id" value="{{$teacher->id}}">
                                    <input type="hidden" name="class_id" value="{{$teacher->class->id}}">
                                    <input type="hidden" name="school_id" value="{{$teacher->school->id}}">
                                <tr>
                                    <td>Choose academic session</td> 
                                    <td>
                                        <select class="form-control text-center" name="session_id" >
                                            
                                            @foreach ($sessions as $session)
                                                @if($session->status == 1)
                                                    <option selected="selected" value="{{$session->id}}" class="text-center" ><-----------Current session-----------></option>
                                                @else
                                                    <option value="{{$session->id}}">{{$session->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Class Grouping</td> 
                                    <td>
                                        <select class="form-control text-center" name="group" >
                                            <option value="All" selected="" class="text-center" ><-----------No Grouping-----------></option>
                                            @foreach ($groups as $group)
                                                <option>{{$group->name}}</option>
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
                                        <td>
                                            Select Subject
                                        </td>
                                        <td>
                                            <select class="form-control" name="subject">
                                                <option value="All" selected=""><------------All subjects------------></option>
                                                @foreach ($subjects as $subject)
                                                    <option value="{{$subject->id}}">{{$subject->name}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td> 
                                        <td>
                                            <button type="submit" name="view" value="true" class="btn btn-primary">View</button>
                                            <button type="submit" name="new" value="true" class="btn btn-default">New result</button>
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

