
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
    <h3><i class="fa fa-angle-right"></i> Create A New Student</h3>

    <!-- INLINE FORM ELELEMNTS -->
    <div class="row mt">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Apply for your child admission</h3>
                <p>Fill in Child's Detail below:</p> </div>
                <div class="panel-body" style="color: #000">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            {{$errors->first()}}
                        </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data"
                          action="{{ url('/guardian/childs') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="parent_id" value="{{ Auth::user()->userable_id }}">

                        <div class="form-group">
                            <label class="col-md-4 control-label">Name</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="Child Name" name="name" value="{{ old('name') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Gender</label>
                            <div class="col-md-6">
                                <select name="gender" required="" class="form-control">
                                    <option value="">Choose child gender</option>
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Select Class</label>
                            <div class="col-md-6">
                                <select name ='class_id' class = "form-control">
                                    <option value="">Choose class</option>
                                    @foreach($classes as $class)
                                        <option value="{{$class->id}}">{{$class->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Date of Birth</label>
                            <div class="col-md-6">
                                <input type="date" class="form-control" placeholder="Y-M-D" name="dob" value="{{ old('dob') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Student Pix.</label>
                            <div class="col-md-6">
                                <input type="file" class="form-control" name="image-file" placeholder="Upload Image"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Student password</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="password" placeholder="Password"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">Apply</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- /col-lg-12 -->
    </div><!-- /row -->
@endsection