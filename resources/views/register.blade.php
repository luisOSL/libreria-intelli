@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card">
            <div class="card-header text-center">
                <h4>Create Account</h4>
            </div>
            <div class="card-body">
                <form id="registerForm">
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" id="reg_name" class="form-control" placeholder="Enter name" required>
                    </div>

                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" id="reg_email" class="form-control" placeholder="Enter email" required>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" id="reg_password" class="form-control" placeholder="Min. 6 characters" required>
                    </div>

                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" id="reg_password_confirmation" class="form-control" placeholder="Repeat password" required>
                    </div>

                    <button type="submit" class="btn btn-success btn-block">Register</button>
                </form>
                
                <div class="mt-3 text-center">
                    <small>Already have an account? <a href="/login">Login here</a></small>
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

        // Basic check for password matching before sending to API
        if ($('#reg_password').val() !== $('#reg_password_confirmation').val()) {
            alert('Passwords do not match!');
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
                // The API returns the token on successful registration
                localStorage.setItem('jwt_token', response.token);
                alert('Account created successfully!');
                window.location.href = '/dashboard';
            },
            error: function(xhr) {
                // Show validation errors from Laravel
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