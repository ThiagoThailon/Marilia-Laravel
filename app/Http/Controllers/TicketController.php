<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class TicketController extends Controller
{
    public function create()
    {
        return Inertia::render('tickets/Formulario');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'required|string',
        ]);

        Auth::user()->tickets()->create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => 'open',
        ]);

        // Por enquanto, volte para o create mesmo
        return redirect()->route('tickets.create');
            
    }
}
