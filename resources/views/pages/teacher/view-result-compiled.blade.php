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
                <div class="detail">
                    <div class="panel-heading">
                        <p>Class: {{$teacher->class->name}} {{$teacher->school->name}}</p> </p>
                    </div>
                    <div class="panel panel-body">
                      <div style="color: black;" class="panel-body">
                                @if(isset($results) && $results->count() > 0)
                                        <div class="content-panel">
                                            <table style="color: black" class="table table-striped table-advance table-hover">
                                                <thead>
                                                <tr>
                                                    <th style="width:300px">Student</th>
                                                    <th>Reg. No</th>
                                                    <th>CA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                                    <th>Exam </th>
                                                    <th>Total </th>
                                                    <th>Grade</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach($results as $result)
                                                    <?php $i=1; $student = $result->student ?>
                                                    <tr>
                                                        <td>{{@$student->name}}</td>
                                                        <td>{{@$student->student_reg}}</td>
                                                        <td>{{@$student->getResult($subject->id, $term->id)->ca}}</td>
                                                        <td>{{@$student->getResult($subject->id, $term->id)->score}}</td>
                                                        <td><?php $total = (int)@$student->getResult($subject->id, $term->id)->score + (int)@$student->getResult($subject->id, $term->id)->ca ?>
                                                            {{$total}}
                                                        </td>
                                                        <td>{{$student->getGrade($total)}}</td>
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
                                        <div>No Results Available.</div>
                                    @endif
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

