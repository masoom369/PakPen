@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Edit Book</h1>
    <form action="{{ route('seller.update-book', $book->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="b_name">Book Name</label>
            <input type="text" class="form-control" id="b_name" name="b_name" value="{{ $book->b_name }}" required>
        </div>
        <div class="form-group">
            <label for="b_description">Description</label>
            <textarea class="form-control" id="b_description" name="b_description" required>{{ $book->b_description }}</textarea>
        </div>
        <div class="form-group">
            <label for="b_price">Price</label>
            <input type="number" class="form-control" id="b_price" name="b_price" value="{{ $book->b_price }}" required>
        </div>
        <div class="form-group">
            <label for="b_image">Image (leave blank to keep current)</label>
            <input type="file" class="form-control" id="b_image" name="b_image">
        </div>
        <div class="form-group">
            <label for="b_pdf">PDF (leave blank to keep current)</label>
            <input type="file" class="form-control" id="b_pdf" name="b_pdf">
        </div>
        <div class="form-group">
            <label for="category_id">Category</label>
            <select class="form-control" id="category_id" name="category_id" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->category_id }}" {{ $book->category_id == $category->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Update Book</button>
    </form>
</div>
@endsection
