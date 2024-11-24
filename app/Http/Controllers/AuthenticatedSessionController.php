<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController as BaseController;

class AuthenticatedSessionController extends BaseController
{
    /**
     * Handle authenticated redirection.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        // Cek nilai is_admin
        if ($user->is_admin === true) {
            return redirect()->intended(route('dashboard'));
        }

        return redirect()->intended(route('landing'));
    }
}
