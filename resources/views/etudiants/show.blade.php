@extends('layouts.app')

@section('content')
<div class="bg-white shadow-xl rounded-lg overflow-hidden">
    <div class="px-6 py-5 border-b border-gray-200 bg-gray-50">
        <h3 class="text-2xl leading-6 font-semibold text-gray-900">
            <i class="fas fa-id-card fa-fw mr-2 text-indigo-500"></i>Détails de l'étudiant
        </h3>
        <p class="mt-1 text-sm text-gray-500">Informations complètes de {{ $etudiant->prenom }} {{ $etudiant->nom }}.</p>
    </div>

    <div class="p-6">
        <div class="md:flex md:space-x-8">
            <div class="md:w-1/3 text-center md:text-left mb-6 md:mb-0">
                <div class="w-32 h-32 rounded-full mx-auto md:mx-0 bg-indigo-100 flex items-center justify-center text-indigo-500 ring-4 ring-white shadow-lg">
                    <i class="fas fa-user-graduate fa-4x"></i>
                </div>
                <h4 class="mt-4 text-2xl font-bold text-gray-800">{{ $etudiant->prenom }} {{ $etudiant->nom }}</h4>
                <p class="text-sm text-gray-500">ID Étudiant: {{ $etudiant->id }}</p>
            </div>

            <div class="md:w-2/3">
                <dl class="divide-y divide-gray-200">
                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-gray-500">Nom complet</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $etudiant->prenom }} {{ $etudiant->nom }}</dd>
                    </div>
                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-gray-500">Email</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $etudiant->email }}</dd>
                    </div>
                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-gray-500">Date de naissance</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ \Carbon\Carbon::parse($etudiant->date_naissance)->isoFormat('LL') }}</dd>
                    </div>
                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-gray-500">Âge</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ \Carbon\Carbon::parse($etudiant->date_naissance)->age }} ans</dd>
                    </div>
                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-gray-500">Adresse</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $etudiant->adresse }}</dd>
                    </div>
                     <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-gray-500">Inscrit le</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ \Carbon\Carbon::parse($etudiant->created_at)->isoFormat('LLLL') }}</dd>
                    </div>
                </dl>
            </div>
        </div>

        <div class="mt-8 pt-6 border-t border-gray-200 flex flex-col sm:flex-row justify-between items-center space-y-3 sm:space-y-0 sm:space-x-3">
            <a href="{{ route('etudiants.index') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <i class="fas fa-arrow-left mr-2"></i> Retour à la liste
            </a>
            <div class="w-full sm:w-auto flex space-x-3">
                <a href="{{ route('etudiants.edit', $etudiant->id) }}" class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <i class="fas fa-edit mr-2"></i> Modifier
                </a>
                <form action="{{ route('etudiants.destroy', $etudiant->id) }}" method="POST" class="w-full sm:w-auto" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet étudiant ? Cette action est irréversible.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        <i class="fas fa-trash mr-2"></i> Supprimer
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection