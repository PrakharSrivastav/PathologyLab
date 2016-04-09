<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use App\Report;
use App\Http\Requests\ReportRequest;

class ReportController extends Controller {

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
        $title    = "Create Report";
        $patients = User::patients()->get();
        return view("login.create-report", compact("title", 'patients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReportRequest $request) {
        $report                     = new Report();
        $report->user_id            = $request->input('patient');
        $report->test_date          = $request->input('testdate');
        $report->testing_lab        = $request->input('testedby');
        $report->case_number        = str_random(12);
        $report->report_name        = $request->input('reportname');
        $report->patient_history    = $request->input('history');
        $report->description        = $request->input('reportdetails');
        $report->addition_details = $request->input("additionaldetails");
        $report->save();
        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($report) {
        $title = "Report Details";
        return view("login.report", compact("title","report"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($report) {
        $report = Report::findOrFail($report);
        $title = "Edit Report";
        return view("login.edit-report", compact("title","report"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        return redirect()->route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        return redirect()->route('dashboard');
    }

}
