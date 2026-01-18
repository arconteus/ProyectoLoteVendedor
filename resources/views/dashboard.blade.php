<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            background-color: #181a1b !important;
            color: #e8e6e3 !important;
        }
        .container{
            background-color: #181a1b !important;
            color: #e8e6e3 !important;
        } 
        .card, .form-control, .btn {
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
    <div id="dashboard-app" class="container d-flex justify-content-center align-items-start min-vh-100 py-5">
        <div class="card shadow-lg w-100" style="max-width: 700px; background-color: #23272f;">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h1 class="h3 mb-1">Bienvenido al Dashboard</h1>
                        <p class="mb-0 text-secondary">Has iniciado sesión correctamente.</p>
                    </div>
                    <logout-button />
                </div>
                <hr style="border-color: #444c56;">
                <lotes-list />
            </div>
        </div>
    </div>
    @vite('resources/js/app.js')
</body>
</html>
