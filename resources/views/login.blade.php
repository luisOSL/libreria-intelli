@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">Login</div>
            <div class="card-body">
                <form id="loginForm">
                    <input type="email" id="email" class="form-control mb-2" placeholder="Email" required>
                    <input type="password" id="password" class="form-control mb-3" placeholder="Password" required>
                    <button type="submit" class="btn btn-primary btn-block">Enter</button>
                </form>
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
            // Save the token!
            localStorage.setItem('jwt_token', response.token);
            window.location.href = '/dashboard'; // Redirect to your main app
        }).fail(function() {
            alert('Login failed. Check your credentials.');
        });
    });
</script>
@endpush