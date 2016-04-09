<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * These tests check application for acceptance tests
 * and use the high level methods provided by Laravel to 
 * check the application status and the general web app navigations
 */
class LoginApplicationTest extends TestCase {

    use DatabaseTransactions;

    /**
     * Test if the application is live and sends 200 response status
     */
    public function testApplicationSetup() {
        $this->assertEquals(200, $this->call('GET', '/')->status());
    }

    /**
     * Test if login page renders properly
     *
     * @return void
     */
    public function testLoginPageLoadsProperly() {
        $this->visit('/')
            ->see("Login")
            ->see("Username")
            ->see("Password")
            ->see("Sign in")
            ->dontSee('Pathology Lab');
    }

    /**
     * Test Case : Press 'Sign in' on the homepage without inputs
     * Expected results :
     *      Login page is shown again
     *      Error message 'The username field is required.' is rendered 
     *      Error message 'The password field is required.' is rendered 
     */
    public function testLoginFailureWithoutInputs() {
        $this->visit('/')
            ->press('Sign in')
            ->seePageIs('/')
            ->see('The username field is required.')
            ->see('The password field is required.');
    }

    /**
     * Test Case 1 : Press 'Sign in' on the homepage with 2 character username and blank password
     * Expected results :
     *      Login page is shown again
     *      Error message 'The username must be at least 3 characters.' is rendered 
     *      Error message 'The password field is required.' is rendered 
     */
    public function testLoginFailureWithWrongInputs_1() {
        $this->visit('/')
            ->type('aa', 'username')
            ->press('Sign in')
            ->seePageIs('/')
            ->see('The username must be at least 3 characters.')
            ->see('The password field is required.');
    }

    /**
     *  Test Case 2 : Press 'Sign in' on the homepage with username = admin , password = 12345
     *  Expected results :
     *      Login page is shown again
     *      Error message 'Invalid Username or Password' is rendered 
     * 
     */
    public function testLoginFailureWithWrongInputs_2() {
        $this->visit("/")
            ->type('wrongusername', 'username')
            ->type('wrongpassword', 'password')
            ->press('Sign in')
            ->seePageIs('/')
            ->see('Invalid Username or Password');
    }

    /**
     * Test to check if the inputs are available in the login form
     * if the form validation fails so that user does not have
     * to type in the inputs again
     */
    public function testInputsFlashedOnFormFailure() {
        $this->visit("/")
            ->type('admin', 'username')
            ->press('Sign in')
            ->seePageIs('/')
            ->see('admin');
    }

//    

    /**
     * When proper login credentials are applied
     * Check the overall navigation by clicking various navigations
     */
    public function testOverallNavigation() {
        // create a test user
        $user = $this->createUser();
        $this->visit('/')
            # Fill in the login form and submit
            ->type($user->name, 'username')
            ->type('12345', 'password')
            ->press('Sign in')
            # check if naavigated to dashboard
            ->seePageIs('/dashboard')
            # check if you find below details on the next page ('dashboard')
            ->see('Pathology Lab')
            ->see('List of reports')
            ->see('Reports')
            ->see('Patients')
            ->dontSee('Login')
            ->dontSee('Sign in')
            ->see('Create New Report')
            # click on Patient tab in the navbar and check if you see "Create New Patient"
            ->click('Patients')
            ->see("Date Of Birth")
            ->see("Create New Patient")
            # click on the "Create New Patient" button and check if you navigate to the create report page
            ->click("Create New Patient")
            ->seePageIs('/patient/create')
            ->see("Create New Patient")
            # check if you see the logout button and click on it to check if you are logged out
            ->see('Logout')
            ->press("Logout")
            ->seePageIs('/')
            ->see("Login")
            ->see("Username")
            ->see("Password")
            ->see("Sign in")
            ->dontSee('Pathology Lab');;
        $this->deleteUser($user);
    }

    

    /**
     * Check that dashboard is not accessible with out Login
     */
    public function testDashboardAccess() {
        $this->visit('/dashboard')->seePageIs('/login');
    }

    /**
     * Check that patient is not accessible with out Login
     */
    public function testPatienceAccess() {
        $this->visit('/patient')->seePageIs('/login');
    }
    
    
    
    private function createUser() {
        return factory(App\User::class)->create(["name" => "test","email" => "test@test.com","password" => "12345","is_operator" => '1']);
    }
    
    private function deleteUser($user){
        $user->delete();
    }
}
