<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Inertia\Inertia;

class TicketController extends Controller
{
    public function index()
    {
       return Inertia::render('Tickets/Index', [
        'tickets' => Auth::user()->tickets
    ]);

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

        return redirect()->route('tickets.index');
    }
}
