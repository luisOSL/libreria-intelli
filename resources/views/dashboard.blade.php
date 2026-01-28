@extends('layouts.app')

@section('content')
<div class="row mb-4">
    <div class="col-md-6 pt-1">
        <div class="card bg-primary text-white shadow-sm">
            <div class="card-body d-flex align-items-center">
                <div class="mr-3">
                    <i class="fas fa-users fa-2x"></i>
                </div>
                <div>
                    <h6 class="card-title mb-0">Autores</h6>
                    <h2 class="font-weight-bold mb-0" id="totalAuthorsCount">0</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 pt-1">
        <div class="card bg-success text-white shadow-sm">
            <div class="card-body d-flex align-items-center">
                <div class="mr-3">
                    <i class="fas fa-book-open fa-2x"></i>
                </div>
                <div>
                    <h6 class="card-title mb-0">Libros</h6>
                    <h2 class="font-weight-bold mb-0" id="totalBooksCount">0</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 text-center">
        <a href="/api/export-library?token=" id="exportLink" class="btn btn-success shadow-sm">
            <i class="fas fa-file-excel mr-2"></i> Exportar a Excel
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-4 col-md-12 pt-2">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0 font-weight-bold">Autores</h5>
                <button class="btn btn-light btn-sm" data-toggle="modal" data-target="#authorModal">
                    <i class="fas fa-plus"></i>
                </button>
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush" id="authorList">
                </ul>
            </div>
        </div>
    </div>

    <div class="col-lg-8 col-md-12 pt-2">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0 font-weight-bold">Inventario de Libros</h5>
                <button class="btn btn-light btn-sm" data-toggle="modal" data-target="#bookModal">
                    <i class="fas fa-plus"></i>
                </button>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th class="border-0">Título</th>
                                <th class="border-0">Autor</th>
                                <th class="border-0 text-right">Operaciones</th>
                            </tr>
                        </thead>
                        <tbody id="bookTableBody">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="authorModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold" id="authorModalLabel">Agregar Autor</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="edit_author_id">

                <div class="form-group">
                    <label class="small font-weight-bold">Nombre del Autor</label>
                    <input type="text" id="newAuthorName" class="form-control" placeholder="Nombre completo">
                </div>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="guardarAutorBtn" onclick="autorSubmit()">Guardar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="bookModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold" id="bookModalLabel">Agregar Libro</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="edit_book_id">

                <form id="bookForm">
                    <div class="form-group">
                        <label class="small font-weight-bold">Título</label>
                        <input type="text" id="book_title" class="form-control" placeholder="Título del libro">
                    </div>
                    <div class="form-group">
                        <label class="small font-weight-bold">Autor</label>
                        <select id="author_select" class="form-control">
                            <option value="">-- Seleccione --</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-success" id="guardarLibroBtn" onclick="libroSubmit()">Guardar</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="/js/dashboard.js"></script>
@endpush