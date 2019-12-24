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
                <div class="col-sm-12">
                    <div class="panel-heading"><p>Pay School Fees </p></div>
                    <div class="panel panel-body">
                       <div class="col-md-12">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption text-info" >
                            <i class="fa fa-cart"></i>Preliminary Profile Details
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse" data-original-title="" title=""></a>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                 <img id="MainContent_Image1" class="img-responsive" src="Images/visa%20anad%20mastercard%20security%20logo.png">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                   <span id="MainContent_Lblerror" class="control-label" style="color:Red;"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="MainContent_pnlDetails" class="table-responsive">
                                        <h4 class="form-section bold">Transaction Details</h4>(<b>Unified Payment</b>)
                                        <p class="alert alert-danger">
                                            Please Confirm your Information before proceeding and also note your Transaction 
                                ID. The Transaction ID is necessary for future correspondence. A message 
                                containing the Transaction Id has been sent to the specified email address
                                        </p>                                        
                                        <div class="error red" style="font-size:large;color:red">You MUST pay with your School fees account created on this platform. Paying via another account will render your required service tied to the paying account, unless it's Guardian Acoount</div>
                                        <table class="table table-bordered table-striped table-condensed" style="color: #000000">
                                                <tbody>
                                                    <tr>
                                                        <td class="bold">Transaction ID:
                                                        </td>
                                                        <td>
                                                            <span id="MainContent_LitTransactionId"><b>{{rand(100000000,999999999)}}</b></span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="bold">Service:
                                                        </td>
                                                        <td>
                                                            <span id="MainContent_LitRegistration"> School fees</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="bold">Cost:
                                                        </td>
                                                        <td>
                                                            <span style="font-weight: bold;">NGN - #<span id="MainContent_LitCostMain">1,000.00</span></span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="bold">Transaction Charge:</td>
                                                        <td>
                                                            <span style="font-weight: bold;">NGN - #<span id="MainContent_LitTransactionCost">0.00</span></span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="bold">Total Cost:</td>
                                                        <td>
                                                            <span style="font-weight: bold;">NGN - #<span id="MainContent_LitTotal">1,000.00</span></span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="bold">Name:</td>
                                                        <td>
                                                            <span id="MainContent_LitName">{{$student->name}} </span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="bold">Reg No.:
                                                        </td>
                                                        <td>
                                                            <span id="MainContent_Litemail">{{$student->user->username}}                                </span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="bold">Guardian phone:
                                                        </td>
                                                        <td>
                                                            <span id="MainContent_Litphone">{{$student->guardian->phone}}</span>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                         <div>
                                            <input type="submit" name="ctl00$MainContent$btnPopUp" value="OK" id="MainContent_btnPopUp" style="display: none;">
                                        </div>

                                    </div>
                                </div>
                            </div>
                          <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <a class="btn blue " id="btnprint" onclick="javascript:PrintElem('dvall');"> 
                                            Print <i class="icon-printer m-icon-white"></i></a> 

                                      
                                     <input type="submit" onclick="Payment()" name="ctl00$MainContent$btnSubmit" value="Continue To Payment >>" id="MainContent_btnSubmit" class="btn btn-primary" style="border-style:Solid;margin-right: 60px; font-weight: bold;">&nbsp; &nbsp;
                
                                         <input type="submit" name="ctl00$MainContent$btnContinueWithoutPay" value="Continue Without Payment" id="MainContent_btnContinueWithoutPay" style="border-style:Solid;width:220px;font-weight: bold; display: none">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function Payment() {
            alert('Payment successiful')
        }
    </script>
@endsection
