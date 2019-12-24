<?php namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Validator;
use App\Guardian;
use App\User;

trait GuardianAuth {

    /**
     * Show the application welcome screen to the user.
     *
     * @return Response
     */
    public function getIndex()
    {
        return view('auth.guardian.login');
    }

    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * The registrar implementation.
     *
     * @var Registrar
     */
    protected $registrar;

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRegister()
    {
        return view('auth.guardian.register');
    }

    /**
     * Handle a registration phrequest for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postRegister(Request $request)
    {
        $user_collect =[];
        $guardian_collect = $request->except('password_confirmation','password');
        $user_collect['password'] = $request->password;

        $validator1 = Validator::make($guardian_collect, Guardian::$CreateRules);
        //$validator2 = Validator::make($user_collect, User::$CreateRules);
       /* $validFields =   array_merge($guardian_collect, $user_collect);
        $rules =   array_merge(Guardian::$CreateRules, User::$CreateRules);
        $validator =  Validator::make($validFields,$rules);
       */
        if ($validator1->fails() ){
            return redirect('/guardian/register/')
                ->withInput($request->all())
                ->withErrors($validator1);
        }


        $guardian = Guardian::create($guardian_collect);

        $user_collect['userable_type'] = 'App\\Guardian';
        $user_collect['userable_id'] = $guardian->id;
        $user_collect['username'] = $guardian->phone;
        $user = User::create($user_collect);
            
        
        if($guardian && $user){
            return redirect('/guardian/login');
        }else{
            $guardian->delete();
            $user->delete();
        }

        return redirect('/guardian/register/')
                ->withInput($request->all())
                ->withErrors($validator);
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|max:255', 'password' => 'required',
        ]);

        $credentials = $request->only('username', 'password');

        if ($this->auth->attempt($credentials, $request->has('remember')))
        {
            return redirect()->intended('/guardian');
        }

        return redirect('/guardian')
            ->withInput($request->only('username', 'remember'))
            ->withErrors([
                'username' => $this->getFailedLoginMessage(),
            ]);

    }

    /**
     * Get the failed login message.
     *
     * @return string
     */
    protected function getFailedLoginMessage()
    {
        return 'These credentials do not match our records.';
    }

    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogout()
    {
        $this->auth->logout();

        return redirect('/guardian');
    }

}