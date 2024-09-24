@extends('layouts.seller')

@section('content')
<div class="md:grid md:grid-cols-3 md:gap-6">
    <div class="md:mt-0 md:col-span-2">
        <div class="px-4 py-5 bg-white sm:p-6 shadow {{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">
            <h1>Edit Book</h1>
            <form action="{{ route('seller.update-book', $book->book_id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-2">
                    <label for="b_name" class="form-label">Book Name</label>
                    <input type="text" class="form-control" id="b_name" name="b_name" value="{{ $book->b_name }}" required>
                </div>
                <div class="mb-2">
                    <label for="b_description" class="form-label">Description</label>
                    <textarea class="form-control" id="b_description" name="b_description" rows="3" required>{{ $book->b_description }}</textarea>
                </div>
                <div class="mb-2">
                    <label for="b_price" class="form-label">Price</label>
                    <input type="number" step="0.01" class="form-control" id="b_price" name="b_price" value="{{ $book->b_price }}" required>
                </div>
                <div class="mb-3">
                    <label for="category_id" class="form-label">Category</label>
                    <select class="form-control" id="category_id" name="category_id" required>
                        <option value="" disabled>Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->category_id }}" {{ $book->category_id == $category->category_id ? 'selected' : '' }}>
                                {{ $category->c_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="b_image" class="form-label">Image (leave blank to keep current)</label>
                    @if($book->b_image_path)
                        <img src="{{ asset($book->b_image_path) }}" width="100" alt="{{ $book->b_name }}" class="d-block mb-2">
                    @endif
                    <input type="file" class="form-control" id="b_image" name="b_image">
                </div>
                <div class="mb-3">
                    <label for="b_pdf" class="form-label">PDF (leave blank to keep current)</label>
                    @if($book->b_pdf_path)
                        <p class="text-sm text-gray-600">Current PDF: <a href="{{ asset($book->b_pdf_path) }}" target="_blank">View PDF</a></p>
                    @endif
                    <input type="file" class="form-control" id="b_pdf" name="b_pdf">
                </div>
                <button type="submit" class="btn btn-primary">Update Book</button>
            </form>
        </div>
    </div>
</div>
@endsection
