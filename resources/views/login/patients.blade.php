@extends("login.layout-operator")

@section("content")
<div class="container margin-top-25">
    <div class="col-xs-12">
        <a href="{{route('patient.create')}}" class="btn btn-info">Create New Patient</a>
        <div class="table-responsive">
            <h4 class="text-center">List Of Patients</h4>
            <table class="table table-condensed table-striped" id="list_table">
                <thead>
                    <tr>
                        <th>Patient Name</th>
                        <th>Patient Email</th>
                        <th>Passcode</th>
                        <th>Date Of Birth</th>
                        <th>Sex</th>
                        <th>Is Patient</th>
                        <th>View</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody >
                    @if(isset($patients) && count($patients)>0)
                    @foreach($patients as $patient)
                    <tr>
                        <td><a class="btn btn-sm btn-default btn-action btn-block" href="{{route('patient.show',['patient'=>$patient->id])}}">{{$patient->name}}</a></td>
                        <td><a class="btn btn-sm btn-default btn-action btn-block" href="{{route('patient.show',['patient'=>$patient->id])}}">{{$patient->email}}</a></td>
                        <td><a class="btn btn-sm btn-default btn-action btn-block" href="{{route('patient.show',['patient'=>$patient->id])}}">{{$patient->passcode}}</a></td>
                        <td><a class="btn btn-sm btn-default btn-action btn-block" href="{{route('patient.show',['patient'=>$patient->id])}}">{{$patient->dob->format('d-m-Y')}}</a></td>
                        <td><a class="btn btn-sm btn-default btn-action btn-block" href="{{route('patient.show',['patient'=>$patient->id])}}">{{($patient->sex == '1')?'Male':'Female'}}</a></td>
                        <td><a class="btn btn-sm btn-default btn-action btn-block" href="{{route('patient.show',['patient'=>$patient->id])}}">{{($patient->is_operator == '0')?'Yes':'NO'}}</a></td>
                        <td><a id="view_patient" class="btn btn-sm btn-info btn-action-normal btn-block" href="{{route('patient.show',['patient'=>$patient->id])}}"><span class="glyphicon glyphicon-eye-open"></span></a></td>
                        <td><a class="btn btn-sm btn-warning btn-action-normal btn-block" href="{{route('patient.edit',['patient'=>$patient->id])}}"><span class="glyphicon glyphicon-edit"></span></a></td>
                        <td><form action="{{route('patient.destroy',['patient'=>$patient->id])}}" method="post">{{ csrf_field() }}<input type="hidden" name="_method" value="DELETE"><button type="submit" id="delete_{{$patient->id}}" class="btn delete btn-sm btn-danger btn-action-normal btn-block"><span class="glyphicon glyphicon-trash"></span></button></form></td>
                    </tr>
                    @endforeach
                    @endif
                    <?php for ($i = 0; $i < 20; $i++) { ?>

                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

@stop
