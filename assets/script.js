function validateForm(event) {
    let errors = {
        book_name: '',
        book_author: '',
        book_publisher: '',
        ISBN: ''
    };
    console.log(errors,"errors");

    const bookName = document.getElementById('book_name').value;
    const bookAuthor = document.getElementById('book_autor').value;
    const bookPublisher = document.getElementById('book_publisher').value;
    const ISBN = document.getElementById('ISBN').value;

    if (bookName === "") {
        errors.book_name = "Book name is required.";
    }

    if (bookAuthor === "") {
        errors.book_author = "Book author is required.";
    }

    if (bookPublisher === "") {
        errors.book_publisher = "Book publisher is required.";
    }

    if (ISBN === "") {
        errors.ISBN = "ISBN is required.";
    } else if (!/^\d{6}$/.test(ISBN)) {
        errors.ISBN = "ISBN must be exactly 6 digits.";
    }

    document.getElementById('book_name_error').innerText = errors.book_name;
    document.getElementById('book_autor_error').innerText = errors.book_author;
    document.getElementById('book_publisher_error').innerText = errors.book_publisher;
    document.getElementById('ISBN_error').innerText = errors.ISBN;

    if (Object.values(errors).some(error => error !== '')) {
        event.preventDefault();
        return false;
    }
    return true;
}

function confirmDelete(id) {
    if (confirm('Are you sure you want to delete this book?')) {
        window.location.href = 'index.php?delete_id=' + id;
    }
}