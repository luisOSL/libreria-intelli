$(function () {
    cargarAutores();
    cargarLibros();
});



function cargarAutores() {
    $.get('/api/authors', function (data) {
        let list = '';
        let options = '<option value="">-- Seleccione --</option>';

        data.forEach(a => {
            list += `
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    ${a.name}
                    <div>
                        <span class="badge badge-primary badge-pill mr-2">${a.books_count} <span class="d-none d-md-inline">libros</span></span>
                        <button class="btn btn-danger btn-sm" onclick="borrarAutor(${a.id})"><i class="fas fa-trash-alt"></i><span class="d-none d-lg-inline ml-2">Eliminar</span></button>
                        <button class="btn btn-primary btn-sm" onclick="actualizarAutor(${a.id})"><i class="fas fa-edit"></i><span class="d-none d-lg-inline ml-2">Editar</span></button>
                    </div>
                </li>`;
            // For the "Add Book" dropdown
            options += `<option value="${a.id}">${a.name}</option>`;
        });

        $('#authorList').html(list);
        $('#author_select').html(options);
        $('#totalAuthorsCount').text(data.length);
    });
}

function cargarLibros() {
    $.get('/api/books', function (data) {
        let rows = '';
        data.forEach(b => {
            rows += `<tr>
                    <td>${b.title}</td>
                    <td>${b.author ? b.author.name : 'Unknown'}</td>
                    <td class="text-right">
                    <button class="btn btn-danger btn-sm" onclick="borrarLibro(${b.id})"><i class="fas fa-trash-alt"></i><span class="d-none d-lg-inline ml-2">Eliminar</span></button>
                    <button class="btn btn-primary btn-sm" onclick="actualizarLibro(${b.id})"><i class="fas fa-edit"></i><span class="d-none d-lg-inline ml-2">Editar</span></button>
                    </td>
                </tr>`;
        });
        $('#bookTableBody').html(rows);
        $('#totalBooksCount').text(data.length);
        cargarAutores();
    });
}

function guardarAutor() {
    const name = $('#newAuthorName').val();
    $.post('/api/authors', {
        name: name
    }, function (data) {
        $('#authorModal').modal('hide');
        $('#author_name').val('');
        cargarAutores();
    });
}
function guardarLibro() {
    const title = $('#book_title').val();
    const author_id = $('#author_select').val();

    if (!title || !author_id) {
        alert("Debe llenar todos los campos");
        return;
    }

    $.ajax({
        url: '/api/books',
        type: 'POST',
        data: {
            title: title,
            author_id: author_id
        },
        success: function (response) {
            $('#bookModal').modal('hide'); // Close modal
            $('#book_title').val(''); // Clear input
            cargarLibros(); // Refresh the table
        },
        error: function (xhr) {
            alert("Error saving book: " + xhr.responseJSON.message);
        }
    });
}

function borrarLibro(id) {
    if (confirm('Delete this book?')) {
        $.ajax({
            url: `/api/books/${id}`,
            type: 'DELETE',
            success: function () {
                cargarLibros();
            }
        });
    }
}
function borrarAutor(id) {
    if (confirm('¿Desea eliminar este autor?')) {
        $.ajax({
            url: `/api/authors/${id}`,
            type: 'DELETE',
            success: function () {
                cargarAutores();
                cargarLibros();
            }
        });
    }
}

function actualizarAutor(id) {
    // Fetch the specific author data first
    $.get(`/api/authors/${id}`, function (author) {
        // Change Modal UI
        $('#authorModalLabel').text('Edit Author');
        $('#guardarAutorBtn').text('Update Author').removeClass('btn-primary').addClass('btn-warning');

        // Fill the fields
        $('#edit_author_id').val(author.id);
        $('#newAuthorName').val(author.name);

        // Show the modal
        $('#authorModal').modal('show');
    });
}

// 2. Logic to reset modal when opening for "New Author"
$('[data-target="#authorModal"]').on('click', function () {
    $('#authorModalLabel').text('Agergar Autor');
    $('#guardarAutorBtn').text('Guardar').removeClass('btn-warning').addClass('btn-primary');
    $('#edit_author_id').val(''); // Clear ID
    $('#newAuthorName').val('');  // Clear Input
});

// 3. The unified Submit Handler
function autorSubmit() {
    const id = $('#edit_author_id').val();
    const name = $('#newAuthorName').val();

    const isEdit = id !== "";
    const url = isEdit ? `/api/authors/${id}` : '/api/authors';
    const method = isEdit ? 'PUT' : 'POST';

    $.ajax({
        url: url,
        type: method,
        data: { name: name },
        success: function (response) {
            $('#authorModal').modal('hide');
            cargarAutores(); // Refresh lists and counts
            alert(isEdit ? 'Autor actualizado!' : 'Autor creado!');
        },
        error: function (xhr) {
            alert('Error: ' + xhr.responseJSON.message);
        }
    });
}

// 1. Function to prepare the modal for editing
function actualizarLibro(id) {
    $.get(`/api/books/${id}`, function (book) {
        // Change Modal UI for Update mode
        $('#bookModalLabel').text('Detalles del Libro');
        $('#guardarLibroBtn').text('Update Book').removeClass('btn-success').addClass('btn-info');

        // Fill the fields
        $('#edit_book_id').val(book.id);
        $('#book_title').val(book.title);
        $('#author_select').val(book.author_id); // This selects the correct author in the dropdown

        // Show the modal
        $('#bookModal').modal('show');
    });
}

// 2. Logic to reset modal when clicking "Add New Book" button
$('[data-target="#bookModal"]').on('click', function () {
    $('#bookModalLabel').text('Agregar Libro');
    $('#guardarLibroBtn').text('Guardar').removeClass('btn-info').addClass('btn-success');
    $('#edit_book_id').val('');
    $('#book_title').val('');
    $('#author_select').val('');
});

// 3. Unified Submit Handler for Books
function libroSubmit() {
    const id = $('#edit_book_id').val();
    const payload = {
        title: $('#book_title').val(),
        author_id: $('#author_select').val()
    };

    const isEdit = id !== "";
    const url = isEdit ? `/api/books/${id}` : '/api/books';
    const method = isEdit ? 'PUT' : 'POST';

    $.ajax({
        url: url,
        type: method,
        data: payload,
        success: function (response) {
            $('#bookModal').modal('hide');
            cargarLibros(); // Refresh table and count
            cargarAutores(); // Refresh author book counts
            alert(isEdit ? 'Libro actualizado!' : 'Libro creado!');
        },
        error: function (xhr) {
            alert('Error: ' + xhr.responseJSON.message);
        }
    });
}
if (!localStorage.getItem('jwt_token')) {
    window.location.href = '/login';
}