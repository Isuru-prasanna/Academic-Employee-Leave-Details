<!DOCTYPE html>
@extends('layouts.mainlayout')
@section('title', 'Employee Old Designations')
@section('content')
<div class="container">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <div class="row">
        <div class="container" id="faccontainer">
            <h1> Employee Leave Details Update</h1>
            <div class="row">
                <div class="col-md-12">
                    <form action="{{url('/leaveDetailsUpdate')}}" method="post" Class="was-validated">
                        {{ csrf_field() }}
                        </br></br>
                        <div class="form-group form-row">
                            <label class="col-sm-3" for="input-upf">Employee EPF</label>
                            <div class="col-sm-9 text-left">
                                <input type="text" class="form-control" value="{{$levupdeview->empepf}}" id="upfnos" name="upfnos" placeholder="Enter the Employee Old Designation here" readonly>
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label class="col-sm-3" for="input-upf">Leave Type</label>
                            <div class="col-sm-9 text-left">
                                <select class="form-control formselect required" placeholder="Select Division"  id="leavetyp" name="leavetyp">
                                    <option value="{{$levupdeview->leave_type}}">{{$levupdeview->leave_type}}</option>
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
                                <input value="{{$levupdeview->startdate}}" class="form-control" type="date" name="startdate" placeholder="default" required="required" id="input-startdate" onchange="onDateChange(event);">
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label class="col-sm-3" for="input-enddate">End Date</label>
                            <div class="col-sm-9">
                                <input value="{{$levupdeview->enddate}}" class="form-control" type="date" name="enddate" placeholder="default" required="required" id="input-enddate" onchange="onDateChange(event);">
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label class="col-sm-3" for="input-duration">Duration</label>
                            <div class="col-sm-9 text-left">
                                <input type="text" value="{{$levupdeview->duration}}" class="form-control" id="duration" name="duration" placeholder="Duration" required="required" readonly>
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label class="col-sm-3" for="input-initials">Number Of Date For Leave</label>
                            <div class="col-sm-9">
                                <input value="{{$levupdeview->dateleave}}" class="form-control" type="text" name="dateforleave" placeholder="" required="required" id="newbasicsalary">
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label class="col-sm-3" for="hdrSelect">Year</label>
                            <div class="col-sm-9">
                                <select id="year" name="year" class="form-control">
                                <option value="{{$levupdeview->year}}">{{$levupdeview->year}}</option>
                                    @for ($year = date('Y')-30; $year <=date('Y'); $year++) <option value="{{$year}}" {{$year == date('Y') ? 'selected':''}}>{{ $year }}</option>
                                        @endfor
                                </select>
                            </div>
                        </div>
                        </br>

                        <input type="submit" class="btn btn-primary" onclick="return confirm('Are you sure?')" value="SAVE">
                        <input type="button" class="btn btn-warning" value="CLEAR">
                        </br> </br>
                    </form>
                    <br>
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