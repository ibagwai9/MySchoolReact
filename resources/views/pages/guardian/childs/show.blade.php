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
    
    <!-- INLINE FORM ELELEMNTS -->
    <div class="row " style="color: #000000">
        <div class="col-lg-10 col-lg-offset-1 bg-warning text-black">
            <h3><i class="fa fa-angle-right"></i>{{$student->name}}'s Details</h3>
            @if ( $msg =='updated')
                <div class="alert alert-success">
                    Student's Detail successfully updated.
                </div>
            @elseif ( $msg =='created')
                <div class="alert alert-success">
                    Student successfully created.
                </div>
            @endif
            @if ($student)
                <div class="col-lg-10 col-lg-offset-1  col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 mb">
                    <!-- WHITE PANEL - TOP USER -->
                    <div class="white-panel pn" style="height: 25em">
                        <div class="white-header">
                            <h5>Reg. N<u>o</u>{{$student->student_reg}}</h5>
                        </div>
                        <p><img src="{{asset('/student_photo/'.$student->profile_pix)}}" class="img-circle" style="width: 80px; height: 80px"></p>
                        <p><b>{{$student->name}}</b></p>
                        <div class="row">
                            <div class="col-md-3">
                                <p class="small mt">GENDER</p>
                                <p>{{$student->gender}}</p>
                            </div>
                            <div class="col-md-3">
                                <p class="small mt">SCHOOL</p>
                                <p>{{$student->school->name}}</p>
                            </div>
                            <div class="col-md-3">
                                <p class="small mt">CLASS</p>
                                <p>{{$student->studentClass->name}}</p>
                            </div>
                            <div class="col-md-3">
                                <p class="small mt">DATE OF BIRTH</p>
                                <p>{{$student->dob}}</p>
                            </div>
                            <div class="col-md-3">
                                <p class="small mt">GUARDIAN CONTACT</p>
                                @if($student->guardian)
                                    <p>{{$student->guardian->phone}}</p>
                                @else
                                    <p>N/A</p>
                                @endif
                            </div>
                             <div class="col-md-3">
                                <a class="btn btn-danger" href="/guardian/payment/{{$student->id}}">Pay School Fees</a>
                            </div>
                            
                        </div>
                    </div>
                </div><!-- /col-md-4 -->
            @endif
        </div><!-- /col-lg-12 -->
    </div><!-- /row -->
@endsection