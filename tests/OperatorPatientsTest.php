<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class OperatorPatientsTest extends TestCase {

    use DatabaseTransactions;

    /**
     * Test Operator navigation after login
     */
    public function testLoginCreatePatientForm() {
        $operator = $this->createOperator();

        $this->actingAs($operator)
            ->visit('/dashboard')->seePageIs('/dashboard')
            # Go to the patient dashboard from the navbar
            ->see("Patients")->click("Patients")->seePageIs("/patient")->see("List Of Patients")
            # Check if you see Create New Patient and click on it to go to the Create New Patient Page
            ->click('Create New Patient')->seePageIs("/patient/create")
            # Fill in the form details and click on submit to check if the patient is created
            ->type("patient 1", "patientname")
            ->type("patient@test.cm", "email")
            ->type("password1", "passcode")
            ->type('31-05-1984', 'dob')
            ->select('1', 'sex')
            ->press('Save Patient Details')->seePageIs("/patient")->see("patient_1")->see("patient@test.cm")->see("password1");
//        $this->deleteUser($operator);
    }

    public function testCreatePatientForm() {
        $user = $this->createOperator();

        $this->actingAs($user)
            # Test without any parameters
            ->visit('/patient/create')
            ->type("", "patientname")->type("", "email")->type("", "passcode")->type('', 'dob')->select('0', 'sex')
            ->press("Save Patient Details")
            ->seePageIs("/patient/create")->see("The patientname field is required")->see("The email field is required")->see("The passcode field is required")->see("The dob field is required");

        $this->actingAs($user)
            # Try creating a proper customer
            ->visit('/patient/create')
            ->type("awierdusernamethatwillnotconflictanymore", "patientname")
            ->type("awierdusernamethatwillnotconflictanymore@test.com", "email")
            ->type("awierdpasswordthatshouldnotconflict", "passcode")
            ->type('20-03-1980', 'dob')
            ->select('1', 'sex')
            ->press("Save Patient Details")
            ->seePageIs("/patient")
            ->see("awierdusernamethatwillnotconflictanymore")
            ->see("awierdusernamethatwillnotconflictanymore@test.com")
            ->see("awierdpasswordthatshouldnotconflict")
            ->seeInDatabase('users', [
                'email'       => 'awierdusernamethatwillnotconflictanymore@test.com',
                'name'        => 'awierdusernamethatwillnotconflictanymore',
                'is_operator' => '0'
        ]);

//        $this->deleteUser($user);
    }

    public function testCreatePatientFormValidations() {
        $user = $this->createOperator();

        $this->actingAs($user)
            ->visit('/patient/create')
            ->seePageIs('/patient/create')
            ->see('Create New Patient')
            ->see('Save Patient Details')
            # Test without Username
            ->type("", "patientname")
            ->type("awierdusernamethatwillnotconflictanymore@test.cm", "email")
            ->type("password1", "passcode")
            ->type('31-05-1984', 'dob')
            ->select('1', 'sex')
            ->press("Save Patient Details")
            ->seePageIs("/patient/create")
            ->see("The patientname field is required");

        $this->actingAs($user)
            # Test without Email
            ->visit('/patient/create')
            ->type("awierdusernamethatwillnotconflictanymore", "patientname")
            ->type("", "email")
            ->type("password1", "passcode")
            ->type('31-05-1984', 'dob')
            ->select('1', 'sex')
            ->press("Save Patient Details")
            ->seePageIs("/patient/create")
            ->see("The email field is required");

        $this->actingAs($user)
            # Test without Password
            ->visit('/patient/create')
            ->type("awierdusernamethatwillnotconflictanymore", "patientname")
            ->type("awierdusernamethatwillnotconflictanymore@test.cm", "email")
            ->type("", "passcode")
            ->type('31-05-1984', 'dob')
            ->select('1', 'sex')
            ->press("Save Patient Details")
            ->seePageIs("/patient/create")
            ->see("The passcode field is required");

        $this->actingAs($user)
            # Test without dob
            ->visit('/patient/create')
            ->type("awierdusernamethatwillnotconflictanymore", "patientname")
            ->type("awierdusernamethatwillnotconflictanymore@test.cm", "email")
            ->type("password", "passcode")
            ->type('', 'dob')
            ->select('1', 'sex')
            ->press("Save Patient Details")
            ->seePageIs("/patient/create")
            ->see("The dob field is required");

//        $this->deleteUser($user);
    }

    public function testViewPatient() {
        $oper    = $this->createOperator();
        $patient = $this->createPatient();
        $this->actingAs($oper)
            ->visit('/patient')
            ->seePageIs('/patient')
            ->see('List Of Patients')
            ->click('view_patient')
            ->see('Patient Details')
            ->see("Patient Name")
            ->see("Date Of Birth");
    }

    public function testEditPatient() {
        // create patient and operator in the database
        $patient  = $this->createPatient();
        $operator = $this->createOperator();
        // check if the patient is present in the database and get the Id
        $this->seeInDatabase('users', [
            "name"        => str_slug($patient->name, "_"),
            "email"       => $patient->email,
            "passcode"    => $patient->passcode,
            "is_operator" => '0']
        );
        // login as an operator
        $this->actingAs($operator)
            // go to the edit page of the patient
            ->visit("/patient/$patient->id/edit")
            // check if you see correct patient details
            ->see("Edit Patient")->see($patient->name)->see($patient->email)->see($patient->passcode)
            // update the username , email, passcode
            ->type("Test Patient", "patientname")
            ->type("testemailaddress@test.com", "email")
            ->type("password1", "passcode")
            ->type('31-05-1984', 'dob')
            ->select('1', 'sex')
            // click on submit
            ->press("Save Patient Details")
            // check if the new details are in the database
            ->seeInDatabase('users', [
                "name"        => str_slug("Test Patient", "_"),
                "email"       => "testemailaddress@test.com",
                "passcode"    => "password1",
                "is_operator" => '0']
            )
            // check if the new details are on the webpage
            ->seePageIs("/patient")
            ->see(str_slug("Test Patient", "_"))
            ->see("testemailaddress@test.com")
            ->see("password1");
    }

    /**
     * This function tests for the valid error messages fr the edit patient form
     * cases handeled
     *  1. Test without username
     *  2. Test without email
     *  3. Test without passcode
     *  4. Test without any input parameters
     */
    public function testEditPatientFormValidations() {
        // create a patient in the database
        $patient  = $this->createPatient();
        // create an operator
        $operator = $this->createOperator();
        // Test without Username
        $this->actingAs($operator)
            ->visit("/patient/$patient->id/edit")
            ->type("", "patientname")
            ->type("testemailaddress@test.com", "email")
            ->type("password1", "passcode")
            ->type('31-05-1984', 'dob')
            ->select('1', 'sex')
            ->press("Save Patient Details")
            ->seePageIs("/patient/$patient->id/edit")
            ->see("The patientname field is required");
            
        // Test without email
        $this->actingAs($operator)
            ->visit("/patient/$patient->id/edit")
            ->type("testname", "patientname")
            ->type("", "email")
            ->type("password1", "passcode")
            ->type('31-05-1984', 'dob')
            ->select('1', 'sex')
            ->press("Save Patient Details")
            ->seePageIs("/patient/$patient->id/edit")
            ->see("The email field is required");
        
        // Test without passcode
        $this->actingAs($operator)
            ->visit("/patient/$patient->id/edit")
            ->type("testname", "patientname")
            ->type("testemailaddress@test.com", "email")
            ->type("", "passcode")
            ->type('31-05-1984', 'dob')
            ->select('1', 'sex')
            ->press("Save Patient Details")
            ->seePageIs("/patient/$patient->id/edit")
            ->see("The passcode field is required");
        
        // Test without any parameters
        $this->actingAs($operator)
            ->visit("/patient/$patient->id/edit")
            ->type("", "patientname")
            ->type("", "email")
            ->type("", "passcode")
            ->type('', 'dob')
            ->press("Save Patient Details")
            ->seePageIs("/patient/$patient->id/edit")
            ->see("The passcode field is required")
            ->see("The email field is required")
            ->see("The patientname field is required")
            ->see("The dob field is required");
    }

    public function testPatientDeletion() {
        // create a patient in the database
        $patient  = $this->createPatient();
        // create an operator
        $operator = $this->createOperator();
        // go to the patient page
        $this->actingAs($operator)
            ->visit('/patient')
            ->seePageIs('/patient')
            ->see("delete_$patient->id")
            // click on delete
            ->press("delete_$patient->id")
            ->see('List Of Patients')
            ->seePageIs('/patient')
            // check if the webpage shows the deleted user
            ->dontSee($patient->name)
            ->dontSee($patient->email)
            ->dontSee("delete_$patient->id");
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
