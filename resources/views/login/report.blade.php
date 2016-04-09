@extends("login.layout-patient")

@section("content")
<div class="container margin-top-15">
    <div class="col-xs-12 col-sm-8 col-sm-offset-2 ">
        <a href="" class="btn btn-warning">Download Report</a>
        <a href="" class="btn btn-danger pull-right">Email Report</a>
        <div class="table-responsive">
            <h4 class="text-center">Report Details</h4>
            <table class="table table-condensed table-striped table-bordered table-hover cool-header">
                <thead>
                    <tr>
                        <th style="width:40%">Tag</th>
                        <th>Value</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td>Report Name</td><td> Report Name</td></tr>
                    <tr><td>Case Number</td><td> Random Number</td></tr>
                    <tr><td>Report Details</td><td>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</td></tr>
                    <tr><td>Additional Details </td><td>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</td></tr>
                    <tr><td>Report Status</td><td>Generated</td></tr>
                    <tr><td>Patient History</td><td>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    quis nostrud exercitation</td></tr>
                    <tr><td>Test Date</td><td>{{\Carbon\Carbon::now()}}</td></tr>
                    <tr><td>Tested By</td><td>XYZ Testing Labs</td></tr>
                    <tr><td>Report Status</td><td>Generated</td></tr>
                    <tr><td>Last Updated</td><td>{{\Carbon\Carbon::now()}}</td></tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop
