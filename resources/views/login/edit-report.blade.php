@extends("login.layout-operator")

@section("content")
<div class="container">
    <div class="col-xs-12 col-sm-10 col-sm-10 col-md-offset-2 col-md-8">
        <h4 class="text-center">Edit Report</h4>
        <form class="form-horizontal" action="{{route('report.update' ,['id'=> $report->id])}}" method="post">
            <input type="hidden" name="_method" value="PUT">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="patient" class="col-sm-3 control-label">Patient Name</label>
                <div class="col-sm-9">
                    <select name="patient" id="patient" class="form-control input-sm">
                        <option value="">Please choose the patient</option>
                        @if(isset($patients))
                        @foreach($patients as $patient)
                        <option value="{{$patient->id}}" {{($patient->id == $report->user_id)?"selected":""}}>{{$patient->name}}</option>
                        @endforeach
                        @endif
                    </select>
                    <div class="text-danger padding-5">{{$errors->first('patient')}}</div>
                </div>
            </div>
            <div class="form-group">
                <label for="reportname" class="col-sm-3 control-label">Report Name</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control"  id="reportname" name="reportname" placeholder="Type of the test taken" value="{{$report->report_name}}" >
                    <div class="text-danger padding-5">{{$errors->first('reportname')}}</div>
                </div>
            </div>
            <div class="form-group">
                <label for="reportdetails" class="col-sm-3 control-label">Report Details</label>
                <div class="col-sm-9">
                    <textarea class="form-control" id="reportdetails" name="reportdetails" placeholder="Report Details">{{$report->description}}</textarea>
                    <div class="text-danger padding-5">{{$errors->first('reportdetails')}}</div>
                </div>
            </div>
            <div class="form-group">
                <label for="additionaldetails" class="col-sm-3 control-label">Additional Details</label>
                <div class="col-sm-9">
                    <textarea class="form-control" id="additionaldetails" name="additionaldetails" placeholder="Additional Details for the report">{{$report->addition_details}}</textarea>
                    <div class="text-danger padding-5">{{$errors->first('additionaldetails')}}</div>
                </div>
            </div>
            <div class="form-group">
                <label for="history" class="col-sm-3 control-label">Patient History</label>
                <div class="col-sm-9">
                    <textarea class="form-control" id="history" name="history" placeholder="Please provide the patient history here">{{$report->patient_history}}</textarea>
                    <div class="text-danger padding-5">{{$errors->first('history')}}</div>
                </div>
            </div>
            <div class="form-group">
                <label for="testdate" class="col-sm-3 control-label">Test Date</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="testdate" name="testdate" placeholder="Date (dd-mm-yyyy) on which the test was taken by patient" value="{{$report->test_date->format('d-m-Y')}}">
                    <div class="text-danger padding-5">{{$errors->first('testdate')}}</div>
                </div>
            </div>
            <div class="form-group">
                <label for="testedby" class="col-sm-3 control-label">Tested By</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="testedby" name="testedby" placeholder="Where the test was performed / analysed?" value="{{$report->testing_lab}}">
                    <div class="text-danger padding-5">{{$errors->first('testedby')}}</div>
                </div>
            </div>
            <div class="form-group">
                <label for="status" class="col-sm-3 control-label">Report Status</label>
                <div class="col-sm-9">
                    <select class="form-control input-sm" name="status" id="status">
                        <option value="0"  {{($report->status == '0')?"selected":""}}>In Progress</option>
                        <option value="1"  {{($report->status == '1')?"selected":""}}>Generated</option>
                        <option value="2"  {{($report->status == '2')?"selected":""}}>Delivered</option>
                    </select>
                    <div class="text-danger padding-5">{{$errors->first('status')}}</div>
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

