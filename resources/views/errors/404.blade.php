@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center" style="min-height: 70vh;">
        <div class="col-md-6 text-center">
            <div class="error-template">
                <div class="mb-4">
                    <span class="fa-stack fa-4x">
                        <i class="fas fa-circle fa-stack-2x text-light"></i>
                        <i class="fas fa-search fa-stack-1x text-primary"></i>
                    </span>
                </div>
                
                <h1 class="display-1 font-weight-bold text-primary">404</h1>
                <h2 class="mb-3 text-dark font-weight-bold">Página No Encontrada</h2>
                
                <p class="lead text-muted mb-5">
                    Lo sentimos, la página que estás buscando no existe o ha sido movida. 
                    Verifica la URL o utiliza el botón de abajo para regresar a salvo.
                </p>

                <div class="error-actions">
                    <a href="{{ url('/dashboard') }}" class="btn btn-primary btn-lg px-5 shadow-sm">
                        <i class="fas fa-arrow-left mr-2"></i> Regresar al Dashboard
                    </a>
                </div>
                
                <div class="mt-5">
                    <p class="text-muted small">
                        ¿Crees que esto es un error? 
                        <a href="mailto:admin@tu-dominio.com" class="text-primary">Informa al soporte</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Estilo adicional para suavizar el fondo del icono stack */
    .text-light { color: #e9ecef !important; }
    .display-1 { font-size: 8rem; letter-spacing: -5px; }
</style>
@endsection