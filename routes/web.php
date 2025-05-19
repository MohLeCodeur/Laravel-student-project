<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EtudiantController;
use Illuminate\Support\Facades\Auth;

// Rediriger vers le tableau de bord ou la page de connexion
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    // Routes pour la gestion des étudiants (CRUD)
    Route::resource('etudiants', EtudiantController::class);
});

require __DIR__.'/auth.php';
