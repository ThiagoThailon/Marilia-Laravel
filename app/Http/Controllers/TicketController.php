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
    
      
        public function myTickets()
        {
           $user = Auth::user();

        // 1. Inicializamos as variáveis com zero por padrão
        $totalTickets = 0;
        $openTickets = 0;
        $closedTickets = 0;

        
       
        $totalTickets = Ticket::count();
        $openTickets = Ticket::where('status', 'Aberto')->count();
        $closedTickets = Ticket::where('status', 'Fechado')->count();
        

        // 3. Buscamos os tickets do usuário (como você já fazia)
        $tickets = Ticket::with('user')
            ->where('user_id', $user->id)
            ->latest()
            ->paginate(5);

        // 4. Retornamos tudo em um único Inertia::render
        return Inertia::render('Dashboard', [
            'tickets' => $tickets,
            'filters' => [
                'mine' => true,
            ],
            // Enviamos as quantidades junto com o resto dos dados!
            'totalTickets' => $totalTickets,
            'openTickets' => $openTickets,
            'closedTickets' => $closedTickets,
        ]);
        }


    public function create()
    {
        return Inertia::render('tickets/CriarChamadosUser');
    }
    public function createChamados()
    {
        return Inertia::render('tickets/Chamados');
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
           
        ]);

        
        return redirect()->route('tickets.user');
    }

    public function close(Ticket $ticket)
    {
        $ticket->update([
            'status' => 'Fechado',
        ]);

        return redirect()->back();
    }

    public function chamadosUser()
    {
        $tickets = Ticket::with('user')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return Inertia::render('tickets/ChamadoUser', [
            'tickets' => $tickets
        ]);
    }
       
   

}
