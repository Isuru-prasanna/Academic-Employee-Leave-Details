<!DOCTYPE html>
@extends('layouts.mainlayout')
@section('title', 'Employee Old Designations')
@section('content')
<div class="container">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <div class="row">
        <div class="container" id="faccontainer">
            <h1> Employee Leave Details</h1>
            <div class="row">
                <div class="col-md-12">
                    <form action="{{url('/leaveDetailsSave')}}" method="post" Class="was-validated">
                        {{ csrf_field() }}
                        </br></br>
                        <div class="form-group form-row">
                            <label class="col-sm-3" for="input-upf">Employee Name</label>
                            <div class="col-sm-9 text-left">
                                <input type="text" class="form-control" value="{{$employee->empNames}}" id="upfnos" name="upfnos" placeholder="Enter the Employee Old Designation here" readonly>
                                <input type="text" value="{{$employee->empepf}}" class="form-control" id="salIncriDate" name="upfno" id="upfno" placeholder="" require="required" style="display: none;">
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label class="col-sm-3" for="input-upf">Leave Type</label>
                            <div class="col-sm-9 text-left">
                                <select class="form-control formselect required" placeholder="Select Division" id="leavetyp" name="leavetyp">
                                    <option value="-1">All Leave Type</option>
                                    @foreach($leavetyp as $leavetyp)
                                    <option value="{{$leavetyp->leavetypes}}">
                                        {{ ucfirst($leavetyp->leavetypes) }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label class="col-sm-3" for="input-startdate">Start Date</label>
                            <div class="col-sm-9">
                                <input value="" class="form-control" type="date" name="startdate" placeholder="default" required="required" id="input-startdate" onchange="onDateChange(event);">
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label class="col-sm-3" for="input-enddate">End Date</label>
                            <div class="col-sm-9">
                                <input value="" class="form-control" type="date" name="enddate" placeholder="default" required="required" id="input-enddate" onchange="onDateChange(event);">
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label class="col-sm-3" for="input-duration">Duration</label>
                            <div class="col-sm-9 text-left">
                                <input type="text" class="form-control" id="duration" name="duration" placeholder="Duration" required="required" readonly>
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label class="col-sm-3" for="input-initials">Number Of Date For Leave</label>
                            <div class="col-sm-9">
                                <input value="" class="form-control" type="text" name="dateforleave" placeholder="" required="required" id="newbasicsalary">
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label class="col-sm-3" for="hdrSelect">Year</label>
                            <div class="col-sm-9">
                                <select id="year" name="year" class="form-control">
                                    @for ($year = date('Y')-30; $year <=date('Y'); $year++) <option value="{{$year}}" {{$year == date('Y') ? 'selected':''}}>{{ $year }}</option>
                                        @endfor
                                </select>
                            </div>
                        </div>
                        </br>

                        <input type="submit" class="btn btn-primary" value="SAVE">
                        <input type="button" class="btn btn-warning" value="CLEAR">
                        </br> </br>
                    </form>
                    <br>
                    <table class="table table-dark" style="width:100%;">
                        <th>Employee Name</th>
                        <th>Leave Type</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Duration</th>
                        <th>Date of leave</th>
                        <th>Year</th>
                        <td>Action</td>

                        @foreach($empleavdetails as $empdatas)
                        <tr>
                            <td> {{$empdatas->namewithinitials}} </td>
                            <td> {{$empdatas->leave_type}} </td>
                            <td> {{$empdatas->startdate}} </td>
                            <td> {{$empdatas->enddate}} </td>
                            <td> {{$empdatas->duration}} </td>
                            <td> {{$empdatas->dateleave}} </td>
                            <td> {{$empdatas->year}} </td>
                            <td>
                                {{csrf_field()}}
                                <a href="{{url('/delete_Leave_details/'.$empdatas->empepf)}}" onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</a>
                                <a href="{{url('/update_Leave_details/'.$empdatas->empepf)}}" class="btn btn-warning">Update</a>
                            </td>
                        </tr>
                        @endforeach


                    </table>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $('#basicsalincre').keyup(function() {
            var input1;
            var input2;

            input1 = parseFloat($('#basicSalDaBe').val());
            input2 = parseFloat($('#basicsalincre').val());

            var result = (input1 + input2);
            $("#newbasicsalary").val(result);
        });

        function diff_year_month_day(dt1, dt2) {

            var time = (dt2.getTime() - dt1.getTime()) / 1000;
            var month = Math.abs(Math.round(time / (60 * 60 * 24 * 7 * 4)));
            years = Math.floor(month / 12);
            months = month % 12;
            date = month % 31;
            return years + " Years " + months + " Months " + date + " Day";

        }

        function onDateChange(e) {

            let startDate = new Date($("[name='startdate'").val());
            let endDate = new Date($("[name='enddate'").val());
            let dateDiff = diff_year_month_day(endDate, startDate);
            $("[name='duration']").val(dateDiff);
        }
    </script>
</div>
@endsection