<?php namespace App\Http\Controllers;

use App\Http\Controllers\Auth\GuardianAuth;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use App\Student;

class GuardianController extends Controller {

    /*
    |--------------------------------------------------------------------------
    | Admin Controller
    |--------------------------------------------------------------------------
    |
    | This controller renders the admin login page.
    | It authenticates administrative users
    | It renders the administrative dashboard on successful authentication.
    |
    */

    //Admin Login and Registration Trait

    use GuardianAuth;

    protected $redirectTo = '/';
    /**
     * Create a new authentication controller instance.
     *
     * @param  \Illuminate\Contracts\Auth\Guard  $auth
     * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;

        
        $this->middleware('guardian_auth', [
           'except' => ['register', 'login']
        ]);
        

    }
    /** 
     *  
     * 
     * @return school name
     */ 
    public function getChild(Request $request, Student $student) 
    {        
        $student->user;
        return response()->json(['child'=>$student], $this-> successStatus); 
    } 

}
