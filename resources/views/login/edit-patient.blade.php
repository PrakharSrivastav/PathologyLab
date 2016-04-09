@extends("login.layout-operator")

@section("content")
<div class="container">
    <div class="col-xs-12 col-sm-10 col-sm-10 col-md-offset-2 col-md-8">
        <h4 class="text-center">Edit Patient</h4>
        <form class="form-horizontal" action="{{route('patient.update',['id'=>$patient->id])}}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="PUT">
            <div class="form-group">
                <label for="patientname" class="col-sm-3 control-label">Patient Name</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" value="{{$patient->name}}" id="patientname" name="patientname" placeholder="Patient Name">
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
                    <input type="email" class="form-control" value="{{$patient->email}}" id="email" name="email" placeholder="Patient Email">
                    <div class="text-danger padding-5">{{$errors->first('email')}}</div>
                </div>
            </div>
            <div class="form-group">
                <label for="Passcode" class="col-sm-3 control-label">Passcode</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="passcode"  value="{{$patient->passcode}}" name="passcode" placeholder="Passcode">
                    <div class="text-danger padding-5">{{$errors->first('passcode')}}</div>
                </div>
            </div>
            <div class="form-group">
                <label for="date" class="col-sm-3 control-label">Date of Birth</label>
                <div class="col-sm-9">
                    <input type="date" name="dob" class="form-control" id="dob"  value="{{$patient->dob->format('d-m-Y')}}" placeholder="Date of Birth">
                    <div class="text-danger padding-5">{{$errors->first('dob')}}</div>
                </div>
            </div>
            <div class="form-group">
                <label for="sex" class="col-sm-3 control-label">Sex</label>
                <div class="col-sm-9">
                    <select id="sex" name="sex" class="form-control">
                        <option value="0" {{ ($patient->sex == '0')?"selected":"" }}>Unknown</option>
                        <option value="1" {{ ($patient->sex == '1')?"selected":"" }}>Male</option>
                        <option value="2" {{ ($patient->sex == '2')?"selected":"" }}>Female</option>
                    </select>
                    <div class="text-danger padding-5">{{$errors->first('sex')}}</div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit" class="btn btn-primary btn-block">Save Patient Details</button>
                </div>
            </div>
        </form>
    </div>
</div>
@stop

