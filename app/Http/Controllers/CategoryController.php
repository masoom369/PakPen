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

        $imagePath = null;
        if ($request->hasFile('c_image_path')) {
            $image = $request->file('c_image_path');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('category_image'), $imageName);
            $imagePath = 'category_image/' . $imageName;
        }

        Category::create([
            'c_name' => $request->input('c_name'),
            'c_image_path' => $imagePath,
        ]);

        return redirect()->route('admin.view-categories')->with('success', 'Category created successfully.');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.edit-category', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'c_name' => 'required|unique:categories,c_name,' . $id . ',category_id',
            'c_image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $category = Category::findOrFail($id);

        $imagePath = $category->c_image_path;
        if ($request->hasFile('c_image_path')) {
            if ($imagePath && File::exists(public_path($imagePath))) {
                File::delete(public_path($imagePath));
            }

            $image = $request->file('c_image_path');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('category_image'), $imageName);
            $imagePath = 'category_image/' . $imageName;
        }

        $category->update([
            'c_name' => $request->input('c_name'),
            'c_image_path' => $imagePath,
        ]);

        return redirect()->route('admin.view-categories')->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        if ($category->c_image_path && File::exists(public_path($category->c_image_path))) {
            File::delete(public_path($category->c_image_path));
        }

        $category->delete();

        return redirect()->route('admin.view-categories')->with('success', 'Category deleted successfully.');
    }
}
