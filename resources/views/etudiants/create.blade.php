@extends('layouts.app')

@section('content')
<div class="bg-white shadow-xl rounded-lg overflow-hidden">
    <div class="px-6 py-5 border-b border-gray-200 bg-gray-50">
        <h3 class="text-2xl leading-6 font-semibold text-gray-900">
            <i class="fas fa-user-plus fa-fw mr-2 text-green-500"></i>Ajouter un nouvel étudiant
        </h3>
        <p class="mt-1 text-sm text-gray-500">Remplissez les informations ci-dessous.</p>
    </div>

    <form action="{{ route('etudiants.store') }}" method="POST" class="p-6 space-y-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="nom" class="block text-sm font-medium text-gray-700">Nom</label>
                <input type="text" name="nom" id="nom" value="{{ old('nom') }}" required
                       class="mt-1 block w-full px-3 py-2 border @error('nom') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @error('nom') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="prenom" class="block text-sm font-medium text-gray-700">Prénom</label>
                <input type="text" name="prenom" id="prenom" value="{{ old('prenom') }}" required
                       class="mt-1 block w-full px-3 py-2 border @error('prenom') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @error('prenom') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required
                   class="mt-1 block w-full px-3 py-2 border @error('email') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            @error('email') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="date_naissance" class="block text-sm font-medium text-gray-700">Date de naissance</label>
            <input type="date" name="date_naissance" id="date_naissance" value="{{ old('date_naissance') }}" required
                   class="mt-1 block w-full px-3 py-2 border @error('date_naissance') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            @error('date_naissance') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="adresse" class="block text-sm font-medium text-gray-700">Adresse</label>
            <textarea name="adresse" id="adresse" rows="3" required
                      class="mt-1 block w-full px-3 py-2 border @error('adresse') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('adresse') }}</textarea>
            @error('adresse') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
        </div>

        <div class="pt-5">
            <div class="flex justify-end space-x-3">
                <a href="{{ route('etudiants.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <i class="fas fa-arrow-left mr-2"></i> Retour
                </a>
                <button type="submit" class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    <i class="fas fa-save mr-2"></i> Enregistrer
                </button>
            </div>
        </div>
    </form>
</div>
@endsection