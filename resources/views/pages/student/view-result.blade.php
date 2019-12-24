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

        .container .row .col-sm-10 {
            margin-bottom: 0;;
        }

        .container .row .col-sm-10.links div a {
            border: 0;
        }

        .container .row .col-sm-10 div.detail p {
            color: darkgrey;
            text-align: center;
            font-weight: bold;
        }

    </style>
@endsection

@section('profile-link')
    <li><a href="{{ url('/student/profile') }}">Home</a></li>
@endsection

@section('logout-link')
    <li><a style="color: #ffffff;" href="/student/logout">Logout</a></li>
@endsection

@section('content')
    <div class="container well well-lg">
        <div class="row">
            <div class="col-sm-12">
                <div class="col-sm-12 text-black">
                    <div class="panel-heading"><p style="color: black">MyResults &raquo; </p></div>
                    <div class="panel panel-body">
                        @if (isset(Auth::user()->userable->results))
                        @php
                            $results = Auth::user()->userable->results;
                        @endphp
                            @if ($results->count() > 0)
                                <div class="content-panel">
                                    <table style="color: black" class="table table-striped table-advance table-hover">
                                        <thead>
                                        <tr>
                                            <th>Subject</th>
                                            <th> Grade</th>
                                            <th>Term </th>
                                            <th>Session </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($results as $result)
                                                <tr>
                                                    <td>{{$result->subject->name}}</td>
                                                    <td>{{\App\Result::processResult($result->score)}}</td>
                                                    <td>{{$result->term->name}}</td>
                                                    <td>{{$result->session->name}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p>There are no results available. for the moment.. <a class="btn btn-success" href="/student/profile">Go To Profile</a></p>

                            @endif
                        @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
