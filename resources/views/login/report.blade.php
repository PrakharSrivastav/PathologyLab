@extends("login.layout-patient")

@section("content")
<div class="container margin-top-15">
    <div class="col-xs-12 col-sm-8 col-sm-offset-2 ">
        <a href="{{route('download',['id'=>$report->id])}}" class="btn btn-warning">Download Report</a>
        <a href="{{route('report.email',[$report->id])}}" class="btn btn-danger pull-right">Email Report</a>
        <div class="table-responsive">
            <h4 class="text-center">Report Details</h4>
            <table class="table table-condensed table-striped table-bordered table-hover cool-header">
                <thead>
                    <tr>
                        <th style="width:30%">Tag</th>
                        <th>Value</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td>Patient Name</td><td>{{$report->user->name  }}</td></tr>
                    <tr><td>Report Name</td><td>{{$report->report_name}}</td></tr>
                    <tr><td>Case Number</td><td>{{$report->case_number}}</td></tr>
                    <tr><td>Report Details</td><td>{{$report->description}}</td></tr>
                    <tr><td>Additional Details </td><td>{{$report->addition_details}}</td></tr>
                    <tr><td>Report Status</td><td>{{($report->status == '0')? "In Progress" : (($report->status =='1')?"Generate":"Delivered")}}</td></tr>
                    <tr><td>Patient History</td><td>{{$report->patient_history}}</td></tr>
                    <tr><td>Test Date</td><td>{{$report->test_date->format('d-m-Y')}}</td></tr>
                    <tr><td>Tested By</td><td>{{$report->testing_lab}}</td></tr>
                    <tr><td>Last Updated</td><td>{{$report->updated_at->format('d-m-Y')}}</td></tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop
