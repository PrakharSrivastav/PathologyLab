@extends("login.layout-patient")

@section("content")
<div class="container margin-top-25">
    <div class="col-xs-12">
        <div class="table-responsive">
            <h4 class="text-center">List of reports</h4>
            <table class="table table-condensed table-striped" id="list_table">
                <thead>
                    <tr>
                        <th>Report Name</th>
                        <th>Case Number</th>
                        <th>Test Date</th>
                        <th>Status of Report</th>
                        <th>Details</th>
                        <th>Created</th>
                        <th>View Report</th>
                        <th>Download</th>
                        <th>Email Report</th>
                    </tr>
                </thead>
                <tbody >
                    <?php for($i=0 ; $i<20 ; $i++) { ?>
                    <tr>
                        <td><a class="btn btn-sm btn-default btn-action btn-block" href="{{route('report.show',['id'=>1])}}">Report Name {{$i}}</a></td>
                        <td><a class="btn btn-sm btn-default btn-action btn-block" href="{{route('report.show',['id'=>1])}}">Case Number {{$i}}</a></td>
                        <td><a class="btn btn-sm btn-default btn-action btn-block" href="{{route('report.show',['id'=>1])}}">{{\Carbon\Carbon::now()}}</a></td>
                        <td><a class="btn btn-sm btn-default btn-action btn-block" href="{{route('report.show',['id'=>1])}}">Generated</a></td>
                        <td><a class="btn btn-sm btn-default btn-action btn-block" href="{{route('report.show',['id'=>1])}}">Lorem ipsum dolor sit amet</a></td>
                        <td><a class="btn btn-sm btn-default btn-action btn-block" href="{{route('report.show',['id'=>1])}}">{{\Carbon\Carbon::now()}}</a></td>
                        <td><a class="btn btn-sm btn-info btn-action btn-block" href="{{route('report.show',['id'=>1])}}"><span class="glyphicon glyphicon-eye-open"></span></td>
                        <td><a class="btn btn-sm btn-warning btn-action btn-block"><span class="glyphicon glyphicon-download-alt"></span></td>
                        <td><a class="btn btn-sm btn-danger btn-action btn-block"><span class="glyphicon glyphicon-envelope"></span></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
@stop
