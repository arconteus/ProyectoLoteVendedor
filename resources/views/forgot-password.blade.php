@extends('layouts.app')

@section('title', 'Olvidé mi Contraseña')

@section('content')
<div class="container" style="max-width: 400px;">
    <h2>¿Olvidaste tu contraseña?</h2>
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Correo electrónico</label>
            <input type="email" class="form-control" id="email" name="email" required autofocus>
        </div>
        <button type="submit" class="btn btn-primary">Enviar enlace de recuperación</button>
    </form>
</div>
@endsection
