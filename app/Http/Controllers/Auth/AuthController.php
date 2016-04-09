<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Http\Requests\LoginRequest;

class AuthController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Registration & Login Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles the registration of new users, as well as the
      | authentication of existing users. By default, this controller uses
      | a simple trait to add these behaviors. Why don't you explore it?
      |
     */

use AuthenticatesAndRegistersUsers,
    ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = 'dashboard';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        return Validator::make($data, [
                'name'     => 'required|max:255',
                'email'    => 'required|email|max:255|unique:users',
                'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data) {
        return User::create([
                'name'     => $data['name'],
                'email'    => $data['email'],
                'password' => bcrypt($data['password']),
        ]);
    }

    /**
     * Show Login form
     * 
     * @return View
     */
    public function index() {
        $title = "Login";
        return view('auth.login', compact("title"));
    }

    /**
     * Check the LoginRequest Class under App/Http/Request to check 
     * the validation rules for this form. The request reaches
     * this method only after a successfull validation
     * 
     * @param LoginRequest $request 
     * @return View 
     */
    public function login(LoginRequest $request) {
        
        # retrieve user Info from the request
        $validation['name'] = $request->input('username');
        $validation['password'] = $request->input('password');
        
        # attempt Login
        if (Auth::attempt($validation)) {
            # redirect to the dashboard after successfull login
            return redirect()->route('dashboard');
        }
        else {
            
            # else go back to the login page with error information
            return redirect()->back()
                ->withInput($request->except('password'))
                ->with("login_message","Invalid Username or Password");
        }
    }

    /**
     * 
     */
    public function logout() {
        // remove all the session variables
        // destroy the session
        Auth::logout();
        return redirect()->route("home");
    }

}
