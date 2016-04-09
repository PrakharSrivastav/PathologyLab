<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Report;
use App\Http\Requests\ReportRequest;
use Illuminate\Support\Facades\Gate;

class ReportController extends Controller {

    private function showDashboard() {
        return redirect()->route('dashboard');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        if (Gate::denies('is_admin')) {
            return $this->showDashboard();
        }
        else {
            $title    = "Create Report";
            $patients = User::patients()->get();
            return view("login.create-report", compact("title", 'patients'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReportRequest $request) {
        if (Gate::allows('is_admin')) {
            $report                   = new Report();
            $report->user_id          = $request->input('patient');
            $report->test_date        = $request->input('testdate');
            $report->testing_lab      = $request->input('testedby');
            $report->case_number      = str_random(12);
            $report->report_name      = $request->input('reportname');
            $report->patient_history  = $request->input('history');
            $report->description      = $request->input('reportdetails');
            $report->addition_details = $request->input("additionaldetails");
            $report->save();
        }
        return $this->showDashboard();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($report) {
        $report = Report::findOrFail($report);
        if (Gate::allows('view_reports', $report)) {
            $title = "Report Details";
            if(Auth::user()->is_operator == "1"){
                return view("login.report-operator", compact("report", "title"));
            }
            else{
                return view("login.report", compact("report", "title"));
            }
            
        }
        else {
            return $this->showDashboard();
        }
    }

    /**
     * Show the form for editing the specified resource.
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ReportRequest $request, $report) {
        if (Gate::allows("is_admin")) {
            $report                   = Report::findOrFail($report);
            $report->user_id          = $request->input('patient');
            $report->test_date        = $request->input('testdate');
            $report->testing_lab      = $request->input('testedby');
            $report->report_name      = $request->input('reportname');
            $report->patient_history  = $request->input('history');
            $report->description      = $request->input('reportdetails');
            $report->addition_details = $request->input("additionaldetails");
            $report->save();
        }
        return $this->showDashboard();
    }

    /**
     * Remove the specified resource from storage.
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

}
