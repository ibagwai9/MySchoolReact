<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\RedirectResponse;

class StudentAuth {

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
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if ($this->auth->check()) {

            $user = $this->auth->user();

            //If the logged in user is a students continue with the request.
            if ($user->userable_type === "App\\Student") {
                return $next($request);
            }
            
            return new RedirectResponse(url('/'));
            
        }
        
        return new RedirectResponse(url('/student/login'));
        
    }

}
