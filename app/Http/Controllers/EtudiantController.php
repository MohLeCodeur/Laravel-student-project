<?php
// app/Http/Controllers/EtudiantController.php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Pour les requêtes aggrégées (si utilisées plus tard pour des stats avancées)
use Carbon\Carbon;                  // Pour la manipulation des dates
use Barryvdh\DomPDF\Facade\Pdf;     // Pour DomPDF

class EtudiantController extends Controller
{
    /**
     * Affiche la liste des étudiants
     */
    public function index(Request $request)
    {
        $query = Etudiant::query();
        
        // Fonctionnalité de recherche
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nom', 'like', "%{$search}%")
                  ->orWhere('prenom', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Fonctionnalité de tri
        $sortBy = $request->get('sort_by', 'id'); // Colonne de tri par défaut
        $sortDirection = $request->get('sort_direction', 'asc'); // Direction par défaut

        // Valider les colonnes de tri autorisées pour éviter les injections SQL sur orderBy
        $allowedSortBy = ['id', 'nom', 'prenom', 'email', 'date_naissance'];
        if (!in_array($sortBy, $allowedSortBy)) {
            $sortBy = 'id';
        }
        if (!in_array(strtolower($sortDirection), ['asc', 'desc'])) {
            $sortDirection = 'asc';
        }

        $query->orderBy($sortBy, $sortDirection);
        
        $etudiants = $query->paginate(10)->appends($request->except('page')); // appends pour garder les params de recherche/tri en pagination
        $count = Etudiant::count(); // Nombre total d'étudiants actifs
        
        return view('etudiants.index', compact('etudiants', 'count', 'sortBy', 'sortDirection'));
    }

    /**
     * Affiche le formulaire de création
     */
    public function create()
    {
        return view('etudiants.create');
    }

    /**
     * Enregistre un nouvel étudiant
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:etudiants',
            'adresse' => 'required|string',
            'date_naissance' => 'required|date',
        ]);

        Etudiant::create($validated);

        return redirect()->route('etudiants.index')
            ->with('success', 'Étudiant ajouté avec succès.');
    }

    /**
     * Affiche les détails d'un étudiant
     */
    public function show(Etudiant $etudiant)
    {
        return view('etudiants.show', compact('etudiant'));
    }

    /**
     * Affiche le formulaire d'édition
     */
    public function edit(Etudiant $etudiant)
    {
        return view('etudiants.edit', compact('etudiant'));
    }

    /**
     * Met à jour un étudiant
     */
    public function update(Request $request, Etudiant $etudiant)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:etudiants,email,'.$etudiant->id,
            'adresse' => 'required|string',
            'date_naissance' => 'required|date',
        ]);

        $etudiant->update($validated);

        return redirect()->route('etudiants.index')
            ->with('success', 'Informations de l\'étudiant mises à jour avec succès.');
    }

    /**
     * Supprime un étudiant (soft delete)
     */
    public function destroy(Etudiant $etudiant)
    {
        $etudiant->delete(); // Ceci va maintenant effectuer un soft delete

        return redirect()->route('etudiants.index')
            ->with('success', 'Étudiant mis à la corbeille avec succès.'); // Message modifié pour refléter le soft delete
    }

    /**
     * Exporte la liste des étudiants en PDF.
     */
    public function exportPDF(Request $request)
    {
        // Réutiliser la logique de recherche et de tri de la méthode index
        $query = Etudiant::query();
        
        if ($request->filled('search')) { // Utiliser filled() est plus propre
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nom', 'like', "%{$search}%")
                  ->orWhere('prenom', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $sortBy = $request->get('sort_by', 'id');
        $sortDirection = $request->get('sort_direction', 'asc');
        $allowedSortBy = ['id', 'nom', 'prenom', 'email', 'date_naissance', 'created_at']; // Ajout de created_at si besoin
        if (!in_array($sortBy, $allowedSortBy)) { $sortBy = 'id'; }
        if (!in_array(strtolower($sortDirection), ['asc', 'desc'])) { $sortDirection = 'asc'; }

        $etudiants = $query->orderBy($sortBy, $sortDirection)->get(); // get() pour tous les résultats pour le PDF

        // Passer les données à une vue spécifique pour le PDF
        $pdf = Pdf::loadView('etudiants.pdf', compact('etudiants', 'sortBy', 'sortDirection'));
        
        // Optionnel: définir l'orientation et le format du papier
        // $pdf->setPaper('a4', 'landscape');

        return $pdf->download('liste_etudiants_'.Carbon::now()->format('Y-m-d_H-i').'.pdf');
    }
    
    // --- FONCTIONNALITÉS OPTIONNELLES POUR LA CORBEILLE (SOFT DELETES) ---
    // Décommentez et créez les vues/routes si vous voulez gérer la corbeille explicitement.
    
    
    public function trashed(Request $request)
    {
        $query = Etudiant::onlyTrashed(); // Seulement les étudiants dans la corbeille
        
        // Optionnel: ajouter recherche et tri pour la corbeille également
        // ... (logique similaire à index() mais avec onlyTrashed())

        $sortBy = $request->get('sort_by', 'deleted_at'); // Trier par date de suppression par défaut
        $sortDirection = $request->get('sort_direction', 'desc');
        // ... (validation de sortBy et sortDirection)

        $etudiants = $query->orderBy($sortBy, $sortDirection)->paginate(10);
        $count = Etudiant::onlyTrashed()->count();
        
        return view('etudiants.trashed', compact('etudiants', 'count', 'sortBy', 'sortDirection'));
    }

    public function restore($id)
    {
        // FindOrFail ne fonctionne pas directement avec onlyTrashed() pour récupérer un modèle unique par ID.
        // Il faut spécifier qu'on cherche aussi dans les trashed.
        $etudiant = Etudiant::withTrashed()->find($id);

        if ($etudiant && $etudiant->trashed()) {
            $etudiant->restore();
            return redirect()->route('etudiants.index')->with('success', 'Étudiant restauré avec succès.');
        }
        return redirect()->route('etudiants.trashed')->with('error', 'Étudiant non trouvé dans la corbeille ou déjà restauré.');
    }

    public function forceDelete($id)
    {
        $etudiant = Etudiant::withTrashed()->find($id);

        if ($etudiant && $etudiant->trashed()) { // S'assurer qu'il est bien dans la corbeille avant de forcer la suppression
            $etudiant->forceDelete();
            return redirect()->route('etudiants.trashed')->with('success', 'Étudiant supprimé définitivement.');
        }
        return redirect()->route('etudiants.trashed')->with('error', 'Étudiant non trouvé dans la corbeille.');
    }
    
}