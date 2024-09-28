@extends('layouts.seller')

@section('content')

<div class="md:grid md:grid-cols-3 md:gap-6 mt-5 mb-5">
    <div class="md:mt-0 md:col-span-2">
        <div class="px-4 py-5 bg-white sm:p-6 shadow {{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">
            <h4 class="mb-2">Add Book</h4>
            <form action="{{ route('seller.add-book') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-2">
                    <label for="b_name" class="form-label">Book Name</label>
                    <input type="text" class="form-control" id="b_name" name="b_name" required>
                    @error('b_name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-2">
                    <label for="b_description" class="form-label">Description</label>
                    <textarea class="form-control" id="b_description" name="b_description" rows="3" required></textarea>
                    @error('b_description')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-2">
                    <label for="b_price" class="form-label">Price</label>
                    <input type="number" step="0.01" class="form-control" placeholder="Add PKR: 300 for delivery + product price" id="b_price" name="b_price" required>
                    @error('b_price')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="category_id" class="form-label">Category</label>
                    <select class="form-control" id="category_id" name="category_id" required>
                        <option value="" disabled selected>Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->category_id }}">{{ $category->c_name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="b_image" class="form-label">Image</label>
                    <input type="file" class="form-control" id="b_image" name="b_image_path" required>
                    @error('b_image_path')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="b_pdf" class="form-label">PDF</label>
                    <input type="file" class="form-control" id="b_pdf" name="b_pdf_path" required>
                    @error('b_pdf_path')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Add Book</button>
            </form>
        </div>
    </div>
</div>
@endsection
