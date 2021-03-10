@extends('books.layout')

@section('content')

<div class="row">
    <div class="col-lg-12" style="text-align: center">
        <div >
            <h2>PT Mentol Library</h2>
        </div>
        <br/>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-right">
            <a href="javascript:void(0)" class="btn btn-success mb-2" id="new-book" data-toggle="modal">New Book</a>
        </div>
    </div>
</div>
<br/>
    @if ($message = Session::get('success'))

<div class="alert alert-success">
    <p id="msg">{{ $message }}</p>
</div>
@endif

    <table class="table table-bordered">
        <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Author</th>
        <th>Pages</th>
        <th>Year Created</th>
        <th width="280px">Action</th>
    </tr>

@foreach ($books as $book)
    <tr {{ $book->id }}>
    <td>{{ $book->id }}</td>
    <td>{{ $book->title }}</td>
    <td>{{ $book->author }}</td>
    <td>{{ $book->pages }}</td>
    <td>{{ $book->year }}</td>
    <td>

<form action="{{ route('books.destroy',$book->id) }}" method="POST">
    <a class="btn btn-info" id="show-book" data-toggle="modal" data-id="{{ $book->id }}" >Show</a>
    <a href="javascript:void(0)" class="btn btn-success" id="edit-book" data-toggle="modal" data-id="{{ $book->id }}">Edit </a>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <a id="delete-book" data-id="{{ $book->id }}" class="btn btn-danger delete-user">Delete</a></td>
</form>
</td>
</tr>
@endforeach

</table>
    {!! $books->links() !!}

<div class="modal fade" id="crud-modal" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="bookCrudModal"></h4>
            </div>
        <div class="modal-body">
            <form name="bookForm" action="{{ route('books.store') }}" method="POST">
            <input type="hidden" name="book_id" id="book_id" >
        @csrf
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Title:</strong>
                        <input type="text" name="title" id="title" class="form-control" placeholder="Title">
                    </div>
                </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Author:</strong>
                        <input type="text" name="author" id="author" class="form-control" placeholder="Author">
                    </div>
                </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Pages:</strong>
                    <input type="text" name="pages" id="pages" class="form-control" placeholder="Pages">
                    </div>
                </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Year:</strong>
                    <input type="text" name="year" id="year" class="form-control" placeholder="Year">
                    </div>
                </div>    
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" id="btn-save" name="btnsave" class="btn btn-primary">Submit</button>
                <a href="{{ route('books.index') }}" class="btn btn-danger">Cancel</a>
            </div>
        </div>
    </form>
</div>
</div>
</div>
</div>

<div class="modal fade" id="crud-modal-show" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title" id="bookCrudModal-show"></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-2 col-sm-2 col-md-2"></div>
                        <div class="col-xs-10 col-sm-10 col-md-10 ">
                        @if(isset($book->name))
                            <table>
                                <tr><td><strong>Title:</strong></td><td>{{$book->title}}</td></tr>
                                <tr><td><strong>Author:</strong></td><td>{{$book->author}}</td></tr>
                                <tr><td><strong>Pages:</strong></td><td>{{$book->pages}}</td></tr>
                                <tr><td><strong>Year:</strong></td><td>{{$book->year}}</td></tr>
                                <tr><td colspan="2" style="text-align: right "><a href="{{ route('books.index') }}" class="btn btn-danger">OK</a> </td></tr>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection