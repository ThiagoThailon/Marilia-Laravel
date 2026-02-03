<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Models\Ticket;

class TicketController extends Controller
{

    public function index()
    {
        $tickets = Ticket::with('user')
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('tickets/Chamados', [
            'tickets' => $tickets
        ]);
    }

  


    // public function create()
    // {
    //     return Inertia::render('tickets/Formulario');
    // }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'required|string',
        ]);

        Auth::user()->tickets()->create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => 'Aberto',
        ]);

        
        return redirect()->route('dashboard');
    }

    public function close(Ticket $ticket)
    {
        $ticket->update([
            'status' => 'Fechado',
        ]);

        return redirect()->back();
    }

       
       
        

}
