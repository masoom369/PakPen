@extends('layouts.admin')
@section('content')
<div class="bg-light mt-5 mb-5" style="padding: 20px;">
    <center>
        <h4>Categories</h4>
    </center>
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mt-3 mb-3" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @if(session('destroy'))
    <div class="alert alert-danger alert-dismissible fade show mt-3 mb-3" role="alert">
        {{ session('destroy') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <a href="{{ route('admin.add-category-form') }}" class="btn btn-info mb-3">Add Category</a>
    <div class="table-responsive">
        <table class="table" id="mytable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                <tr>
                    <td>{{ $category->category_id }}</td>
                    <td>{{ $category->c_name }}</td>
                    <td><img src="{{ asset($category->c_image_path) }}" width="100" alt="{{ $category->c_name }}"></td>
                    <td>
                        <a href="{{ route('admin.edit-category', $category->category_id) }}" class="btn btn-sm btn-info">Edit</a>
                        <form action="{{ route('admin.delete-category', $category->category_id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this category?');">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4">No categories found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
