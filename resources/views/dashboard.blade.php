@extends('layouts.app')

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <div class="card bg-primary text-white shadow-sm">
            <div class="card-body d-flex align-items-center">
                <div class="mr-3">
                    <i class="fas fa-users fa-2x"></i>
                </div>
                <div>
                    <h6 class="card-title mb-0">Total Authors</h6>
                    <h2 class="font-weight-bold mb-0" id="totalAuthorsCount">0</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card bg-success text-white shadow-sm">
            <div class="card-body d-flex align-items-center">
                <div class="mr-3">
                    <i class="fas fa-book-open fa-2x"></i>
                </div>
                <div>
                    <h6 class="card-title mb-0">Total Books</h6>
                    <h2 class="font-weight-bold mb-0" id="totalBooksCount">0</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0 font-weight-bold">Authors</h5>
                <button class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#authorModal">
                    <i class="fas fa-plus"></i>
                </button>
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush" id="authorList">
                    </ul>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0 font-weight-bold">Books Inventory</h5>
                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#bookModal">
                    <i class="fas fa-plus-circle"></i> Add New Book
                </button>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th class="border-0">Book Title</th>
                                <th class="border-0">Author</th>
                                <th class="border-0 text-right">Actions</th>
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
                <h5 class="modal-title font-weight-bold">Add New Author</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="small font-weight-bold">Author Name</label>
                    <input type="text" id="newAuthorName" class="form-control" placeholder="Enter full name">
                </div>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="saveAuthor()">Save Author</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="bookModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold">Add New Book</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="bookForm">
                    <div class="form-group">
                        <label class="small font-weight-bold">Book Title</label>
                        <input type="text" id="book_title" class="form-control" placeholder="Title of the book">
                    </div>
                    <div class="form-group">
                        <label class="small font-weight-bold">Assign Author</label>
                        <select id="author_select" class="form-control">
                            <option value="">-- Choose an Author --</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" onclick="saveBook()">Register Book</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="/js/dashboard.js"></script>
@endpush