<?php

namespace App\Http\Middleware;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Route;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            $isCustomer = (substr(Route::getFacadeRoot()->current()->uri(), 0, 9) == 'customer/') ? 'customer' : '';
            if($isCustomer == ''){
                return route('login'); 
            } else {
                return route('home'); 
            }
        }

    }

}

