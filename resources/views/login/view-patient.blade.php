@extends("login.layout-operator")

@section("content")
<div class="container margin-top-15">
    <div class="col-xs-12 col-sm-8 col-sm-offset-2 ">
        <div class="table-responsive">
            <h4 class="text-center">Patient Details</h4>
            <table class="table table-condensed table-striped table-bordered table-hover cool-header">
                <thead>
                    <tr>
                        <th style="width:40%">Tag</th>
                        <th>Value</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td>Patient Name</td><td>{{$patient->name}}</td></tr>
                    <tr><td>Patient Email</td><td>{{$patient->email}}</td></tr>
                    <tr><td>Passcode</td><td>{{$patient->passcode}}</td></tr>
                    <tr><td>Date Of Birth</td><td>{{$patient->dob}}</td></tr>
                    <tr><td>Sex</td><td>{{($patient->sex == '1')?'Male':'Female'}}</td></tr>
                    <tr><td>Is Admin</td><td>{{($patient->is_operator == '0')?'No':'Yes'}}</td></tr>
                    <tr><td>Created</td><td>{{$patient->created_at}}</td></tr>
                    <tr><td>Last Updated</td><td>{{$patient->updated_at}}</td></tr>
            </table>
        </div>
    </div>
</div>
@stop
