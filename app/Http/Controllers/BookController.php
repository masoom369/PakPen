<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class BookController extends Controller
{
    public function read()
    {
        $books = Book::where('seller_id', Auth::id())
            ->with('category')
            ->get();

        return view('seller.view-books', compact('books'));
    }

    public function download($id)
    {
        $book = Book::findOrFail($id);
        $filePath = public_path($book->b_pdf_path);

        if (File::exists($filePath)) {
            return response()->download($filePath);
        }

        return back()->with('error', 'File not found.');
    }

    public function read1()
    {
        $books = Book::with('category')->get();
        return view('admin.view-books', compact('books'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('seller.add-book', compact('categories'));
    }

    public function store(Request $request)
{
    $request->validate([
        'b_name' => 'required|string|max:255',
        'b_description' => 'required|string',
        'b_price' => 'required|numeric', // Changed to 'numeric' for decimal support
        'b_image_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'b_pdf_path' => 'required|mimes:pdf|max:10000',
        'category_id' => 'required|exists:categories,category_id',
    ]);

    $imageName = time() . '.' . $request->b_image_path->extension();
    $request->b_image_path->move(public_path('book_images'), $imageName);

    $pdfName = time() . '.' . $request->b_pdf_path->extension();
    $request->b_pdf_path->move(public_path('book_pdfs'), $pdfName);

    Book::create([
        'b_name' => $request->input('b_name'),
        'b_description' => $request->input('b_description'),
        'b_price' => $request->input('b_price'),
        'b_image_path' => 'book_images/' . $imageName,
        'b_pdf_path' => 'book_pdfs/' . $pdfName,
        'seller_id' => Auth::id(),
        'category_id' => $request->input('category_id'),
    ]);

    return redirect()->route('seller.view-books')->with('success', 'Book created successfully.');
}


    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $categories = Category::all();
        $user = Auth::user();

        if ($user->actual_usertype === 'seller') {
            return view('seller.edit-book', compact('book', 'categories'));
        } elseif ($user->actual_usertype === 'admin') {
            return view('admin.edit-book', compact('book', 'categories'));
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'b_name' => 'required|string|max:255',
            'b_description' => 'required|string',
            'b_price' => 'required|integer',
            'b_image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'b_pdf_path' => 'nullable|mimes:pdf|max:10000',
            'category_id' => 'required|exists:categories,category_id',
        ]);

        $book = Book::findOrFail($id);

        if ($request->hasFile('b_image_path')) {
            if (File::exists(public_path($book->b_image_path))) {
                File::delete(public_path($book->b_image_path));
            }

            $imageName = time() . '.' . $request->b_image_path->extension();
            $request->b_image_path->move(public_path('book_images'), $imageName);
            $book->b_image_path = 'book_images/' . $imageName;
        }

        if ($request->hasFile('b_pdf_path')) {
            if (File::exists(public_path($book->b_pdf_path))) {
                File::delete(public_path($book->b_pdf_path));
            }

            $pdfName = time() . '.' . $request->b_pdf_path->extension();
            $request->b_pdf_path->move(public_path('book_pdfs'), $pdfName);
            $book->b_pdf_path = 'book_pdfs/' . $pdfName;
        }

        $book->update([
            'b_name' => $request->input('b_name'),
            'b_description' => $request->input('b_description'),
            'b_price' => $request->input('b_price'),
            'category_id' => $request->input('category_id'),
        ]);

        $user = Auth::user();

        if ($user->actual_usertype === 'seller') {
            return redirect()->route('seller.view-books')->with('success', 'Book updated successfully.');
        } elseif ($user->actual_usertype === 'admin') {
            return redirect()->route('admin.view-books')->with('success', 'Book updated successfully.');
        }
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);

        if (File::exists(public_path($book->b_image_path))) {
            File::delete(public_path($book->b_image_path));
        }

        if (File::exists(public_path($book->b_pdf_path))) {
            File::delete(public_path($book->b_pdf_path));
        }

        $book->delete();

        $user = Auth::user();

        if ($user->actual_usertype === 'seller') {
            return redirect()->route('seller.view-books')->with('success', 'Book deleted successfully.');
        } elseif ($user->actual_usertype === 'admin') {
            return redirect()->route('admin.view-books')->with('success', 'Book deleted successfully.');
        }
    }
}
