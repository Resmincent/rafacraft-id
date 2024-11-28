<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;
use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;
use Illuminate\Support\Facades\Auth;

class RegisterResponse implements RegisterResponseContract
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
