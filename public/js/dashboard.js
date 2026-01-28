$(function () {
    loadAuthors();
    loadBooks();
});



function loadAuthors() {
    $.get('/api/authors', function (data) {
        let list = '';
        let options = '<option value="">-- Select an Author --</option>';

        data.forEach(a => {
            // For the sidebar list
            list += `
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    ${a.name}
                    <div>
                        <span class="badge badge-primary badge-pill mr-2">${a.books_count} books</span>
                        <button class="btn btn-danger btn-sm" onclick="deleteAuthor(${a.id})"><i class="fas fa-trash-alt mr-2"></i>Delete</button>
                        <button class="btn btn-primary btn-sm" onclick="updateAuthor(${a.id})"><i class="fas fa-edit mr-2"></i>Edit</button>
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

function loadBooks() {
    $.get('/api/books', function (data) {
        let rows = '';
        data.forEach(b => {
            rows += `<tr>
                    <td>${b.title}</td>
                    <td>${b.author ? b.author.name : 'Unknown'}</td>
                    <td><button class="btn btn-danger btn-sm" onclick="deleteBook(${b.id})"><i class="fas fa-trash-alt mr-2"></i>Delete</button></td>
                </tr>`;
        });
        $('#bookTableBody').html(rows);
        $('#totalBooksCount').text(data.length);
        loadAuthors();
    });
}

function saveAuthor() {
    const name = $('#newAuthorName').val();
    $.post('/api/authors', {
        name: name
    }, function (data) {
        $('#authorModal').modal('hide');
        $('#author_name').val('');
        loadAuthors();
    });
}
function saveBook() {
    const title = $('#book_title').val();
    const author_id = $('#author_select').val();

    if (!title || !author_id) {
        alert("Please fill in all fields");
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
            loadBooks(); // Refresh the table
        },
        error: function (xhr) {
            alert("Error saving book: " + xhr.responseJSON.message);
        }
    });
}

function deleteBook(id) {
    if (confirm('Delete this book?')) {
        $.ajax({
            url: `/api/books/${id}`,
            type: 'DELETE',
            success: function () {
                loadBooks();
            }
        });
    }
}
function deleteAuthor(id) {
    if (confirm('Delete this Author?')) {
        $.ajax({
            url: `/api/authors/${id}`,
            type: 'DELETE',
            success: function () {
                loadAuthors();
                loadBooks();
            }
        });
    }
}

if (!localStorage.getItem('jwt_token')) {
    window.location.href = '/login';
}