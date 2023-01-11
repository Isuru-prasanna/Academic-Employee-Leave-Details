<!DOCTYPE html>
@extends('layouts.mainlayout')
@section('title','Academic Employees Promotion Details')
@section('content')
<div class="container">
    <div class="row">
        <div class="container bpu-container" >
            <h1> Academic Employee Leave Details</h1>
            <div class="row">
                <div class="col-md-12 text-left">
                    <table class="table table-dark">
                        <th>EPF</th>
                        <th>Name</th>
                        <th>Designation</th>
                        <th>Department</th>
                        <th>Faculty</th>
                        @foreach($employee as $empdatas)
                        <tr>
                            <td> {{$empdatas->empepf}} </td>
                            <td> {{$empdatas->empNames}} </td>
                            <td> {{$empdatas->designation ==null ? 'none': $empdatas->designation}}</td>
                            <td> {{$empdatas->dname == null ? 'none' : $empdatas->dname  }} </td>
                            <td> {{$empdatas->name == null ? 'none' : $empdatas->name }} </td>
                            <td>
                                {{csrf_field()}}
                                <a href="{{url('/employee/leave/view/'.$empdatas->empepf)}}" class="btn btn-warning">Leave Details</a>
                              
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection