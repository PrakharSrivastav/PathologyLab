<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class OperatorReportsTest extends TestCase {

    use DatabaseTransactions;

    public function testReportPageNavigation() {
        $operator = $this->createOperator();
        $this->actingAs($operator)
            ->visit('dashboard')
            ->seePageIs('dashboard')
            ->see('List of reports');
    }

    public function testCreateNewReport() {
        $operator = $this->createOperator();
        $patient  = $this->createPatient();
        // visit the create New Report Page
        $this->actingAs($operator)->visit('report/create')->seePageIs('report/create')
            // provide all the parameters
            ->select($patient->id, 'patient')
            ->type('Sugar Level Test', 'reportname')
            ->type('01-01-2016', 'testdate')
            ->type('XYZ Labs', 'testedby')
            ->type('lorem ipsum', 'history')
            ->type('Random report details', 'reportdetails')
            ->type('Some Additional details', 'additionaldetails')
            // click the submit button
            ->press("Save Report")
            // check if the new report is in database
            ->seeInDatabase("reports", [
                "user_id"     => $patient->id,
                "report_name" => 'Sugar Level Test',
                "testing_lab" => "XYZ Labs"]
            )
            // check if the dashboard contains the new patient and the reports details
            ->seePageIs("dashboard")->see($patient->name)->see("Sugar Level Test")->see("Random report details");
    }

    public function testValidateCreateNewReport() {
        $operator = $this->createOperator();
        $patient  = $this->createPatient();
        // visit the create New Report Page
        $this->actingAs($operator)->visit('report/create')->seePageIs('report/create')
            // submit the form without patient
            ->select("", "patient")->type("01-01-2016", "testdate")->type("XYZ Labs", "testedby")
            ->type("lorem ipsum", "history")->type("report details", "reportdetails")->type("somerandomname", "reportname")
            ->press("Save Report")->seePageIs("report/create")->see("The patient field is required")

            // submit the form without reportname
            ->select($patient->id, "patient")->type("01-01-2016", "testdate")->type("XYZ Labs", "testedby")
            ->type("lorem ipsum", "history")->type("report details", "reportdetails")->type("", "reportname")
            ->press("Save Report")->seePageIs("report/create")->see("The reportname field is required")

            // submit the form with wrong date format
            ->select($patient->id, "patient")->type("01-01-2016 09:09:24", "testdate")->type("XYZ Labs", "testedby")
            ->type("lorem ipsum", "history")->type("report details", "reportdetails")->type("rerasfd asdfs", "reportname")
            ->press("Save Report")->seePageIs("report/create")->see("The testdate does not match the format d-m-Y")

            // submit the form without any params
            ->select("", "patient")
            ->type("", "testdate")
            ->type("", "reportname")
            ->type("", "reportdetails")
            ->type("", "testedby")
            ->press("Save Report")->seePageIs("report/create")
            ->see("The patient field is required")
            ->see("The reportname field is required")
            ->see("The reportdetails field is required")
            ->see("The testdate field is required")
            ->see("The testedby field is required");
    }

    public function testEditReport() {
        $operator = $this->createOperator();
        $patient  = $this->createPatient();
        $report   = $this->createReport($patient);
        // login as operator

        $this->actingAs($operator)
            // go to the edit report page
            ->visit("report/$report->id/edit")->see("Edit Report")->see($patient->name)->see($report->name)->see($report->description)
            // change the report details
            ->select($patient->id, "patient")->type("testreportname", "reportname")->type("thesearerandomreportdetails", "reportdetails")
            // submit form
            ->press("Save Report")
            // check if the new report are in the database
            ->seeInDatabase("reports", [
                "id"          => $report->id,
                "report_name" => "testreportname",
                "description" => "thesearerandomreportdetails"
            ])
            // check if the new report details are on the webpage
            ->seePageIs('dashboard')->see("testreportname")->see("thesearerandomreportdetails");
    }

    // create a report
    // login as the operator
    // go to the dashboard
    // click on the delete button for the report
    // check that you dont see the report in the webpage

    public function testDeleteReport() {
        $operator = $this->createOperator();
        $patient  = $this->createPatient();
        $report   = $this->createReport($patient);
        $this->actingAs($operator)->visit("dashboard")->see("delete_$report->id")
            ->press("delete_$report->id")
            ->seePageIs("dashboard")
            ->dontSee($patient->name)
            ->dontSee($report->report_name)
            ->dontSee("delete_$report->id")
            ->dontSee($report->case_number);
    }

    public function testViewReport() {
        $operator = $this->createOperator();
        $patient  = $this->createPatient();
        $report   = $this->createReport($patient);
        // click on the view report button
        $this->actingAs($operator)
            ->visit("report/$report->id")
            ->seePageIs("report/$report->id")
            ->see($patient->name)
            ->see($report->testing_lab)
            ->see($report->case_number)
            ->see($report->description)
            ->see($report->report_name)
            ->see($report->patient_history);
    }

//
//    public function testDeleteReport() {
//        // create a patient in the database
//        $patient  = $this->createPatient();
//        // create an operator
//        $operator = $this->createOperator();
//        // go to the patient page
//        $this->actingAs($operator)
//            ->visit('/patient')
//            ->seePageIs('/patient')
//            ->see("delete_$patient->id")
//            // click on delete
//            ->press("delete_$patient->id")->see('List Of Patients')->seePageIs('/patient')
//            // check if the webpage shows the deleted user
//            ->dontSee($patient->name)
//            ->dontSee($patient->email)
//            ->dontSee("delete_$patient->id");
//    }

    public function testEmailReport() {
        $operator = $this->createOperator();
        return false;
    }

    public function testPDFReport() {
        $operator = $this->createOperator();
        return false;
    }

    public function testDownloadReport() {
        $operator = $this->createOperator();
        return false;
    }

    private function createReport($patient) {
        $report = factory(App\Report::class)->create([
            "user_id" => $patient->id
        ]);

        return $report;
    }

    /**
     * Create Operator
     * @return App\User
     */
    private function createOperator() {
        $operator = factory(App\User::class)->create([
            "name"        => "test",
            "email"       => "test@test.com",
            "password"    => "12345",
            "passcode"    => "12345",
            "is_operator" => '1']
        );
        return $operator;
    }

    /**
     * Create Patient
     * @return App\User
     */
    private function createPatient() {
        $patient = factory(App\User::class)->create([
            "name"        => "thisisauniquepatientname",
            "email"       => "patient@test.com",
            "password"    => "password",
            "passcode"    => "password",
            "is_operator" => '0']
        );
        return $patient;
    }

}
