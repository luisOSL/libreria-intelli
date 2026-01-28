@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center" style="min-height: 70vh;">
        <div class="col-md-6 text-center">
            <div class="error-template">
                <div class="mb-4">
                    <i class="fas fa-exclamation-triangle fa-7x text-warning"></i>
                </div>
                
                <h1 class="display-4 font-weight-bold text-dark">500</h1>
                <h2 class="mb-4 text-secondary">Error Interno del Servidor</h2>
                
                <p class="lead text-muted mb-5">
                    ¡Vaya! Algo salió mal de nuestro lado. Estamos trabajando para solucionarlo. 
                    Por favor, intenta recargar la página o vuelve más tarde.
                </p>

                <div class="error-actions">
                    <a href="{{ url('/dashboard') }}" class="btn btn-primary btn-lg shadow-sm">
                        <i class="fas fa-home mr-2"></i> Volver al Dashboard
                    </a>
                    <button onclick="location.reload()" class="btn btn-outline-secondary btn-lg ml-2">
                        <i class="fas fa-sync-alt mr-2"></i> Recargar
                    </button>
                </div>
                
                <div class="mt-5 pt-4 border-top">
                    <small class="text-muted">
                        Si el problema persiste, contacta al administrador del sistema. 
                        <br>Referencia: {{ now()->format('Y-m-d H:i:s') }}
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection