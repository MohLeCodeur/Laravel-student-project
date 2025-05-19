<!-- resources/views/dashboard.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Tableau de bord</h3>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="text-center mb-4">
                        <h4>Bienvenue, {{ Auth::user()->name }}!</h4>
                        <p>Vous êtes connecté en tant qu'administrateur.</p>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="card bg-light">
                                <div class="card-body text-center">
                                    <i class="fas fa-users fa-3x text-primary mb-3"></i>
                                    <h5 class="card-title">Gestion des étudiants</h5>
                                    <p class="card-text">Gérez la liste des étudiants, ajoutez, modifiez ou supprimez des entrées.</p>
                                    <a href="{{ route('etudiants.index') }}" class="btn btn-primary">Accéder</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="card bg-light">
                                <div class="card-body text-center">
                                    <i class="fas fa-user-plus fa-3x text-danger mb-3"></i>
                                    <h5 class="card-title">Ajouter un étudiant</h5>
                                    <p class="card-text">Ajoutez directement un nouvel étudiant dans la base de données.</p>
                                    <a href="{{ route('etudiants.create') }}" class="btn btn-danger">Ajouter</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
