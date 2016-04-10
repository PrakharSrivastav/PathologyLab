<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PatientReportsTest extends TestCase {

    use DatabaseTransactions;

    /**
     * Test Patient login
     * Create a patient
     * Login using the patient cretdentials
     * See if the patient is on the patient dashboard
     * See if user can see "Welcome <Patient Name>"
     */
    public function testPatientLogin() {
        $patient = $this->createPatient();
        $this->actingAs($patient)
            ->visit("dashboard")
            ->seePageIs("dashboard")
            ->see("Welcome " . $patient->name)
            ->see("My Reports");
        $this->deleteUser($patient);
    }


    public function testGeneratePDFReports() {
        $patient = $this->createPatient();
        $report = $this->createReport($patient);
        $db = new \App\Http\Controllers\DashboardController();
        $filename = $db->createReport($report->id);
        $this->assertFileExists($filename);
        $this->assertEquals(str_slug($report->user->name." ".$report->report_name).'.pdf', $filename);
    }

    public function testEmailReports() {
        
    }

    /**
     * Create Patient
     * @return App\User
     */
    private function createPatient() {
        $patient = factory(App\User::class)->create([
            "name"        => "thisisauniquepatientname",
            "email"       => "thisisauniquepatientemail@test.com",
            "password"    => "thisisanunbreakablepassword",
            "passcode"    => "thisisanunbreakablepassword",
            "is_operator" => '0']
        );
        return $patient;
    }

    private function createReport($patient) {
        $report = factory(App\Report::class)->create([
            "user_id" => $patient->id
        ]);

        return $report;
    }

    private function deleteUser($user) {
        $user->delete();
    }

}
