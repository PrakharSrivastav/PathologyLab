<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\PatientRequest;

class PatientController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $title    = "Patients";
        $patients = User::patients()->orderBy('id','DESC')->get();
        return view("login.patients", compact("title", "patients"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $title = "Create Patient";
        return view("login.create-patient", compact("title"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PatientRequest $request) {
        $user              = new User;
        $user->name        = $request->patientname;
        $user->email       = $request->email;
        $user->passcode    = $request->passcode;
        $user->password    = Hash::make($request->passcode);
        $user->is_operator = '0';
        $user->dob         = $request->dob;
        $user->sex         = $request->sex;

        $count = User::where("name",$user->name)->orWhere("email",$user->email)->count();
        if ($count === 0) {
            $user->save();
            return redirect()->route('patient.index');
        }
        else{
            return redirect()
                ->back()
                ->withInput()
                ->with("login_message","User with same name or email already exists");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($patient) {
        $patient = User::patients()->where('id',$patient)->first();
        $title = "View Patient";
        return view("login.view-patient", compact("title","patient"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($patient) {
        $title = "Edit Patient";
        $patient = User::patients()->where('id',$patient)->first();
        return view("login.edit-patient", compact("title","patient"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PatientRequest $request, $patient) {
        $patient = User::findorFail($patient);
        $patient->name        = $request->patientname;
        $patient->email       = $request->email;
        $patient->passcode    = $request->passcode;
        $patient->password    = Hash::make($request->passcode);
        $patient->is_operator = '0';
        $patient->dob         = $request->dob;
        $patient->sex         = $request->sex;
        $patient->save();
        return redirect()->route('patient.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($patient) {
        User::patients()->findOrFail($patient)->delete();
        return redirect()->route('patient.index');
    }

}
