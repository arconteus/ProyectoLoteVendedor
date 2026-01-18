<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite('resources/js/app.js')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #181a1b;
            color: #e8e6e3;
        }
        .card, .container, .form-control, .btn {
            background-color: #23272f !important;
            color: #e8e6e3 !important;
            border-color: #444c56 !important;
        }
        .form-control::placeholder {
            color: #b2b2b2 !important;
        }
        a, .btn-link {
            color: #8ab4f8 !important;
        }
    </style>
</head>
<body>
    <div id="app">
        <Login />
    </div>
</body>
</html>
