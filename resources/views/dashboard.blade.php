@extends('layouts.app')

@section('content')
<div class="bg-white shadow-xl rounded-lg overflow-hidden">
    <div class="px-6 py-5 border-b border-gray-200 bg-gray-50">
        <h3 class="text-2xl leading-6 font-semibold text-gray-900">
            <i class="fas fa-tachometer-alt fa-fw mr-2 text-indigo-500"></i>Tableau de bord
        </h3>
        <p class="mt-1 text-sm text-gray-500">Vue d'ensemble et actions rapides.</p>
    </div>

    <div class="p-6">
        @if (session('status'))
            <div class="mb-4 bg-green-50 border-l-4 border-green-400 p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-check-circle text-green-400"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-green-700">{{ session('status') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <div class="text-center mb-8 p-6 bg-indigo-50 rounded-lg">
            <h4 class="text-2xl font-semibold text-indigo-700">Bienvenue, {{ Auth::user()->name }}!</h4>
            <p class="text-gray-600">Vous êtes connecté en tant qu'administrateur.</p>
        </div>

        {{-- Nouvelles cartes de statistiques --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-blue-100 p-6 rounded-lg shadow hover:shadow-lg transition-shadow">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                        <i class="fas fa-users fa-2x text-white"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-blue-700 uppercase">Total Étudiants</p>
                        <p class="text-2xl font-bold text-blue-900">{{ $totalEtudiants }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-green-100 p-6 rounded-lg shadow hover:shadow-lg transition-shadow">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                        <i class="fas fa-user-clock fa-2x text-white"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-green-700 uppercase">Nouveaux (7 jours)</p>
                        <p class="text-2xl font-bold text-green-900">{{ $etudiantsRecents }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-yellow-100 p-6 rounded-lg shadow hover:shadow-lg transition-shadow">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-yellow-500 rounded-md p-3">
                        <i class="fas fa-birthday-cake fa-2x text-white"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-yellow-700 uppercase">Âge Moyen</p>
                        <p class="text-2xl font-bold text-yellow-900">{{ $ageMoyen }} ans</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 overflow-hidden">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-indigo-500 rounded-md p-3">
                            <i class="fas fa-list-alt fa-2x text-white"></i> {{-- Icône modifiée --}}
                        </div>
                        <div class="ml-4">
                            <h5 class="text-lg leading-6 font-medium text-gray-900">Gestion des étudiants</h5>
                            <p class="mt-1 text-sm text-gray-500">Gérez la liste des étudiants, ajoutez, modifiez ou supprimez des entrées.</p>
                        </div>
                    </div>
                    <div class="mt-6">
                        <a href="{{ route('etudiants.index') }}" class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Accéder <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 overflow-hidden">
                 <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                            <i class="fas fa-user-plus fa-2x text-white"></i>
                        </div>
                        <div class="ml-4">
                            <h5 class="text-lg leading-6 font-medium text-gray-900">Ajouter un étudiant</h5>
                            <p class="mt-1 text-sm text-gray-500">Ajoutez directement un nouvel étudiant dans la base de données.</p>
                        </div>
                    </div>
                    <div class="mt-6">
                        <a href="{{ route('etudiants.create') }}" class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            Ajouter <i class="fas fa-plus-circle ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection