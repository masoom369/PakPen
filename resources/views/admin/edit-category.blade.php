@extends('layouts.admin')

@section('content')
<h1>Edit Category</h1>
<form action="{{ route('admin.update-category', $category->category_id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-4">
        <label for="c_name" class="form-label">Name:</label>
        <input
            type="text"
            name="c_name"
            id="c_name"
            value="{{ old('c_name', $category->c_name) }}"
            required
            class="form-control"
        >
        @error('c_name')
            <div class="text-red-600 text-sm">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-4">
        <label for="c_image_path" class="form-label">Image</label>
        @if($category->c_image_path)
            <img src="{{ asset($category->c_image_path) }}" width="100" alt="{{ $category->c_name }}" class="d-block mb-2">
        @endif
        <input
            type="file"
            class="form-control"
            id="c_image_path"
            name="c_image_path"
        >
        @error('c_image_path')
            <div class="text-red-600 text-sm">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Update Category</button>
</form>
@endsection
