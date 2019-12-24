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

        .container .row .col-sm-8 div.profile-pix {
            padding: 1em;
        }

        .container .row .col-sm-10 {
            margin-bottom: 0;
        }

        .container .row .col-sm-10.links {
            margin-top: 0;
            background-color: inherit;
            border: 0;
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
    <li><a href="{{ url('/guardian/profile') }}">Home</a></li>
@endsection

@section('logout-link')
    <li><a style="color: #ffffff;" href="/guardian/logout">Logout</a></li>
@endsection

@section('content')
    <div class="container well well-lg">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="col-sm-4 col-sm-offset-4 profile-pix">
                    <img src="{{asset('/guardian_photo/'.$guardian->profile_pix)}}" class="img-circle">
                    <h2>{{$guardian->name}} </h2>
                </div>
            </div>
            
            <div class="col-sm-10 col-sm-offset-1">
                <div class="col-sm-8 col-sm-offset-2 detail">
                    <div class="panel-heading">
                        <p>Other Details </p>
                    </div>
                    <div class="panel panel-body">
                        <table class="table-bordered table-responsive">
                            <thead>
                                <tr> 
                                    <th>ID</th> 
                                    <th>Gender</th> 
                                    <th>Phone</th> 
                                    <th>Address</th> 
                                    <th>Reg.Children</th>
                                    <th>Apply</th> 
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="color: #000">
                                    <td>{{$guardian->id}}</td>
                                    <td>{{$guardian->gender}}</td>
                                    <td>{{$guardian->phone}}</td>
                                    <td>{{$guardian->address}}</td>
                                    <td>
                                        <ol style="margin:0; padding:0; padding-left: 5px" >
                                            <?php $i = 0 ?>
                                        @foreach($guardian->students as $student)
                                            <li class="nav-link" style="border: 1px gray solid;
                                            margin: 10px">
                                                <a
                                                href="/guardian/childs/{{ $student->id}}">
                                                {{ $student->student_reg}}
                                                <a href="/guardian/view-result/{{$student->id}}" class="btn-link">Result</a>
                                            </li>                                        
                                        @endforeach
                                        </ol>
                                    </td>
                                    <td>
                                        <a class="btn btn-secondary btn-xs" href="/guardian/childs/create">+ Admision</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        
                    </div>

                </div>
            </div>

            <div class="col-sm-10 col-sm-offset-1 links">
                <div style=" margin: 2%; text-align: center;">
                    <a href="/guardian/edit-profile/{{$guardian->id}}" class="btn btn-primary">Edit Profile</a>
                </div>
            </div>
        </div>
    </div>
@endsection
