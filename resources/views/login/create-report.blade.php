@extends("login.layout-operator")

@section("content")
<div class="container">
    <div class="col-xs-12 col-sm-10 col-sm-10 col-md-offset-2 col-md-8">
        <h4 class="text-center">Create New Report</h4>
        <form class="form-horizontal" action="{{route('report.store')}}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="patient" class="col-sm-3 control-label">Patient Name</label>
                <div class="col-sm-9">
                    <select name="patient" id="patient" class="form-control input-sm">
                        <option value="">Please choose the patient</option>
                        @if(isset($patients))
                        @foreach($patients as $patient)
                        <option value="{{$patient->id}}" {{($patient->id == old('patient'))?"selected":""}}>{{$patient->name}}</option>
                        @endforeach
                        @endif
                    </select>
                    <div class="text-danger padding-5">{{$errors->first('patient')}}</div>
                </div>
            </div>
            <div class="form-group">
                <label for="reportname" class="col-sm-3 control-label">Report Name</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control input-sm" value="{{old('reportname')}}" id="reportname" name="reportname" placeholder="Type of the test taken">
                    <div class="text-danger padding-5">{{$errors->first('reportname')}}</div>
                </div>
            </div>
            <div class="form-group">
                <label for="reportdetails" class="col-sm-3 control-label">Report Details</label>
                <div class="col-sm-9">
                    <textarea class="form-control input-sm" id="reportdetails" name="reportdetails" placeholder="Report Details">{{old('reportdetails')}}</textarea>
                    <div class="text-danger padding-5">{{$errors->first('reportdetails')}}</div>
                </div>
            </div>
            <div class="form-group">
                <label for="additionaldetails" class="col-sm-3 control-label">Additional Details</label>
                <div class="col-sm-9">
                    <textarea class="form-control input-sm" id="additionaldetails" name="additionaldetails" placeholder="Additional Details for the report">{{old('additionaldetails')}}</textarea>
                    <div class="text-danger padding-5">{{$errors->first('additionaldetails')}}</div>
                </div>
            </div>
            <div class="form-group">
                <label for="history" class="col-sm-3 control-label">Patient History</label>
                <div class="col-sm-9">
                    <textarea class="form-control input-sm" id="history" name="history" placeholder="Please provide the patient history here">{{old('history')}}</textarea>
                    <div class="text-danger padding-5">{{$errors->first('history')}}</div>
                </div>
            </div>
            <div class="form-group">
                <label for="testdate" class="col-sm-3 control-label">Test Date</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control input-sm" id="testdate"  value="{{old('testdate')}}" name="testdate" placeholder="Date (dd-mm-yyyy) on which the test was taken by patient">
                    <div class="text-danger padding-5">{{$errors->first('testdate')}}</div>
                </div>
            </div>
            <div class="form-group">
                <label for="testedby" class="col-sm-3 control-label">Tested At</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control input-sm" id="testedby" name="testedby" value="{{old('testedby')}}" placeholder="Where the test was performed / analysed?">
                    <div class="text-danger padding-5">{{$errors->first('testedby')}}</div>
                </div>
            </div>
            <div class="form-group">
                <label for="status" class="col-sm-3 control-label">Report Status</label>
                <div class="col-sm-9">
                    <select class="form-control input-sm" name="status" id="status">
                        <option value="0"  {{(old('status') == '0')?"selected":""}}>In Progress</option>
                        <option value="1"  {{(old('status') == '1')?"selected":""}}>Generated</option>
                        <option value="2"  {{(old('status') == '2')?"selected":""}}>Delivered</option>
                    </select>
                    <div class="text-danger padding-5">{{$errors->first('status')}}</div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit" class="btn btn-sm btn-primary btn-block">Save Report</button>
                </div>
            </div>
        </form>
    </div>
</div>
@stop

