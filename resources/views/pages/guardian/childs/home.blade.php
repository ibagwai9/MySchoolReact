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
    <h3><i class="fa fa-angle-right"></i> Manage Students</h3>

    <!-- INLINE FORM ELELEMNTS -->
    <div class="row mt">
        <div class="col-lg-10 col-lg-offset-1 bg-warning">
            <div class="form-panel">
                <div style="margin-top: 2%; text-align: center;">
                    <a class="btn btn-success" href="{{ url('guardian/childs/create') }}">Apply for Child Admission</a>
                </div>
                <div style="margin-top: 5%">
                    <h4 class="mb"><i class="fa fa-angle-right"></i> Manage Existing Students</h4>
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/students/filtered') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <label class="col-md-4 control-label">My Childreen</label>
                            <div class="col-md-6">
                                <select name ='class_id' class = "form-control text-center">
                                    @foreach($students as $student)
                                        <option value="{{$student->id}}">{{$student->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">Manage</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- /form-panel -->
        </div><!-- /col-lg-12 -->
    </div><!-- /row -->

@endsection