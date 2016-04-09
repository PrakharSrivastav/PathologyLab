@extends("login.layout-operator")

@section("content")
<div class="container margin-top-25">
    <div class="col-xs-12">
        <a href="{{route("report.create")}}" class="btn btn-info">Create New Report</a>
        <div class="table-responsive">
            <h4 class="text-center">List of reports</h4>
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
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($reports))
                    @foreach($reports as $report)
                    <tr>
                        <td><a class="btn btn-sm btn-default btn-action btn-block" href="{{route('report.show',['id'=>$report->id])}}">{{($report->report_name == "")?"-":$report->report_name}}</a></td>
                        <td><a class="btn btn-sm btn-default btn-action btn-block" href="{{route('report.show',['id'=>$report->id])}}">{{($report->user->name == "")?"-":$report->user->name}}</a></td>
                        <td><a class="btn btn-sm btn-default btn-action btn-block" href="{{route('report.show',['id'=>$report->id])}}">{{($report->case_number == "")?"-":$report->case_number}}</a></td>
                        <td><a class="btn btn-sm btn-default btn-action btn-block" href="{{route('report.show',['id'=>$report->id])}}">{{($report->test_date == "")?"-":$report->test_date->format('d-m-Y')}}</a></td>
                        <td><a class="btn btn-sm btn-default btn-action btn-block" href="{{route('report.show',['id'=>$report->id])}}">{{($report->status == "")?"-":$report->status}}</a></td>
                        <td><a class="btn btn-sm btn-default btn-action btn-block" href="{{route('report.show',['id'=>$report->id])}}">{{($report->description == "")?"-":$report->description}}</a></td>
                        <td><a class="btn btn-sm btn-default btn-action btn-block" href="{{route('report.show',['id'=>$report->id])}}">{{($report->test_date == "")?"-":$report->test_date->format('d-m-Y')}}</a></td>
                        <td><a class="btn btn-sm btn-info btn-action-normal btn-block" href="{{route('report.show',['id'=>$report->id])}}"><span class="glyphicon glyphicon-eye-open"></span></a></td>
                        <td><a class="btn btn-sm btn-warning btn-action-normal btn-block" href="{{route('report.edit',['id'=>$report->id])}}"><span class="glyphicon glyphicon-edit"></span></a></td>
                        <td><form action="{{route('report.destroy',['report'=>$report->id])}}" method="post">{{ csrf_field() }}<input type="hidden" name="_method" value="DELETE"><button type="submit" id="delete_{{$report->id}}" class="btn delete btn-sm btn-danger btn-action-normal btn-block"><span class="glyphicon glyphicon-trash"></span></button></form></td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>

</div>

@stop
