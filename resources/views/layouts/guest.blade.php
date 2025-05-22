<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Gestion des Étudiants') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script> 
    <!-- The `forms` plugin provides base styling for form elements -->

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        /* Custom gradient or Tailwind classes can achieve this too */
        .auth-gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
    </style>

    <!-- Vite (if you properly set up Tailwind with Vite) -->
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
</head>
<body class="antialiased auth-gradient-bg">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div>
            <a href="/" class="flex items-center mb-6 text-3xl font-semibold text-white">
                <i class="fas fa-user-graduate fa-fw mr-2"></i>
                {{ config('app.name', 'ProjetStudent') }}
            </a>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-white shadow-xl overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
        <p class="mt-6 text-center text-sm text-gray-200">
            © {{ date('Y') }} {{ config('app.name', 'ProjetStudent') }}. Tous droits réservés.
        </p>
    </div>
</body>
</html>