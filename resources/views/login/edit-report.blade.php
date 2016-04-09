@extends("login.layout-operator")

@section("content")
<div class="container">
    <div class="col-xs-12 col-sm-10 col-sm-10 col-md-offset-2 col-md-8">
        <h4 class="text-center">Edit Report</h4>
        <form class="form-horizontal" action="{{route('report.update' ,['id'=> '1'])}}" method="post">
            <input type="hidden" name="_method" value="PUT">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="reportname" class="col-sm-3 control-label">Report Name</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control"  id="reportname" placeholder="Report Name" value="{{$report->report_name}}" >
                </div>
            </div>
            <div class="form-group">
                <label for="casenumber" class="col-sm-3 control-label">Case Number</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="casenumber" placeholder="Case Number" value="{{$report->case_number}}">
                </div>
            </div>
            <div class="form-group">
                <label for="reportdetails" class="col-sm-3 control-label">Report Details</label>
                <div class="col-sm-9">
                    <textarea class="form-control" id="reportdetails" placeholder="Report Details">{{$report->description}}</textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="additionaldetails" class="col-sm-3 control-label">Additional Details</label>
                <div class="col-sm-9">
                    <textarea class="form-control" id="additionaldetails" placeholder="Additional Details">{{$report->addition_details}}</textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="history" class="col-sm-3 control-label">Patient History</label>
                <div class="col-sm-9">
                    <textarea class="form-control" id="history" placeholder="Patient History">{{$report->patient_history}}</textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="testdate" class="col-sm-3 control-label">Test Date</label>
                <div class="col-sm-9">
                    <input type="date" class="form-control" id="testdate" placeholder="Test Date" value="{{$report->test_date->format('d-m-Y')}}">
                </div>
            </div>
            <div class="form-group">
                <label for="testedby" class="col-sm-3 control-label">Tested By</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="testedby" placeholder="Tested By" value="{{$report->testing_lab}}">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit" class="btn btn-primary btn-block">Save Report</button>
                </div>
            </div>
        </form>
    </div>
</div>
@stop

