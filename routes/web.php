<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    BookController,
    HomeController,
    UserController,
    ProductController,
    CartItemController,
    CategoryController,
    ContactUsController
};

// Common Middleware for authenticated and verified users
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');
});

// Public Routes
Route::get('/', [HomeController::class, 'index']);
Route::get('/library', [HomeController::class, 'library']);
Route::get('/home', [HomeController::class, 'home'])->name('home');
Route::get('/aboutus', [HomeController::class, 'aboutus']);
Route::get('/contactus', [HomeController::class, 'contactus']);
Route::get('/categorywise/{id}', [HomeController::class, 'categorywise']);
Route::get('/product-detail/{id}', [HomeController::class, 'productdetail'])->name('product-detail');
Route::get('/book-detail/{id}', [HomeController::class, 'bookDetail'])->name('product-detail');
Route::get('/cart', [HomeController::class, 'cart'])->name('cart');
Route::post('/contactus', [ContactUsController::class, 'store'])->name('contact.store');

// Cart Routes
Route::prefix('cart')->group(function () {
    Route::post('/add', [CartItemController::class, 'addToCart'])->name('cart.add');
    Route::put('/update', [CartItemController::class, 'updateCart'])->name('cart.update');
    Route::get('/remove/{id}', [CartItemController::class, 'removeCartItem'])->name('cart.remove');
    Route::post('/place-order', [CartItemController::class, 'placeOrder'])->name('order.place');
    Route::get('/summary', [HomeController::class, 'cartSummary'])->name('cart.summary');
});

// Seller Routes
// Route::prefix('seller')->middleware(['auth', 'seller'])->group(function () {
Route::prefix('seller')->group(function () {
    // Product Routes
    Route::get('add-product', [ProductController::class, 'create'])->name('seller.add-product-form');
    Route::post('add-product', [ProductController::class, 'store'])->name('seller.add-product');
    Route::get('view-products', [ProductController::class, 'read'])->name('seller.view-products');
    Route::get('edit-product/{id}', [ProductController::class, 'edit'])->name('seller.edit-product');
    Route::put('update-product/{id}', [ProductController::class, 'update'])->name('seller.update-product');
    Route::delete('delete-product/{id}', [ProductController::class, 'destroy'])->name('seller.delete-product');

    // Book Routes
    Route::get('view-books', [BookController::class, 'read'])->name('seller.view-books');
    Route::get('add-book', [BookController::class, 'create'])->name('seller.add-book');
    Route::post('add-book', [BookController::class, 'store'])->name('seller.add-book-form');
    Route::get('edit-book/{id}', [BookController::class, 'edit'])->name('seller.edit-book');
    Route::put('update-book/{id}', [BookController::class, 'update'])->name('seller.update-book');
    Route::delete('delete-book/{id}', [BookController::class, 'destroy'])->name('seller.delete-book');
});

// Admin Routes
// Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
Route::prefix('admin')->group(function () {
    // Contact Messages
    Route::delete('/contact-us/{id}', [ContactUsController::class, 'destroy'])->name('contact-us.destroy');
    Route::get('/contactdata', [ContactUsController::class, 'index'])->name('contact.index')->middleware('admin');

    // Product Routes
    Route::get('view-products', [ProductController::class, 'read1'])->name('admin.view-products');
    Route::get('edit-product/{id}', [ProductController::class, 'edit'])->name('admin.edit-product');
    Route::put('update-product/{id}', [ProductController::class, 'update'])->name('admin.update-product');
    Route::delete('delete-product/{id}', [ProductController::class, 'destroy'])->name('admin.delete-product');

    // Category Routes
    Route::get('add-category', fn() => view('admin.add-category'))->name('admin.add-category-form');
    Route::post('add-category', [CategoryController::class, 'store'])->name('admin.add-category');
    Route::get('view-categories', [CategoryController::class, 'read'])->name('admin.view-categories');
    Route::get('edit-category/{id}', [CategoryController::class, 'edit'])->name('admin.edit-category');
    Route::put('update-category/{id}', [CategoryController::class, 'update'])->name('admin.update-category');
    Route::delete('delete-category/{id}', [CategoryController::class, 'destroy'])->name('admin.delete-category');

    // User Approval
    Route::get('user-approve/{id}', [UserController::class, 'edit']);
    Route::put('user-approve/{id}', [UserController::class, 'approve']);

    // Book Routes
    Route::get('view-books', [BookController::class, 'read1'])->name('admin.view-books');
    Route::get('edit-books/{id}', [BookController::class, 'edit'])->name('admin.edit-book');
    Route::put('update-books/{id}', [BookController::class, 'update'])->name('admin.update-book');
    Route::delete('delete-books/{id}', [BookController::class, 'destroy'])->name('admin.delete-book');
});
Route::get('/books/{id}/download', [BookController::class, 'download'])->name('download-book');
