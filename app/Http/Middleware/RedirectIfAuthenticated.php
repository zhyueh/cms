<?php

namespace App\Http\Middleware;

use Closure;
use Log;
use Illuminate\Contracts\Auth\Guard;

class RedirectIfAuthenticated
{
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
        Log::info($request->path());
        if ($request->path() == "/")
        {

        }
        else if ($request->is("auth/*"))
        {

        }
        else if ( (!$request->is("index*")) && !$this->auth->check()) {
            return redirect('/auth/login');
        }

        return $next($request);
    }
}
