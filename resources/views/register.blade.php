@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card">
            <div class="card-header text-center">
                <h4>Crear Usuario</h4>
            </div>
            <div class="card-body">
                <form id="registerForm">
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" id="reg_name" class="form-control" placeholder="Nombre completo" required>
                    </div>

                    <div class="form-group">
                        <label>Correo Electrónico</label>
                        <input type="email" id="reg_email" class="form-control" placeholder="Correo Electrónico" required>
                    </div>

                    <div class="form-group">
                        <label>Contraseña</label>
                        <input type="password" id="reg_password" class="form-control" placeholder="Min. 6 caracteres" required>
                    </div>

                    <div class="form-group">
                        <label>Confirmar Contraseña</label>
                        <input type="password" id="reg_password_confirmation" class="form-control" placeholder="Repetir Contraseña" required>
                    </div>

                    <button type="submit" class="btn btn-success btn-block">Registrar</button>
                </form>
                
                <div class="mt-3 text-center">
                    <small>¿Ya tiene una cuenta? <a href="/login">Entre aquí</a></small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $('#registerForm').on('submit', function(e) {
        e.preventDefault();

        if ($('#reg_password').val() !== $('#reg_password_confirmation').val()) {
            alert('Verifique su Contraseña!');
            return;
        }

        const payload = {
            name: $('#reg_name').val(),
            email: $('#reg_email').val(),
            password: $('#reg_password').val(),
            password_confirmation: $('#reg_password_confirmation').val()
        };

        $.ajax({
            url: '/api/register',
            type: 'POST',
            data: payload,
            success: function(response) {
                localStorage.setItem('jwt_token', response.token);
                alert('Su cuenta ha sido creada !');
                window.location.href = '/dashboard';
            },
            error: function(xhr) {
                let errors = xhr.responseJSON;
                let errorMsg = 'Error:\n';
                $.each(errors, function(key, value) {
                    errorMsg += value + '\n';
                });
                alert(errorMsg);
            }
        });
    });
</script>
@endpush