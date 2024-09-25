<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    BookController,
    HomeController,
    UserController,
    ProductController,
    CartItemController,
    CategoryController,
    ContactUsController,
    OrderController
};

// Middleware for authenticated and verified users
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
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
Route::get('/book-detail/{id}', [HomeController::class, 'bookDetail'])->name('book-detail'); // Fixed the name
Route::get('/cart', [HomeController::class, 'cart'])->name('cart');
Route::post('/contactus', [ContactUsController::class, 'store'])->name('contact.store');

// Cart Routes
Route::prefix('cart')->group(function () {
    Route::post('/add', [CartItemController::class, 'addToCart'])->name('cart.add')->middleware('customer');
    Route::get('/remove/{id}', [CartItemController::class, 'removeCartItem'])->name('cart.remove')->middleware('customer');
    Route::get('/summary', [HomeController::class, 'cartSummary'])->name('cart.summary');
});

// Seller Routes
Route::prefix('seller')->group(function () {
    // Product Routes
    Route::get('add-product', [ProductController::class, 'create'])->name('seller.add-product-form')->middleware('seller');
    Route::post('add-product', [ProductController::class, 'store'])->name('seller.add-product')->middleware('seller');
    Route::get('view-products', [ProductController::class, 'read'])->name('seller.view-products')->middleware('seller');
    Route::get('edit-product/{id}', [ProductController::class, 'edit'])->name('seller.edit-product')->middleware('seller');
    Route::put('update-product/{id}', [ProductController::class, 'update'])->name('seller.update-product')->middleware('seller');
    Route::delete('delete-product/{id}', [ProductController::class, 'destroy'])->name('seller.delete-product')->middleware('seller');

    // Book Routes
    Route::get('view-books', [BookController::class, 'read'])->name('seller.view-books')->middleware('seller');
    Route::get('add-book', [BookController::class, 'create'])->name('seller.add-book')->middleware('seller');
    Route::post('add-book', [BookController::class, 'store'])->name('seller.add-book-form')->middleware('seller');
    Route::get('edit-book/{id}', [BookController::class, 'edit'])->name('seller.edit-book')->middleware('seller');
    Route::put('update-book/{id}', [BookController::class, 'update'])->name('seller.update-book')->middleware('seller');
    Route::delete('delete-book/{id}', [BookController::class, 'destroy'])->name('seller.delete-book')->middleware('seller');
});

// Admin Routes
Route::prefix('admin')->group(function () {
    // Contact Messages
    Route::get('/contactdata', [ContactUsController::class, 'index'])->name('contact.index')->middleware('admin');
    Route::delete('/contact-us/{id}', [ContactUsController::class, 'destroy'])->name('contact-us.destroy')->middleware('admin');

    // Product Routes
    Route::get('view-products', [ProductController::class, 'read1'])->name('admin.view-products')->middleware('admin');
    Route::get('edit-product/{id}', [ProductController::class, 'edit'])->name('admin.edit-product')->middleware('admin');
    Route::put('update-product/{id}', [ProductController::class, 'update'])->name('admin.update-product')->middleware('admin');
    Route::delete('delete-product/{id}', [ProductController::class, 'destroy'])->name('admin.delete-product')->middleware('admin');

    // Category Routes
    Route::get('add-category', fn() => view('admin.add-category'))->name('admin.add-category-form')->middleware('admin');
    Route::post('add-category', [CategoryController::class, 'store'])->name('admin.add-category')->middleware('admin');
    Route::get('view-categories', [CategoryController::class, 'read'])->name('admin.view-categories')->middleware('admin');
    Route::get('edit-category/{id}', [CategoryController::class, 'edit'])->name('admin.edit-category')->middleware('admin');
    Route::put('update-category/{id}', [CategoryController::class, 'update'])->name('admin.update-category')->middleware('admin');
    Route::delete('delete-category/{id}', [CategoryController::class, 'destroy'])->name('admin.delete-category')->middleware('admin');

    // User Approval
    Route::get('user-approve/{id}', [UserController::class, 'edit'])->middleware('admin');
    Route::put('user-approve/{id}', [UserController::class, 'approve'])->middleware('admin');

    // Book Routes
    Route::get('view-books', [BookController::class, 'read1'])->name('admin.view-books')->middleware('admin');
    Route::get('edit-books/{id}', [BookController::class, 'edit'])->name('admin.edit-book')->middleware('admin');
    Route::put('update-books/{id}', [BookController::class, 'update'])->name('admin.update-book')->middleware('admin');
    Route::delete('delete-books/{id}', [BookController::class, 'destroy'])->name('admin.delete-book')->middleware('admin');
});

// Other Routes
Route::get('/books/{id}/download', [BookController::class, 'download'])->name('download-book');
Route::post('/order/place', [OrderController::class, 'placeOrder'])->name('order.place')->middleware('customer');
Route::get('/user/orders', [OrderController::class, 'userOrders'])->name('user.orders')->middleware('customer');
Route::get('/seller/orders', [OrderController::class, 'sellerOrders'])->name('seller.orders')->middleware('seller');
Route::get('/delivery/ready', [OrderController::class, 'readyOrders'])->name('delivery.ready')->middleware('deliveryAgent');
Route::get('/delivery/delivering', [OrderController::class, 'deliveringOrders'])->name('delivery.delivering')->middleware('deliveryAgent');

// Order Status Update Routes
Route::put('/order/{id}/update-status', [OrderController::class, 'updateStatus'])->name('order.updateStatus')->middleware('seller');
Route::put('/order/{id}/update-to-delivering', [OrderController::class, 'updateToDelivering'])->name('order.updateToDelivering')->middleware('deliveryAgent');
Route::put('/order/{id}/update-to-delivered', [OrderController::class, 'updateToDelivered'])->name('order.updateToDelivered')->middleware('deliveryAgent');
