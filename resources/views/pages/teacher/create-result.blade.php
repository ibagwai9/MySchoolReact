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
                        <div><p>Current Session: {{@$session->name}}</P>
                            <p>School {{@$teacher->school->name}}</p>
                            <p> {{$class->name}} end of {{$teacher->getTerm($term)}} term {{@$teacher->class->name}} Result maker</p>
                        </div>

                            <form class="form-horizontal" role="form" method="POST" action="{{ url('teacher/save-results')}}">
                                
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="teacher_id" value="{{@$teacher->id}}">
                                <input type="hidden" name="class_id" value="{{@$teacher->class_id}}">
                                <input type="hidden" name="school_id" value="{{$teacher->school_id}}">
                                <input type="hidden" name="session" value="{{$session->id}}">
                                <input type="hidden" name="term" value="{{$term}}">
                                
                                @php 
                                    $this_sbj = null;
                                @endphp
                            <div style="color: black;" class="panel-body">
                                
                                @if(isset($students) && $students->count() > 0)
                                        <div class="content-panel">
                                            @if($subject && $subject=='All')
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Select Subject</label>
                                                <div class="col-md-6">
                                                    <select class="form-control" name="subject" >
                                                        @foreach ($subjects as $subject)
                                                            <option value="{{$subject->id}}">{{$subject->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @else
                                                @php 
                                                    $this_sbj = $subject;
                                                @endphp
                                                    <input type="hidden" name="subject" value="{{$subject}}">
                                                @endif
                                            <table style="color: black" class="table table-striped table-advance table-hover">
                                                <thead>
                                                <tr>
                                                    <th style="width:300px">Student</th>
                                                    <th>Reg. No</th>
                                                    <th>CA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                                    <th>Exam </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($students as $student)
                                                    <?php $i=1?>
                                                    <tr>
                                                        <td>{{$student->name}}</td>
                                                        <td>{{$student->student_reg}}
                                                            <input type="hidden" name="students[]" value="{{$student->id}}">
                                                        </td>
                                    @if($this_sbj)
                                    @php 
                                        $result =$student->getSessionResult($subject, $session->id, $term);
                                    @endphp
                                        <td>
                                        <input type="text" class="form-control" name="cas[]" value="{{@$result? $result->ca:''}}">
                                    </td>
                                    @else
                                    <td>
                                        <select class="form-control" name="cas[]">
                                            @for($b=0; $b<=70; $b++)
                                                <option value="{{$b}}">{{$b}}</option>
                                            @endfor
                                        </select>
                                    </td>
                                    @endif
                                    @if($this_sbj)
                                    <td>
                                        <input type="text" class="form-control" name="scores[]" value="{{$student->getSessionResult($subject, $session->id, $term)->score}}">
                                    </td>
                                    @else
                                    <td>
                                        <select class="form-control" name="scores[]">
                                            @for($b=0; $b<=70; $b++)
                                                <option value="{{$b}}">{{$b}}</option>
                                            @endfor
                                        </select>
                                    </td>
                                    @endif
                                </tr>
                                <?php $i++?>

                            @endforeach
                                                    
                                        </tbody>
                                    </table>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                                        </div>
                                    @else
                                        <div>No Available Students  in this class.</div>
                                    @endif
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

