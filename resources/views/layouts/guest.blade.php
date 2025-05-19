<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Gestion des étudiants') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- Styles personnalisés -->
        <style>
            :root {
                --primary-blue: #0d6efd;
                --primary-red: #dc3545;
                --dark-blue: #0a4fb5;
                --light-blue: #e6efff;
                --dark-red: #a71d2a;
                --light-red: #ffe6e6;
            }
            
            body {
                font-family: 'Figtree', sans-serif;
                background: linear-gradient(135deg, var(--light-blue), var(--light-red));
                min-height: 100vh;
                display: flex;
                align-items: center;
            }
            
            .auth-card {
                background-color: white;
                border-radius: 1rem;
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
                overflow: hidden;
                max-width: 450px;
                width: 100%;
                margin: 0 auto;
            }
            
            .auth-header {
                background: linear-gradient(90deg, var(--primary-blue), var(--primary-red));
                color: white;
                padding: 1.5rem;
                text-align: center;
            }
            
            .auth-body {
                padding: 2rem;
            }
            
            .btn-primary {
                background: linear-gradient(90deg, var(--primary-blue), var(--dark-blue));
                border: none;
                transition: all 0.3s ease;
            }
            
            .btn-primary:hover {
                background: linear-gradient(90deg, var(--dark-blue), var(--primary-blue));
                transform: translateY(-2px);
                box-shadow: 0 5px 15px rgba(10, 79, 181, 0.3);
            }
            
            .btn-danger {
                background: linear-gradient(90deg, var(--primary-red), var(--dark-red));
                border: none;
                transition: all 0.3s ease;
            }
            
            .btn-danger:hover {
                background: linear-gradient(90deg, var(--dark-red), var(--primary-red));
                transform: translateY(-2px);
                box-shadow: 0 5px 15px rgba(167, 29, 42, 0.3);
            }
            
            .form-control:focus {
                border-color: var(--primary-blue);
                box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
            }
        </style>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div class="container">
            {{ $slot }}
        </div>

        <!-- Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
