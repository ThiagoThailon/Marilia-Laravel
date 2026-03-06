<?php

namespace App\Http\Responses;

use Illuminate\Http\Request;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     */
    public function toResponse($request)
    {
        $user = $request->user();

        // Verifica o papel/role do usuário conforme usado no frontend (role: 'admin' | 'user')
        $role = $user?->role ?? null;
        $isAdmin = $role === 'admin';

        $target = $isAdmin ? route('dashboard', absolute: false) : '/tickets/user';

        return redirect()->intended($target);
    }
}
