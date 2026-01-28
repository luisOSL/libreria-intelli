$.ajaxSetup({
    headers: {
        'Authorization': 'Bearer ' + localStorage.getItem('jwt_token'),
        'Accept': 'application/json'
    }
});
$(function () {
    // Show logout button only if logged in
    if (localStorage.getItem('jwt_token')) {
        $('#sidebar').show();
    } else {
        $('#sidebar').hide();
    }


    $('#logoutBtn').on('click', function () {
        $.ajax({
            url: '/api/logout',
            type: 'POST',
            success: function (response) {
                alert('Ha salido del sistema');
            },
            error: function () {
                console.log('El Token ha expirado');
            },
            complete: function () {
                // Always clear local storage and redirect
                localStorage.removeItem('jwt_token');
                window.location.href = '/login';
            }
        });
    });
    
});
  // Fetch user info for the header
    if (localStorage.getItem('jwt_token')) {
        $.get('/api/user-profile', function(user) {
            $('#userNameDisplay').text(user.name);
        });
    }