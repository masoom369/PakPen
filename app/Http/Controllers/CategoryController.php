<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    public function read()
    {
        $categories = Category::all();
        return view('admin.view-categories', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'c_name' => 'required|unique:categories,c_name',
            'c_image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $this->handleImageUpload($request);

        Category::create([
            'c_name' => $request->input('c_name'),
            'c_image_path' => $imagePath,
        ]);

        return redirect()->route('admin.view-categories')->with('success', 'Category created successfully.');
    }

    public function edit(Category $category)
    {
        return view('admin.edit-category', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'c_name' => 'required|unique:categories,c_name,' . $category->category_id,
            'c_image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $this->handleImageUpload($request, $category);

        $category->update([
            'c_name' => $request->input('c_name'),
            'c_image_path' => $imagePath,
        ]);

        return redirect()->route('admin.view-categories')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        if ($category->c_image_path && File::exists(public_path($category->c_image_path))) {
            File::delete(public_path($category->c_image_path));
        }

        $category->delete();

        return redirect()->route('admin.view-categories')->with('success', 'Category deleted successfully.');
    }

    private function handleImageUpload(Request $request, Category $category = null)
    {
        $imagePath = null;

        if ($request->hasFile('c_image_path')) {
            if ($category && $category->c_image_path && File::exists(public_path($category->c_image_path))) {
                File::delete(public_path($category->c_image_path));
            }

            $image = $request->file('c_image_path');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('category_image'), $imageName);
            $imagePath = 'category_image/' . $imageName;
        }

        return $imagePath;
    }
}
