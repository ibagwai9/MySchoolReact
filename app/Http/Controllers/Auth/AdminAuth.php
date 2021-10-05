<?php namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\User; 
use App\Admin;
use App\Guardian;
use App\Http\Requests\LoginRequest;
use App\Student;
use App\Teacher;
use Illuminate\Support\Facades\Auth; 
use Validator;

trait AdminAuth {

    public $successStatus = 200;
    /** 
     * login api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function login(LoginRequest $req){ 
        if(Auth::attempt($req->only(['username','password']))){ 
            $user = Auth::user(); 
            $token =  $user->createToken('MyApp')-> accessToken; 
            $user->token = $token;
             
            $user->userable;
            return response()->json(['success' =>true,'data'=>['user'=>$user,'token'=>$token]], $this-> successStatus); 
        } 
        else{ 
            return response()->json(['error'=>'Unauthorised'], 401); 
        } 
    } 
    /** 
     * Register api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function register(Request $request) 
    { 
        // dd($request);
        $validator = Validator::make($request->all(), [ 
            'email' => 'required|email', 
            'password' => 'required', 
            'c_password' => 'required|same:password', 
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        $input = $request->all(); 
        $type = $request->type;
        switch ($type) {
            case 'Admin':
                $input['userable_type'] =  'App\Admin';
                if($profile = Admin::create($input)){
                    $input['userable_id'] = $profile->id;
                }
                break;
            case 'Parent':
                $input['userable_type'] =  'App\Guardian';
                if($profile = Guardian::create($input)){
                    $input['userable_id'] = $profile->id;
                }
                break;
            case 'Teacher':
                $input['userable_type'] =  'App\Teacher';
                if($profile = Teacher::create($input)){
                    $input['userable_id'] = $profile->id;
                }
                break;            
            default:
            $input['userable_type'] =  'App\Student';
            $input['student_reg'] = 'ST'.Student::where('id','>',1)->count();
            $input['username'] = 'ST'.Student::where('id','>',1)->count();

                if($profile = Student::create($input)){
                    $input['userable_id'] = $profile->id;
                }
                break;
        }
        $user = User::create($input); 
        $user['token'] =  $user->createToken('MyApp')-> accessToken; 
    return response()->json(['success'=>true,'user'=>$user], $this->successStatus); 
    }
    /** 
     * details api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function user() 
    { 
        $user = Auth::user(); 
        $user->userable;
        return response()->json(['user' => $user], $this-> successStatus); 
    } 

    /** 
     *  
     * 
     * @return Array(Users)
     */ 
    public function users() 
    { 
        $users = User::all()->map(function($user)
        {
            return $user->userable;
        }); 
        
        return response()->json(['users'=>$users], $this-> successStatus); 
    } 

    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        $this->auth->logout();

        return null;
    }

}