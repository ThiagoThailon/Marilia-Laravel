<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;
use App\Http\Controllers\TicketController;
use App\Http\Middleware\isAdmin;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canRegister' => Features::enabled(Features::registration()),
    ]);
})->name('home');


Route::get('dashboard', [TicketController::class, 'myTickets'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');



Route::middleware(['auth'])->group(function () {
    Route::get('/tickets/create', [TicketController::class, 'create'])
        ->name('tickets.create');

    Route::post('/tickets', [TicketController::class, 'store'])
        ->name('tickets.store');

});


Route::middleware(['auth', isAdmin::class])->group(function () {

    Route::get('/tickets/index', [TicketController::class, 'index'])
        ->name('tickets.index');

    Route::put('/tickets/{ticket}/close', [TicketController::class, 'close'])
        ->name('tickets.close');
});  


require __DIR__.'/settings.php';
