<!-- resources/views/etudiants/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3>Liste des étudiants</h3>
            <div>
                <span class="badge-stats me-2">
                    <i class="fas fa-users me-1"></i> {{ $count }} étudiants inscrits
                </span>
                <a href="{{ route('etudiants.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus-circle me-1"></i> Ajouter un étudiant
                </a>
            </div>
        </div>

        <div class="card-body">
            <div class="mb-4">
                <form action="{{ route('etudiants.index') }}" method="GET" class="d-flex">
                    <input type="text" name="search" class="form-control me-2" placeholder="Rechercher un étudiant..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-outline-primary me-2">
                        <i class="fas fa-search"></i>
                    </button>
                    @if(request('search'))
                        <a href="{{ route('etudiants.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times"></i>
                        </a>
                    @endif
                </form>
            </div>

            @if(count($etudiants) > 0)
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Email</th>
                                <th>Date de naissance</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($etudiants as $etudiant)
                                <tr>
                                    <td>{{ $etudiant->id }}</td>
                                    <td>{{ $etudiant->nom }}</td>
                                    <td>{{ $etudiant->prenom }}</td>
                                    <td>{{ $etudiant->email }}</td>
                                    <td>{{ date('d/m/Y', strtotime($etudiant->date_naissance)) }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('etudiants.show', $etudiant->id) }}" class="btn btn-sm btn-info text-white me-1">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('etudiants.edit', $etudiant->id) }}" class="btn btn-sm btn-primary me-1">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('etudiants.destroy', $etudiant->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet étudiant?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="d-flex justify-content-center mt-4">
                    {{ $etudiants->links() }}
                </div>
            @else
                <div class="alert alert-info">
                    @if(request('search'))
                        Aucun étudiant ne correspond à votre recherche "{{ request('search') }}".
                    @else
                        Aucun étudiant n'est enregistré pour le moment.
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
