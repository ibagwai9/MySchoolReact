<?php namespace App\Http\Controllers;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Routing\Registrar;
use App\Http\Controllers\Auth\StudentAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UploadImage;
use App\Student;
use App\Result;
use App\Session;

class StudentController extends Controller {

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

    use StudentAuth;

    /**
     * Create a new authentication controller instance.
     *
     * @param  \Illuminate\Contracts\Auth\Guard  $auth
     * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
     * @return void
     */
    public function __construct(Guard $auth)//, Registrar $registrar)
    {
        $this->auth = $auth; 
        //$this->registrar = $registrar;

        $this->middleware('student_auth', [
            'except' => ['getIndex', 'getRegister', 'postLogin', 'postRegister']
        ]);

    }

    /**
     * THis shows the currently logged in user's profile
     * @return string
     */
    public function getProfile()
    {
        $student = $this->auth->user();

        $student =Student::find($student->userable_id);
        return view('pages.student.profile')->with('student', $student);
    }

    /**
     * This shows the details update form for students.
     * @return $this
     */
    public function getEditProfile(Student $student)
    {
       
        return view('pages.student.edit-profile')->with('student', $student);
    }

    /**
     * THis displays a Quick Result Page for this subjects.
     * @param $class
     * @param $subjects
     * @param $school
     * @param $classTerm
     * @return $this
     */
    public function getViewResult()
    {
        $student = $this->auth->user();
        $student = Student::find($student->userable_id);
       
        $session = Session::active();

        return view('pages.student.view-result')->with(array(
            'session' => $session,
            'student' => $student,
        ));
    }

    /**
     * This functions returns the payment page.
     * @return string
     */
    public function getPayment(Request $request)
    {
        $student = Auth::user()->userable;
        
        return view('pages.student.payment', compact('student'));
    }

    /**
     * This function handles profile update for this teacher.
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postEditProfile(Request $request)
    {

        $student_id = $request->input('student_id');

        $validator = Validator::make($request->except('student_id'), Student::$updateRules);

        if ($validator->fails())
            return redirect('/student/edit-profile/'.$student_id)
                ->withInput($request->all())
                ->withErrors($validator);

        $student = Student::find($student_id);

        if ($request->hasFile('profile_pix')) {
            $student->profile_pix = UploadImage::upload($request->file('profile_pix'), 'student_photo');
        }

        if ($student->save())
            return redirect('/student/profile');
    }
}
