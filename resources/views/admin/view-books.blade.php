@extends('layouts.admin')

@section('content')
    <div class="bg-light mt-5 mb-5" style="padding: 20px;">
        <center>
            <h4>All Books</h4>
        </center>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if (session('destroy'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('destroy') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif


        <div class="table-responsive text-center">
            <table class="table" id="book">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Actions</th>
                        <th>Download</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($books as $book)
                        <tr>
                            <td>{{ $book->b_name }}</td>
                            <td><img src="{{ asset($book->b_image_path) }}" width="100" alt="{{ $book->b_name }}"></td>
                            <td>{{ Str::limit($book->b_description, 50) }}</td>
                            <td>${{ $book->b_price }}</td>
                            <td>{{ $book->category->c_name ?? 'No Category' }}</td>
                            <td>
                                <a href="{{ route('seller.edit-book', $book->book_id) }}"
                                    class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('seller.delete-book', $book->book_id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                            <td><a href="{{ route('download-book', $book->book_id) }}" class="btn btn-sm btn-info">Download
                                    PDF</a></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">No books found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
