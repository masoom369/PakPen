<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function read()
    {
        $products = Product::where('seller_id', Auth::id())
            ->with('category')
            ->get();

        return view('seller.view-products', compact('products'));
    }

    public function read1()
    {
        $products = Product::with('category')->get();

        return view('admin.view-products', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('seller.add-product', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'p_name' => 'required|string|max:255',
            'p_description' => 'required|string',
            'p_price' => 'required|numeric',
            'p_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,category_id',
        ]);

        $imageName = time() . '.' . $request->p_image->extension();
        $request->p_image->move(public_path('product_images'), $imageName);

        Product::create([
            'p_name' => $request->input('p_name'),
            'p_description' => $request->input('p_description'),
            'p_price' => $request->input('p_price'),
            'p_image_path' => 'product_images/' . $imageName,
            'seller_id' => Auth::id(),
            'category_id' => $request->input('category_id'),
        ]);

        return redirect()->route('seller.view-products')->with('success', 'Product created successfully.');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $user = Auth::user();

        if ($user->actual_usertype === 'seller') {
            return view('seller.edit-product', compact('product', 'categories'));
        } elseif ($user->actual_usertype === 'admin') {
            return view('admin.edit-product', compact('product', 'categories'));
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'p_name' => 'required|string|max:255',
            'p_description' => 'required|string',
            'p_price' => 'required|numeric',
            'p_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,category_id',
        ]);

        $product = Product::findOrFail($id);

        if ($request->hasFile('p_image')) {
            if (File::exists(public_path($product->p_image_path))) {
                File::delete(public_path($product->p_image_path));
            }

            $imageName = time() . '.' . $request->p_image->extension();
            $request->p_image->move(public_path('product_images'), $imageName);
            $product->p_image_path = 'product_images/' . $imageName;
        }

        $product->update([
            'p_name' => $request->input('p_name'),
            'p_description' => $request->input('p_description'),
            'p_price' => $request->input('p_price'),
            'category_id' => $request->input('category_id'),
        ]);

        $user = Auth::user();

        if ($user->actual_usertype === 'seller') {
            return redirect()->route('seller.view-products')->with('success', 'Product updated successfully.');
        } elseif ($user->actual_usertype === 'admin') {
            return redirect()->route('admin.view-products')->with('success', 'Product updated successfully.');
        }
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if (File::exists(public_path($product->p_image_path))) {
            File::delete(public_path($product->p_image_path));
        }

        $product->delete();

        $user = Auth::user();

        if ($user->actual_usertype === 'seller') {
            return redirect()->route('seller.view-products')->with('success', 'Product deleted successfully.');
        } elseif ($user->actual_usertype === 'admin') {
            return redirect()->route('admin.view-products')->with('success', 'Product deleted successfully.');
        }
    }
}
