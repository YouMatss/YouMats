<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Laravel\Nova\Exceptions\AuthenticationException;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  Request  $request
     * @return string|null
     */
    protected function redirectTo($request, array $guards)
    {
        if (! $request->expectsJson()) {
            switch(current($guards)) {
                case 'vendor':
                    return route('vendor.login');
                default:
                    return route('login');
            }
        }
    }

    protected function unauthenticated($request, array $guards)
    {
        throw new AuthenticationException('Unauthenticated', $guards, $this->redirectTo($request, $guards));
    }
}
