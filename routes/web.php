<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;
use App\Http\Controllers\TicketController;
use App\Http\Middleware\isAdmin;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canRegister' => Features::enabled(Features::registration()),
    ]);
})->name('home');





Route::middleware(['auth'])->group(function () {

    // Route::get('/tickets/create', [TicketController::class, 'create'])
    //     ->name('tickets.create');

    Route::post('/tickets', [TicketController::class, 'store']) /// criação de chamados
        ->name('tickets.store');

   
    Route::get('/tickets/user', [TicketController::class, 'create']) /// Vai para o formulario de chamados do usuario
        ->name('tickets.user');

    Route::get('/tickets/chamados', [TicketController::class, 'chamadosUser']) /// tela chamados user
        ->name('tickets.chamados');

   
});

/// ROTAS ADMIN 
Route::middleware(['auth', isAdmin::class])->group(function () {

    Route::get('dashboard', [TicketController::class, 'myTickets'])
        ->middleware(['auth', 'verified'])
        ->name('dashboard');

        
     Route::get('/tickets/index', [TicketController::class, 'index']) //// Pagina chamados ADM
        ->name('tickets.index');


    Route::put('/tickets/{ticket}/close', [TicketController::class, 'close']) //fechamento de chamados
        ->name('tickets.close');

    Route::post('/admin', [UserController::class, 'storeAdmin'])    // criação de usuarios ADM
        ->name('criar.admin');
});  


require __DIR__.'/settings.php';
