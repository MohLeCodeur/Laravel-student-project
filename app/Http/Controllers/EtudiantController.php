<?php
// app/Http/Controllers/EtudiantController.php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use Illuminate\Http\Request;

class EtudiantController extends Controller
{
    /**
     * Affiche la liste des étudiants
     */
    public function index(Request $request)
    {
        $query = Etudiant::query();
        
        // Fonctionnalité de recherche
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nom', 'like', "%{$search}%")
                  ->orWhere('prenom', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }
        
        $etudiants = $query->paginate(10);
        $count = Etudiant::count(); // Nombre total d'étudiants
        
        return view('etudiants.index', compact('etudiants', 'count'));
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
            ->with('success', 'Informations de l\'étudiant mises à jour avec succès');
    }

    /**
     * Supprime un étudiant
     */
    public function destroy(Etudiant $etudiant)
    {
        $etudiant->delete();

        return redirect()->route('etudiants.index')
            ->with('success', 'Étudiant supprimé avec succès');
    }
}
