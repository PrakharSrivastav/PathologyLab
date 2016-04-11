<?php

namespace App\Http\Controllers;

use App\User;
use App\Report;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\PatientRequest;
use Illuminate\Support\Facades\Gate;

class PatientController extends Controller {

    /**
     * The constructor checks if the current user is authenticated
     * It also makes sure that only the operator is able to access this Controller 
     * The constructor throws a 403 error if patient tries to access this
     * The policy / ablitiy 'is_admin' is defined in App/Providers/AuthServiceProvider
     * 
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        # Check if the current user is authenticated
        if (!Auth::check()) {
            # logout the session
            Auth::logout();
            # redirect to the home page
            return redirect()->route('home');
        }

        # check the policy ('is_admin') and deny access to current user 
        # if the user is not an operator
        if (Gate::denies('is_admin')) {
            abort(403);
        }
    }

    /**
     * Display a listing of the patients.
     * Only the operator has an access to this page
     * 
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $title    = "Patients";
        $patients = User::patients()->orderBy('id', 'DESC')->get();
        return view("login.patients", compact("title", "patients"));
    }

    /**
     * Show the form for creating a new patient.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $title = "Create Patient";
        return view("login.create-patient", compact("title"));
    }

    /**
     * Store a newly created patient in database.
     * Only the operator has an access to this page
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PatientRequest $request) {
        # create a new user object based on input
        $user              = new User;
        $user->name        = trim($request->patientname);
        $user->email       = trim($request->email);
        $user->passcode    = trim($request->passcode);
        $user->password    = trim($request->passcode);
        $user->is_operator = '0';
        $user->dob         = trim($request->dob);
        $user->sex         = trim($request->sex);
        
        # check if the user already exists in the database
        $count = User::where("name", $user->name)->orWhere("email", $user->email)->count();
        
        # save the user if not mathching user found in the database
        if ($count === 0) {
            $user->save();
            return redirect()->route('patient.index');
        }
        # else go back to the create user form
        else {
            return redirect()
                ->back()
                ->withInput()
                ->with("login_message", "User with same name or email already exists");
        }
    }

    /**
     * Display the specified patient.
     * Only the operator has an access to this page
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($patient) {
        $patient = User::patients()->where('id', $patient)->first();
        $title   = "View Patient";
        return view("login.view-patient", compact("title", "patient"));
    }

    /**
     * Show the form for editing the specified patient.
     * Only the operator has an access to this page
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($patient) {
        $title   = "Edit Patient";
        $patient = User::patients()->where('id', $patient)->first();
        return view("login.edit-patient", compact("title", "patient"));
    }

    /**
     * Update the specified patient in database.
     * Only the operator has an access to this page
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(PatientRequest $request, $patient) {
        # save the user information from the edit patient form
        $patient              = User::findorFail($patient);
        $patient->name        = $request->patientname;
        $patient->email       = $request->email;
        $patient->passcode    = $request->passcode;
        $patient->password    = trim($request->passcode);
        $patient->is_operator = '0';
        $patient->dob         = $request->dob;
        $patient->sex         = $request->sex;
        $patient->save();
        
        # redirect to the patients list
        return redirect()->route('patient.index');
    }

    /**
     * Remove the specified patient from database.
     * Only the operator has an access to this page
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($patient) {
        User::destroy($patient);
        Report::where('user_id',$patient)->delete();
        return redirect()->route('patient.index');
    }

}
