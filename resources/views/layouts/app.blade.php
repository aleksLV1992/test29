<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - {{ config('app.name', 'Автосалон') }}</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Необязательно: кастомные стили -->
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<!-- Навигация -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            {{ config('app.name', 'Автосалон') }}
        </a>
        <div class="navbar-nav ms-auto">
            @auth
                <span class="navbar-text me-3">Привет, {{ auth()->user()->name }}!</span>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-light btn-sm">Выйти</button>
                </form>
            @else
                <a class="nav-link" href="{{ route('login') }}">Войти</a>
            @endauth
        </div>
    </div>
</nav>

<!-- Основное содержимое -->
<div class="container">
    @yield('content')
</div>

<!-- Bootstrap JS (опционально, если нужен dropdown и т.п.) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
