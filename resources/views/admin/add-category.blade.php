@extends('layouts.admin')

@section('content')
<div class="md:grid md:grid-cols-3 md:gap-6">
    <div class="md:mt-0 md:col-span-2">
        <div
            class="px-4 py-5 bg-white sm:p-6 shadow {{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">
            <div class="grid grid-cols-6 gap-6">
                <h4 class="mb-2">Add Category</h4>
                <form action="{{ route('admin.add-category') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-2">
                        <label for="c_name" class="form-label">Name</label>
                        <input
                            type="text"
                            class="form-control"
                            id="c_name"
                            name="c_name"
                            value="{{ old('c_name') }}"
                            required
                        >
                        @error('c_name')
                            <div class="text-red-600 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="c_image_path" class="form-label">Image</label>
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
                    <button type="submit" class="btn btn-primary">Add Category</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
