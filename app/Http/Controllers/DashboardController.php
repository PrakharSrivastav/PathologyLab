<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use App\Report;
use Barryvdh\DomPDF\Facade as PDF;
use PHPMailer;

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

    /**
     * Function to download the reports
     * 
     * @param type $id
     * @return filestream 
     */
    public function downloadReport($id) {
        $report_name = $this->createReport($id);
        return response()->download($report_name);
    }

    /**
     * Function to generate reports and save it in the filesystem
     * In case the file already exists, send the old file
     * 
     * @param type $id
     * @return string $report_name
     */
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

    /**
     * Function to email report to the patient
     * Get the report from the reportId
     * Get the email-id of the patient
     * Generate the report (Use the createReport function)
     * Create the email view
     * Set in the the email parameters
     * send the email
     * 
     * @param type $id
     */
    public function sendReportAsEmail($id) {
        $report = Report::findOrFail($id);


        $this->sendEmail($report);
        return redirect()->route("dashboard");
    }

    /**
     * set charset to utf8
     * use smpt auth
     * ssl setting
     * provide the smtp address
     * provide the ssl port
     * provide the other email related details
     * 
     * @param type $report
     * @return boolean
     */
    public function sendEmail($report) {
        try {
            $title            = "Report Details";
            $mail             = new \PHPMailer(true);
            $filename         = $this->createReport($report->id);
            $mail->isSMTP();
            $mail->CharSet    = "utf-8";
            $mail->SMTPAuth   = true;
            $mail->SMTPSecure = "ssl";
            $mail->Host       = "smtp.gmail.com";
            $mail->Port       = 465;
            $mail->Username   = "patholigylabreports@gmail.com";
            $mail->Password   = "thisisauniqueemailpassword123";
            $mail->Subject    = "Pathology Lab Report : " . $filename;
            $mail->setFrom(
                "patholigylabreports@gmail.com", "Pathology Lab Report "
            );
            $mail->MsgHTML(
                view("pdf.download", compact("report", "title"))
            );
            $mail->addAddress(
                $report->user->email, $report->user->name
            );
            $mail->addAttachment(
                $filename, $filename
            );
            return $mail->send();
        }
        catch (phpmailerException $e) {
            dd($e);
            return false;
        }
        catch (Exception $e) {
            dd($e);
            return false;
        }
    }

}
