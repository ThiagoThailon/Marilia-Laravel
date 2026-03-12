<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;


class UserController extends Controller
{
    
    

    public function storeAdmin(Request $request)
    {
    
        
        $validated = $request->validate([
            'name'     => 'required|string|max:40',
            'email'    => 'required|email:rfc,dns|unique:users,email',
            'password' => 'required|string|min:8|confirmed', 
        ]);

        
        
        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role'     => 'admin',
        ]);

        return redirect()
            ->back()
            ->with('success', 'Administrador criado com sucesso!');
    }

    public function create()
    {

     return Inertia::render('PaginaAdm');
    }


    
    
}