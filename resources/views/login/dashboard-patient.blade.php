@extends("login.layout-patient")

@section("content")
<div class="container-fluid margin-top-25">
    <div class="col-xs-12">
        <div class="table-responsive">
            <h4 class="text-center">My Reports</h4>
            <table class="table table-condensed table-striped" id="list_table">
                <thead>
                    <tr>
                        <th>Report Name</th>
                        <th>Patient Name</th>
                        <th>Case Number</th>
                        <th>Test Date</th>
                        <th>Status of Report</th>
                        <th>Details</th>
                        <th>Created</th>
                        <th>View</th>
                        <th>Download</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody >
                    @if(isset($reports))
                    @foreach($reports as $report)
                    <tr>
                        <td><a class="btn btn-sm btn-default btn-action btn-block"  href="{{route('report.show',['id'=>$report->id])}}">{{($report->report_name == "")?"-":$report->report_name}}</a></td>
                        <td><a class="btn btn-sm btn-default btn-action btn-block"  href="{{route('report.show',['id'=>$report->id])}}">{{($report->user->name == "")?"-":$report->user->name}}</a></td>
                        <td><a class="btn btn-sm btn-default btn-action btn-block"  href="{{route('report.show',['id'=>$report->id])}}">{{($report->case_number == "")?"-":$report->case_number}}</a></td>
                        <td><a class="btn btn-sm btn-default btn-action btn-block"  href="{{route('report.show',['id'=>$report->id])}}">{{($report->test_date == "")?"-":$report->test_date->format('d-m-Y')}}</a></td>
                        <td><a class="btn btn-sm btn-default btn-action btn-block"  href="{{route('report.show',['id'=>$report->id])}}">{{($report->status == "")?"-":$report->status}}</a></td>
                        <td><a class="btn btn-sm btn-default btn-action btn-block"  href="{{route('report.show',['id'=>$report->id])}}">{{($report->description == "")?"-":substr($report->description,0,50).".."}}</a></td>
                        <td><a class="btn btn-sm btn-default btn-action btn-block"  href="{{route('report.show',['id'=>$report->id])}}">{{($report->test_date == "")?"-":$report->test_date->format('d-m-Y')}}</a></td>
                        <td><a class="btn btn-sm btn-info btn-action-normal btn-block" id="view_report_{{$report->id}}" href="{{route('report.show',['id'=>$report->id])}}"><span class="glyphicon glyphicon-eye-open"></span></a></td>
                        <td><a class="btn btn-sm btn-warning btn-action-normal btn-block" id="download_report_{{$report->id}}" href="{{route('download',['id'=>$report->id])}}"><span class="glyphicon glyphicon-download-alt"></span></a></td>
                        <td><a class="btn btn-sm btn-danger btn-action-normal btn-block" id="email_report_{{$report->id}}"><span class="glyphicon glyphicon-envelope"></span></a></td>
                     </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>

</div>
@stop
