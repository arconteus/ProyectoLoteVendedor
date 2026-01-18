<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Proyecto Lote Vendedor')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    @vite('resources/js/app.js')
</head>
<body style="background-color: #181a1b; color: #e8e6e3;">
    <div class="container mt-5">
        @yield('content')
    </div>
</body>
</html>
