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
                <div class="panel-heading text-center" style="color: black">
                    <p>School: {{$teacher->school->name}}</p>
                    <p>Academic session: {{$academic_session->name}}</P>
                        <?php $position = strpos($teacher->school->name, "School"); ?>
                    <p>{{substr_replace( $teacher->school->name,'', $position)}}  {{explode(' ',$teacher->class->name)[1]}} end of {{$teacher->getTerm($term)}} term examination result</p>
                    <hr />
                </div>
                <div class="panel panel-body">
                    

                        <form class="form-horizontal" role="form" method="POST" action="{{ url('teacher/view-result-rdr')}}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <input type="hidden" name="teacher_id" value="{{$teacher->id}}">
                            <input type="hidden" name="class_id" value="{{$teacher->class->id}}">
                            <input type="hidden" name="school_id" value="{{$teacher->school->id}}">
                           
                           <div class="form-group">
                                <label class="col-md-4 control-label">Select group</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="group" >
                                        @foreach ($groups as $gr)
                                            <option>{{$gr->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Select Term</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="term" >
                                        @foreach ($terms as $term)
                                            <option value="{{$term->id}}">{{$term->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">View</button>
                                </div>
                            </div>
                        </form>
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
@endsection

