<!DOCTYPE html>
<html lang="en">
<head>
    <title>PT Mentol Library</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> 
</head>
    <body>
        <div class="container">
            @yield('content')
        </div>
    </body>
    
    <script>
        $(document).ready(function () {    
        $('#new-book').click(function () {
            $('#btn-save').val("create-book");
            $('#book').trigger("reset");
            $('#bookCrudModal').html("Add New Book");
            $('#crud-modal').modal('show');
    });
        $('body').on('click', '#edit-book', function () {
            var book_id = $(this).data('id');
            $.get('books/'+book_id+'/edit', function (data) {
                $('#bookCrudModal').html("Edit Book");
                $('#btn-update').val("Update");
                $('#btn-save').prop('disabled',false);
                $('#crud-modal').modal('show');
                $('#book_id').val(data.id);
                $('#title').val(data.title);
                $('#author').val(data.author);
                $('#pages').val(data.pages);
                $('#year').val(data.year);
            })
    });
        $('body').on('click', '#show-book', function () {
            $('#bookCrudModal-show').html("Book Details");
            $('#crud-modal-show').modal('show');
        });
        $('body').on('click', '#delete-book', function () {
            var book_id = $(this).data("id");
            var token = $("meta[name='csrf-token']").attr("content");
            confirm("Do you want to delete this entry?");
    
            $.ajax({
                type: "DELETE",
                url: "http://localhost/librarymidproject/public/books/"+book_id,
                data: {
                    "id": book_id,
                    "_token": token,
                },
            success: function (data) {
                $('#msg').html('book entry deleted successfully');
                $("#book_id_" + book_id).remove();
            },
            error: function (data) {
                console.log('Error:', data);
            }
            });
        });
    });
    </script>
</html>