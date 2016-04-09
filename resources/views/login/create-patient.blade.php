@extends("login.layout-operator")

@section("content")
<div class="container">
    <div class="col-xs-12 col-sm-10 col-sm-10 col-md-offset-2 col-md-8">
        <h4 class="text-center">Create New Patient</h4>
        <form class="form-horizontal" action="{{route('patient.store')}}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="patientname" class="col-sm-3 control-label">Patient Name</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" value="{{old('patientname')}}"  name="patientname" id="patientname" placeholder="Patient Name">
                    @if (session('login_message'))
                    <div class="text-danger padding-5">{{ session('login_message') }}</div>
                    @else
                    <div class="text-danger padding-5">{{$errors->first('patientname')}}</div>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="col-sm-3 control-label">Patient Email</label>
                <div class="col-sm-9">
                    <input type="email" class="form-control" id="email" value="{{old('email')}}" name="email" placeholder="Patient Email">
                    <div class="text-danger padding-5">{{$errors->first('email')}}</div>
                </div>
            </div>
            <div class="form-group">
                <label for="Passcode" class="col-sm-3 control-label">Passcode</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="passcode" value="{{old('passcode')}}" name="passcode" placeholder="Passcode">
                    <div class="text-danger padding-5">{{$errors->first('passcode')}}</div>
                </div>
            </div>
            <div class="form-group">
                <label for="date" class="col-sm-3 control-label">Date of Birth</label>
                <div class="col-sm-9">
                    <input type="date" placeholder="eg. 31-10-1984" class="form-control" id="dob" value="{{old('dob')}}" name="dob" placeholder="Date of Birth">
                    <div class="text-danger padding-5">{{$errors->first('dob')}}</div>
                </div>
            </div>
            <div class="form-group">
                <label for="sex" class="col-sm-3 control-label">Sex</label>
                <div class="col-sm-9">
                    <select name="sex" id="sex" class="form-control">
                        <option value="0" {{ (old('sex') == '0')?"selected":"" }}>Unknown</option>
                        <option value="1" {{ (old('sex') == '1')?"selected":"" }}>Male</option>
                        <option value="2" {{ (old('sex') == '2')?"selected":"" }}>Female</option>
                    </select>
                    <div class="text-danger padding-5">{{$errors->first('sex')}}</div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit" name="savepatient" id="savepatient" class="btn btn-primary btn-block">Save Patient Details</button>
                </div>
            </div>
        </form>
    </div>
</div>
@stop

