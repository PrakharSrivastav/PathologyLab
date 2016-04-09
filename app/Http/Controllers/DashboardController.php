<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use App\Report;

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
        $reports = Report::all()->where("user_id",Auth::user()->id);
        return view("login.dashboard-patient", compact("title", "reports"));
    }

}
