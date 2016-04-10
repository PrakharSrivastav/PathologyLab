<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use App\Report;
use Barryvdh\DomPDF\Facade as PDF;

class DashboardController extends Controller {

    /**
     * The constructor check if the user is logged in or not
     * If the user is not logged-in the they are redirect to login page
     * 
     * @return View
     */
    public function __construct() {
        if (!Auth::check()) {
            Auth::logout();
            return redirect()->route('home');
        }
    }

    /**
     * This function shows the dashboard to the operator
     * 
     * 
     * @return View
     */
    public function index() {
        # If current logged-in user is Operator then login to operator dashboard
        if (Auth::user()->is_operator === '1') {
            return $this->operator_dashboard();
        }
        # else show the patient dashboard
        else {
            return $this->patient_dashboard();
        }
    }

    /**
     * This function fetches relevant details from the database and
     * redirects to the operator database
     * 
     * @return View
     */
    private function operator_dashboard() {
        $title   = "Operator Dashboard";
        $reports = Report::all();
        return view("login.dashboard-operator", compact("title", "reports"));
    }

    /**
     * This function fetches relevant details from the database and
     * redirects to the patient database
     * 
     * @return View
     */
    private function patient_dashboard() {
        $title   = "Patient Dashboard";
        $reports = Report::all()->where("user_id", Auth::user()->id);
        return view("login.dashboard-patient", compact("title", "reports"));
    }

    public function downloadReport($id) {
        $file_name = $this->createReport($id);
        return response()->download($file_name);
    }

    public function createReport($id) {
        $report      = Report::findOrFail($id);
        $title       = "Report Details";
        $report_name = str_slug($report->user->name . " " . $report->report_name) . '.pdf';
        if (!file_exists($report_name)) {
            $pdf = PDF::loadView("pdf.download", compact("report", "title"));
            $pdf->save($report_name);
        }
        return $report_name;
    }


}
