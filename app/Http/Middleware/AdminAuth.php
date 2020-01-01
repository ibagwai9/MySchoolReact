<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

use Illuminate\Support\Facades\Auth;

class AdminAuth {

    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard =null)
    {

        if (Auth::guard($guard)->check()) {

            $user = Auth::guard($guard)->user();
            //If the logged in user is a admin continue with the request.
            if ($user->userable_type === "App\\Admin") {
                return $next($request);
            }
        }
         
        return response()->json(['error'=> 'unauthorized'], 401);
    }

}
