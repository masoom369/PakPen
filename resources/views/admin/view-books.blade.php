@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>All Books</h1>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Price</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $book)
                <tr>
                    <td>{{ $book->b_name }}</td>
                    <td>{{ Str::limit($book->b_description, 50) }}</td>
                    <td>${{ $book->b_price }}</td>
                    <td>{{ $book->category->name }}</td>
                    <td>
                        <a href="{{ route('admin.edit-book', $book->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('admin.delete-book', $book->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
