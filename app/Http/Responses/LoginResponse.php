<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Illuminate\Support\Facades\Auth;


class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $redirectTo = Auth::user()->is_admin
            ? route('dashboard')
            : route('landing');

        return $request->wantsJson()
            ? new JsonResponse(['redirectTo' => $redirectTo], 200)
            : redirect($redirectTo);
    }
}
