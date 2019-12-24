<?php namespace App\Http\Controllers;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Routing\Registrar;
use App\Http\Controllers\Auth\GuardianAuth;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use App\Guardian;
use App\Student;
use App\Session;
use Illuminate\Support\Facades\Auth;

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


    /**
     * Create a new authentication controller instance.
     *
     * @param  \Illuminate\Contracts\Auth\Guard  $auth
     * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
     * @return void
     */
    public function __construct(Guard $auth, Registrar $registrar)
    {
        $this->auth = $auth;
        $this->registrar = $registrar;

        $this->middleware('guardian_auth', [
            'except' => ['getIndex', 'getRegister', 'postLogin', 'postRegister', 'getLogout']
        ]);

    }

    /**
     * THis shows the currently logged in user's profile
     * @return string
     */
    public function getProfile()
    {
        $guardian = Auth::user()->userable;
        //$guardian->guardian->
        return view('pages.guardian.profile', compact('guardian'));
    }

 /**
     * This shows the details update form for guardians.
     * @return $this
     */
    public function getEditProfile(Guardian $guardian)
    {
       
        return view('pages.guardian.edit-profile', compact('guardian'));
    }

    /**
     * THis displays a Quick Result Page for this subjects.
     * @param $class
     * @param $subjects
     * @param $school
     * @param $classTerm
     * @return $this
     */
    public function getViewResult(Request $req, Student $student)
    {
        $session = Session::active();

        return view('pages.student.view-result')->with(array(
            'session' => $session,
            'student' => $student,
        ));
    }

    /**
     * This function handles profile update for this teacher.
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postEditProfile(Request $request)
    {

        $guardian_id = $request->input('guardian_id');

        $validator = Validator::make($request->except('guardian_id'), Guardian::$updateRules);

        if ($validator->fails())
            return redirect('/guardian/edit-profile/'.$guardian_id)
                ->withInput($request->all())
                ->withErrors($validator);

        $guardian = Guardian::find($guardian_id);
        $guardian->phone = $request->input('phone');
        $guardian->address = $request->input('address');

        if ($request->hasFile('profile_pix')) {
            $guardian->profile_pix = UploadImage::upload($request->file('profile_pix'), 'guardian_photo');
        }

        if ($guardian->save())
            return redirect('/guardian/profile');
    }

    /**
     * This functions returns the payment page.
     * @return string
     */
    public function getPayment(Request $request, Student $student)
    {
        return view('pages.student.payment', compact('student'));
    }
}
