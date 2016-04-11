<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Report;
use App\Http\Requests\ReportRequest;
use Illuminate\Support\Facades\Gate;

/**
 * This controller class takes care of all the report related features.
 * The basic CRUD operations are defined in this class
 * There are also policies defined in App/Providers/AuthServiceProvider called "is_admin" and "view_reports"
 * which allow / deny patient to access various controller actions
 */
class ReportController extends Controller {

    /**
     * Show the form for creating a new report.
     * Only operator has the access to create a report
     * The patient would be redirected to their dashboard if they try to access this page
     * 
     * @return \Illuminate\Http\Response
     */
    public function create() {

        # if the is_admin policy is not satisfied redirect to the dashboard
        if (Gate::denies('is_admin')) {
            return $this->showDashboard();
        }
        # else show the form to create a report
        else {
            $title    = "Create Report";
            $patients = User::patients()->get();
            return view("login.create-report", compact("title", 'patients'));
        }
    }

    /**
     * Store a newly created report in datbase.
     * Only operator has the access to create a report
     * The patient would be redirected to their dashboard without any operation
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReportRequest $request) {

        # Only if the user is an operator perform the below operations
        if (Gate::allows('is_admin')) {
            # create a new report
            $report                   = new Report();
            $report->user_id          = $request->input('patient');
            $report->test_date        = $request->input('testdate');
            $report->testing_lab      = $request->input('testedby');
            $report->case_number      = str_random(12);
            $report->report_name      = $request->input('reportname');
            $report->patient_history  = $request->input('history');
            $report->description      = $request->input('reportdetails');
            $report->addition_details = $request->input("additionaldetails");
            $report->status           = $request->input("status");
            $report->save();
        }
        return $this->showDashboard();
    }

    /**
     * Display the specified report.
     * Both patient and the operator are able to view this page.
     * However, there are seperate views defined for operator and patient 
     * and the user is shown the corresponding view based on the property is_operator 
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($report) {
        # Find the report
        $report = Report::findOrFail($report);
        $title = "Report Details";
            
        # check the policy if the user is allowed to view the report
        // if (Gate::allows('view_reports', $report)) {
            
            # if the user is an opertor
            if (Auth::user()->is_operator == "1") {
                return view("login.report-operator", compact("report", "title"));
            }
            # else the user is a patient
            else {
                return view("login.report", compact("report", "title"));
            }
        // }
        # if the policy does not allow the user to view this page
        # then show the dashboard to the user
        // else {
            // return $this->showDashboard();
        // }
    }

    /**
     * Show the form for editing the specified report.
     * Only the operator has an access to this page
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($report) {
        if (Gate::allows("is_admin")) {
            $report   = Report::findOrFail($report);
            $patients = User::patients()->get();
            $title    = "Edit Report";
            return view("login.edit-report", compact("patients", "title", "report"));
        }
        else {
            return $this->showDashboard();
        }
    }

    /**
     * Update the specified report in database.
     * Only the operator has an access to this function.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ReportRequest $request, $report) {
        if (Gate::allows("is_admin")) {
            # save the new report details
            $report                   = Report::findOrFail($report);
            $report->user_id          = $request->input('patient');
            $report->test_date        = $request->input('testdate');
            $report->testing_lab      = $request->input('testedby');
            $report->report_name      = $request->input('reportname');
            $report->patient_history  = $request->input('history');
            $report->description      = $request->input('reportdetails');
            $report->addition_details = $request->input("additionaldetails");
            $report->status           = $request->input("status");
            $report->save();
        }
        return $this->showDashboard();
    }

    /**
     * Remove the specified report from database.
     * Only the operator has an access to this function.
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($report) {
        if (Gate::allows("is_admin")) {
            Report::destroy($report);
        }
        return $this->showDashboard();
    }

    /**
     * A helper function to navigate the users to dashboard
     * 
     * @return \Illuminate\Http\Response
     */
    private function showDashboard() {
        return redirect()->route('dashboard');
    }

    public function index() {
        // not required. moved this functionality to route("dashboard")
    }

}
