@extends('layouts.app')

@section('content')
<div class="bg-white shadow-xl rounded-lg overflow-hidden">
    <div class="px-6 py-5 border-b border-gray-200 bg-gray-50 sm:flex sm:items-center sm:justify-between">
        <div>
            <h3 class="text-2xl leading-6 font-semibold text-gray-900">
                <i class="fas fa-users fa-fw mr-2 text-indigo-500"></i>Liste des étudiants
            </h3>
            <p class="mt-1 text-sm text-gray-500">Gérez les informations des étudiants inscrits.</p>
        </div>
        <div class="mt-3 sm:mt-0 sm:ml-4 flex items-center space-x-3">
             <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-indigo-100 text-indigo-700">
                <i class="fas fa-graduation-cap mr-2"></i> {{ $count }} étudiant(s)
            </span>
            {{-- Bouton Export PDF --}}
            <a href="{{ route('etudiants.export.pdf', ['search' => request('search'), 'sort_by' => $sortBy, 'sort_direction' => $sortDirection]) }}" 
               class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
               title="Télécharger la liste en PDF">
                <i class="fas fa-file-pdf mr-2"></i> Exporter PDF
            </a>
            <a href="{{ route('etudiants.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <i class="fas fa-plus-circle mr-2"></i> Ajouter
            </a>
        </div>
    </div>

    <div class="p-6">
        <form action="{{ route('etudiants.index') }}" method="GET" class="mb-6 flex items-center">
            {{-- Garder les paramètres de tri lors de la recherche --}}
            <input type="hidden" name="sort_by" value="{{ $sortBy }}">
            <input type="hidden" name="sort_direction" value="{{ $sortDirection }}">
            
            <input type="text" name="search" class="block w-full sm:w-1/2 px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Rechercher par nom, prénom, email..." value="{{ request('search') }}">
            <button type="submit" class="ml-3 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <i class="fas fa-search"></i>
            </button>
            @if(request('search'))
                <a href="{{ route('etudiants.index', ['sort_by' => $sortBy, 'sort_direction' => $sortDirection]) }}" class="ml-2 inline-flex items-center px-3 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" title="Effacer la recherche">
                    <i class="fas fa-times"></i>
                </a>
            @endif
        </form>

        @if($etudiants->count() > 0)
            <div class="align-middle inline-block min-w-full shadow overflow-x-auto sm:rounded-lg border-b border-gray-200">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            @php
                                // Helper function pour les liens de tri
                                function sortableLink($column, $label, $currentSortBy, $currentSortDirection, $request) {
                                    $newDirection = ($currentSortBy == $column && $currentSortDirection == 'asc') ? 'desc' : 'asc';
                                    $icon = '';
                                    if ($currentSortBy == $column) {
                                        $icon = $currentSortDirection == 'asc' ? '<i class="fas fa-sort-up ml-1"></i>' : '<i class="fas fa-sort-down ml-1"></i>';
                                    }
                                    $url = route('etudiants.index', array_merge($request->query(), ['sort_by' => $column, 'sort_direction' => $newDirection]));
                                    return '<a href="'.$url.'" class="group inline-flex items-center">'.$label. $icon . '</a>';
                                }
                            @endphp
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {!! sortableLink('id', 'ID', $sortBy, $sortDirection, request()) !!}
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {!! sortableLink('nom', 'Nom', $sortBy, $sortDirection, request()) !!}
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {!! sortableLink('prenom', 'Prénom', $sortBy, $sortDirection, request()) !!}
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {!! sortableLink('email', 'Email', $sortBy, $sortDirection, request()) !!}
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {!! sortableLink('date_naissance', 'Date de naissance', $sortBy, $sortDirection, request()) !!}
                            </th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($etudiants as $etudiant)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $etudiant->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $etudiant->nom }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $etudiant->prenom }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $etudiant->email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ \Carbon\Carbon::parse($etudiant->date_naissance)->isoFormat('DD/MM/YYYY') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                    <a href="{{ route('etudiants.show', $etudiant->id) }}" class="text-blue-600 hover:text-blue-900 transition-colors duration-150" title="Voir">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('etudiants.edit', $etudiant->id) }}" class="text-indigo-600 hover:text-indigo-900 transition-colors duration-150" title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('etudiants.destroy', $etudiant->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Êtes-vous sûr de vouloir mettre cet étudiant à la corbeille ?')"> {{-- Message modifié --}}
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 transition-colors duration-150" title="Mettre à la corbeille">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="mt-6">
                {{-- $etudiants->links() --}} {{-- Laravel >9 --}}
                {{ $etudiants->appends(request()->query())->links() }} {{-- Pour garder les params de tri/recherche --}}
            </div>
        @else
            <div class="bg-blue-50 border-l-4 border-blue-400 p-4 rounded-md shadow-md">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-info-circle text-blue-400"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-blue-700">
                            @if(request('search'))
                                Aucun étudiant ne correspond à votre recherche "{{ request('search') }}".
                            @else
                                Aucun étudiant n'est enregistré pour le moment. Commencez par en <a href="{{ route('etudiants.create') }}" class="font-medium underline hover:text-blue-800">ajouter un</a>.
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection