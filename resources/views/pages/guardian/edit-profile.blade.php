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
        .picture{
            text-align: center;
            margin: auto;
            display: block;
            border: 1px solid gray;
            width: 100px;
            height: 100px;
            margin-bottom: 20px
        }
        .clear{ clear: both; }

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
            <div class="col-sm-10 col-sm-offset-1">
                <div class="col-sm-8 col-sm-offset-2 detail">
                    <div class="panel-heading">
                        <p>{{$guardian->name}}</p>
                        <p>Edit Profile </p>
                    </div>
                    <div class="panel panel-body">
                        <div class="picture">
                            <img src="public/guardian_photo/{{$guardian->profile_pix}}">
                        </div>
                        <div class="clear"></div>
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                {{$errors->first()}}
                            </div>
                        @endif

                        <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data"
                              action="{{ url('guardian/edit-profile')}}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <input type="hidden" name="guardian_id" value="{{$guardian->id}}">


                            <div class="form-group">
                                <label class="col-md-4 control-label">Phone</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="phone" value="{{ $guardian->phone }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Address</label>
                                <div class="col-md-6">
                                    <textarea  rows="3" class="form-control" name="address"> {{ @$guardian->address }}</textarea>
                                    <input type="hidden" name="guardian_id" value="{{$guardian->id}}" />
                                </div>
                            </div>
                        
                            <div class="form-group">
                                <label class="col-md-4 control-label">Upload Pic. </label>
                                <div class="col-md-6">
                                    <input type="file" class="form-control" name="profile_pix">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    {{--<a class="btn btn-link" href="{{ url('/password/email') }}">Forgot Your Password?</a>--}}
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    
@endsection
