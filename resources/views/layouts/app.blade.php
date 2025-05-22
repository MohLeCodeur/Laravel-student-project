<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Gestion Étudiants') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        /* For custom scrollbars, if desired */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        ::-webkit-scrollbar-thumb {
            background: #667eea; /* primary-500 */
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #5a67d8; /* primary-600 */
        }
    </style>

    <!-- Vite (if you properly set up Tailwind with Vite) -->
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
</head>
<body class="bg-gray-100 antialiased">
    <div id="app">
        <nav class="bg-white shadow-lg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <div class="flex items-center">
                        <a class="flex-shrink-0 flex items-center text-2xl font-bold text-indigo-600 hover:text-indigo-700" href="{{ url('/') }}">
                            <i class="fas fa-user-graduate fa-fw mr-2"></i>
                            {{ config('app.name', 'ProjetStudent') }}
                        </a>
                    </div>
                    <div class="hidden md:block">
                        <div class="ml-4 flex items-center md:ml-6">
                            <!-- Navigation Links for authenticated users -->
                            @auth
                                <a href="{{ route('dashboard') }}" class="px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('dashboard') ? 'bg-indigo-100 text-indigo-700' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-700' }}">Tableau de bord</a>
                                <a href="{{ route('etudiants.index') }}" class="ml-4 px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('etudiants.*') ? 'bg-indigo-100 text-indigo-700' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-700' }}">Étudiants</a>
                            @endauth

                            <!-- User Dropdown -->
                            @guest
                                @if (Route::has('login'))
                                    <a href="{{ route('login') }}" class="px-3 py-2 rounded-md text-sm font-medium text-gray-500 hover:bg-gray-50 hover:text-gray-700">
                                        <i class="fas fa-sign-in-alt mr-1"></i> Connexion
                                    </a>
                                @endif
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="ml-4 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        <i class="fas fa-user-plus mr-1"></i> Inscription
                                    </a>
                                @endif
                            @else
                                <div class="ml-3 relative" x-data="{ open: false }">
                                    <div>
                                        <button @click="open = !open" type="button" class="max-w-xs bg-gray-100 rounded-full flex items-center text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                            <span class="sr-only">Ouvrir menu utilisateur</span>
                                            <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-indigo-500 text-white font-semibold">
                                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                            </span>
                                        </button>
                                    </div>
                                    <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                                        <div class="px-4 py-3">
                                            <p class="text-sm text-gray-700">Connecté en tant que</p>
                                            <p class="text-sm font-medium text-gray-900 truncate">{{ Auth::user()->name }}</p>
                                        </div>
                                        <a href="{{ route('logout') }}"
                                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                           class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem" tabindex="-1" id="user-menu-item-2">
                                            <i class="fas fa-sign-out-alt fa-fw mr-2 text-gray-400"></i>Déconnexion
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            @endguest
                        </div>
                    </div>
                    <div class="-mr-2 flex md:hidden">
                        <!-- Mobile menu button -->
                        <button @click="mobileMenuOpen = !mobileMenuOpen" type="button" class="bg-white inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500" aria-controls="mobile-menu" aria-expanded="false">
                            <span class="sr-only">Ouvrir menu principal</span>
                            <i class="fas fa-bars" :class="{'hidden': mobileMenuOpen, 'block': !mobileMenuOpen }"></i>
                            <i class="fas fa-times" :class="{'hidden': !mobileMenuOpen, 'block': mobileMenuOpen }"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile menu, show/hide based on menu state. -->
            <div class="md:hidden" id="mobile-menu" x-show="mobileMenuOpen" @click.away="mobileMenuOpen = false">
                <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                    @auth
                        <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('dashboard') ? 'bg-indigo-100 text-indigo-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-800' }}">Tableau de bord</a>
                        <a href="{{ route('etudiants.index') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('etudiants.*') ? 'bg-indigo-100 text-indigo-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-800' }}">Étudiants</a>
                    @endauth
                </div>
                @guest
                    <div class="pt-4 pb-3 border-t border-gray-200">
                         @if (Route::has('login'))
                            <a href="{{ route('login') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:bg-gray-50 hover:text-gray-800">
                                <i class="fas fa-sign-in-alt mr-1"></i> Connexion
                            </a>
                        @endif
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:bg-gray-50 hover:text-gray-800">
                                <i class="fas fa-user-plus mr-1"></i> Inscription
                            </a>
                        @endif
                    </div>
                @else
                    <div class="pt-4 pb-3 border-t border-gray-200">
                        <div class="flex items-center px-5">
                            <div class="flex-shrink-0">
                                <span class="inline-flex items-center justify-center h-10 w-10 rounded-full bg-indigo-500 text-white font-semibold">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </span>
                            </div>
                            <div class="ml-3">
                                <div class="text-base font-medium text-gray-800">{{ Auth::user()->name }}</div>
                                <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
                            </div>
                        </div>
                        <div class="mt-3 px-2 space-y-1">
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();"
                               class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:bg-gray-50 hover:text-gray-800">
                                <i class="fas fa-sign-out-alt fa-fw mr-2 text-gray-400"></i>Déconnexion
                            </a>
                            <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                @endguest
            </div>
        </nav>

        <main class="py-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @if(session('success'))
                    <div class="mb-6 bg-green-50 border-l-4 border-green-400 p-4 rounded-md shadow-md">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-check-circle text-green-400"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-green-700">{{ session('success') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                @if(session('error'))
                     <div class="mb-6 bg-red-50 border-l-4 border-red-400 p-4 rounded-md shadow-md">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-times-circle text-red-400"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-red-700">{{ session('error') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
        
       
    </div>
    
    <!-- Alpine JS for dropdowns etc (lightweight JS framework) -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        // Simple Alpine data for mobile menu
        document.addEventListener('alpine:init', () => {
            Alpine.data('mobileMenuOpen', false);
        })
    </script>
</body>
</html>