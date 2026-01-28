@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">Acceso al sistema</div>
            <div class="card-body">
                <form id="loginForm">
                    <input type="email" id="email" class="form-control mb-2" placeholder="Email" required>
                    <input type="password" id="password" class="form-control mb-3" placeholder="Contraseña" required>
                    <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
                </form>
                <div class="mt-3 text-center">
                    <small>¿No tiene una cuenta? <a href="{{route('register')}}">Regístrese aquí</a></small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $('#loginForm').on('submit', function(e) {
        e.preventDefault();
        $.post('/api/login', {
            email: $('#email').val(),
            password: $('#password').val()
        }, function(response) {
            localStorage.setItem('jwt_token', response.token);
            window.location.href = '/dashboard';
        }).fail(function() {
            alert('Error en Credenciales');
        });
    });
</script>
@endpush