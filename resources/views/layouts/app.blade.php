<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Library Admin') }}</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="/css/style.css">

</head>
<body>

<div id="wrapper">
    <nav id="sidebar">
        <div class="sidebar-header">
            <img src="/images/logo.png" class="logo-img mr-2">
            <span class="font-weight-bold d-none d-md-inline">{{ config('app.name') }}</span>
        </div>

        <ul class="list-unstyled components">
            <li class="active">
                <a href="{{route('home')}}"><i class="fas fa-home mr-2"></i><span class="d-none d-md-inline ml-2"> Dashboard</span></a>
            </li>
            <li>
                <a href="#" data-toggle="modal" data-target="#authorModal"><i class="fas fa-user-edit mr-2"></i><span class="d-none d-md-inline ml-2"> Agregar Autor</span></a>
            </li>
            <li>
                <a href="#" data-toggle="modal" data-target="#bookModal"><i class="fas fa-book mr-3"></i><span class="d-none d-md-inline ml-2"> Agregar Libro</span></a>
            </li>
            <hr class="bg-secondary mx-3">
            <li>
                <a href="#" id="logoutBtn" class="text-warning"><i class="fas fa-sign-out-alt mr-2"></i><span class="d-none d-md-inline ml-2"> Salir</span></a>
            </li>
        </ul>
    </nav>

    <div id="content">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <h4 class="m-0 text-secondary">Manejo de Libros y Autores</h4>
                <div class="ml-auto d-flex align-items-center">
                    <span id="userNameDisplay" class="mr-3 text-muted small">Cargando Usuario...</span>
                    <div class="bg-primary rounded-circle text-white d-flex align-items-center justify-content-center" style="width:35px; height:35px;">
                        <i class="fas fa-user"></i>
                    </div>
                </div>
            </div>
        </nav>

        <div class="container-fluid">
            @yield('content')
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="/js/main.js"></script>

@stack('scripts')
</body>
</html>