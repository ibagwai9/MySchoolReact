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
                    <div class="panel panel-body" id="print-0">
                      <div style="color: black;" class="panel-body">
                                @if(isset($results) && $results->count() > 0)
                                        <?php $i=1 ?>
                                        @foreach($students as $student)
                                        <div id="print-{{$i}}" style="height: 900px;" >
                                        <div class="row text-center nomargins" style="text-align: center;" >
                                            <img src="{{asset(thisCollege()->logo_url)}}"
                                            style="width: 70px; height: 70px" 
                                            id="logo">
                                            <h2 style="font-weight: bolder; size: 2em">{{thisCollege()->title}}</h2>
                                            <h3>{{thisCollege()->address}} PMB - {{thisCollege()->pmb}}</h3>
                                            <h4>{{$teacher->school->name}} - Section</h4>
                                            <h4> {{$class->name}} {{$group}} end of {{@$student->results[0]->term->name}} term examination result</h4>
                                            <h4>Academic session: {{$academic_session->name}}</h4>
                                            <hr />
                                        </div>
                                        <table border="1 gray" style="color: black; margin-bottom:-1px; " class="table table-striped table-advance table-hover text-black">
                                            <thead>
                                                <tr cellpadding="5px">
                                                    <td style="width: 60px">No&nbsp;in&nbsp;Class:&nbsp;</td>
                                                    <td class="text-center" style="width: 300px">NAME:</td>
                                                    <td class="text-center">REG.No:</td>
                                                    <td  class="text-center">POSITION:</td>
                                                    <td rowspan="2"  class="text-center"><img src='{{asset("student_photo/$student->profile_pix")}}' style="width: 100px; height: 100px" width="50px" height="50px" /> </td>
                                                </tr>
                                                <tr class="bg-info">
                                                    <td style="width: 60px">{{$i}}</td>
                                                    <td class="text-center">{{@$student->name}}</td>
                                                    <td  class="text-center">{{@$student->reg_no}}</td>
                                                    <td style="text-align: center;">{{@$student->id}}<sup>th</sup></td>
                                                </tr>
                                            </thead>
                                        </table>
                                        <table style="background: gray; margin: 30px; width: 90%" class="table-bordered">
                                            <thead>
                                                <tr>
                                                    <td>S/N</td>
                                                    <td>SUBJECT</td>
                                                    <td>CA</td>
                                                    <td>EXAM</td>
                                                    <td>TOTAL</td>
                                                    <td class="text-center">REMARK</td>
                                                </tr>
                                            </thead>
                                                @if(@$student->results && @$student->results->count()>0)
                                                    <?php $r=1; $total = 0; ?>
                                                    @foreach($student->results as $result)
                                                    
                                                        <tbody>
                                                            <tr>
                                                                <td>{{$r}}</td>
                                                                <td>{{@$result->subject->name}}</td>
                                                                <td>{{@$result->ca}}</td>
                                                                <td>
                                                                    {{@$result->score}}
                                                                </td>
                                                                <td><?php $total += $sub_total = (int)@$result->score + (int)@$result->ca ?>
                                                                    {{$sub_total}}
                                                                </td>
                                                                <td class="text-center">{{$student->getGrade($total)}}</td>
                                                            </tr>
                                                            
                                                        </tbody>
                                                    <?php $r++?>
                                                    @endforeach  
                                                    <tr>
                                                        <td colspan="5" class="text-right">
                                                            Availablerage
                                                        </td>
                                                        <td>
                                                            {{$total/($r-1)}}
                                                        </td>
                                                    </tr>
                                                     <tr>
                                                        <td colspan="6" class="text-left"> 
                                                            <p>Class master Sign & date:_____________________________</p>
                                                            <p>Head teacher stamp Sign & date:_________________________</p>
                                                        </td>
                                                    </tr>    
                                                    <tr>
                                                                <td colspan="6" class="text-right"></td>
                                                            </tr>                      
                                                    </table>
                                                    <table style="color: black; margin-bottom:-1px; " class="table table-striped table-advance table-hover">
                                            <thead style="">
                                                <tr class="bg-info">
                                                    <td colspan="6" class="text-right"> 
                                                         <button onclick="print{{$i}}()" class="btn btn-default btn-xs"><i class="fa fa-print"></i></button>
                                                    </td>
                                                </tr>
                                            </thead>
                                        </table>
                                                @else 
                                                <table style="color: black" class="table table-striped table-advance table-hover">
                                                    <tbody>
                                                        <tr>
                                                            <td colspan="2">Result</td> 
                                                            <td colspan="2">Not Available</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                @endif 
                                            <?php $i++?>
                                        </div>
                                            @endforeach 

                                        </table>
                                    </div>
                                            <div class="row">
                                                <div class="col-md-12 text-right">
                                                    <br />
                                                    <button onclick="print0()" type="submit" class="btn btn-primary"><i class="fa fa-print"></i> Print all</button>
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

    <script type="text/javascript"> 
        @if(isset($results) && $results->count() > 0)
            <?php $i=0 ?>
            @foreach($students as $student)
                function print{{$i}}()
                { 
                    var content = "<html>";
                    content += document.getElementById("print-{{$i}}").innerHTML ;
                    content += "</body>";
                    content += "</html>";


                    var printWin = window.open('','','left=0,top=0,width=1000,height=500,toolbar=0,scrollbars=0,status =0');

                    printWin.document.write(content);
                    printWin.document.close();
                    printWin.focus();
                    printWin.print();
                    printWin.close();
                }
                <?php $i++?>
            @endforeach
        @endif
    </script>
@endsection