<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\DashboardController; // Si vous créez un contrôleur dédié
use Illuminate\Support\Facades\Auth;
use App\Models\Etudiant; // Pour les stats du dashboard
use Carbon\Carbon; // Pour les stats du dashboard

// Rediriger vers le tableau de bord ou la page de connexion
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        $totalEtudiants = Etudiant::count();
        $etudiantsRecents = Etudiant::where('created_at', '>=', Carbon::now()->subDays(7))->count();
        
        // Calcul de l'âge moyen (peut être coûteux sur de grandes BDD si fait en PHP)
        // Option 1: Calcul en PHP (plus simple pour commencer)
        $etudiantsTous = Etudiant::all(); // Récupère tous les étudiants (attention si très nombreux)
        $totalAge = 0;
        $etudiantsAvecAge = 0;
        if ($etudiantsTous->isNotEmpty()) {
            foreach ($etudiantsTous as $etudiant) {
                if ($etudiant->date_naissance) {
                    $totalAge += Carbon::parse($etudiant->date_naissance)->age;
                    $etudiantsAvecAge++;
                }
            }
        }
        $ageMoyen = ($etudiantsAvecAge > 0) ? round($totalAge / $etudiantsAvecAge, 1) : 'N/A';

        return view('dashboard', compact('totalEtudiants', 'etudiantsRecents', 'ageMoyen'));
    })->name('dashboard');
    
    // Routes pour la gestion des étudiants (CRUD)
    Route::get('etudiants/export/pdf', [EtudiantController::class, 'exportPDF'])->name('etudiants.export.pdf'); // << NOUVELLE ROUTE
    Route::resource('etudiants', EtudiantController::class);

    // Si vous ajoutez la gestion de la corbeille :
     Route::get('etudiants/trashed', [EtudiantController::class, 'trashed'])->name('etudiants.trashed');
     Route::post('etudiants/{id}/restore', [EtudiantController::class, 'restore'])->name('etudiants.restore');
     Route::delete('etudiants/{id}/force-delete', [EtudiantController::class, 'forceDelete'])->name('etudiants.forceDelete');
});

require __DIR__.'/auth.php';