<!-- resources/views/etudiants/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Détails de l'étudiant</h3>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="text-center mb-3">
                        <div style="width: 150px; height: 150px; margin: 0 auto; background-color: #e9ecef; display: flex; justify-content: center; align-items: center; border-radius: 50%;">
                            <i class="fas fa-user-graduate fa-4x text-primary"></i>
                        </div>
                    </div>
                    <div class="text-center">
                        <h4>{{ $etudiant->prenom }} {{ $etudiant->nom }}</h4>
                        <p class="text-muted">ID: {{ $etudiant->id }}</p>
                    </div>
                </div>
                <div class="col-md-8">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th style="width: 30%">Nom complet</th>
                                <td>{{ $etudiant->prenom }} {{ $etudiant->nom }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $etudiant->email }}</td>
                            </tr>
                            <tr>
                                <th>Date de naissance</th>
                                <td>{{ date('d/m/Y', strtotime($etudiant->date_naissance)) }}</td>
                            </tr>
                            <tr>
                                <th>Âge</th>
                                <td>{{ date_diff(date_create($etudiant->date_naissance), date_create('today'))->y }} ans</td>
                            </tr>
                            <tr>
                                <th>Adresse</th>
                                <td>{{ $etudiant->adresse }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('etudiants.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Retour à la liste
                </a>
                <div>
                    <a href="{{ route('etudiants.edit', $etudiant->id) }}" class="btn btn-primary me-2">
                        <i class="fas fa-edit me-1"></i> Modifier
                    </a>
                    <form action="{{ route('etudiants.destroy', $etudiant->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet étudiant?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash me-1"></i> Supprimer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
