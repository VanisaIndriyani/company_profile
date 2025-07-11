<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\HomeController;
use App\Models\Article;
use App\Http\Controllers\User\CategoryController;
use App\Models\Catalog;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\OrderController;
use App\Models\About;
use App\Models\Category;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\ContactMessageController;

Route::get('/', function () {
    $about = About::all();
    $categories = Category::all();
    return view('user.home', compact('about', 'categories'));
});

Route::get('/home', [HomeController::class, 'index']);

Route::get('/blog', function () {
    $articles = Article::all();
    $recents = Article::orderBy('created_at', 'desc')->take(5)->get();
    return view('user.blog', compact('articles', 'recents'));
})->name('blog');

Route::get('/blog/{slug}', function ($slug) {
    $article = Article::where('slug', $slug)->firstOrFail();
    return view('user.blog_show', compact('article'));
})->name('blog.show');

Route::get('/ajax/blog/{article}', function($id) {
    $article = \App\Models\Article::findOrFail($id);
    return view('user.blog_show', compact('article'))->render();
})->name('ajax.blog.show');

Route::get('/catalog', function (\Illuminate\Http\Request $request) {
    $c = $request->input('c');
    if ($c) {
        $catalogs = \App\Models\Catalog::whereRaw('LOWER(category) = ?', [strtolower($c)])->get();
    } else {
        $catalogs = \App\Models\Catalog::all();
    }
    return view('user.catalog', compact('catalogs'));
})->name('catalog');

Route::get('/contact', function () {
    return view('user.contact');
});

Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

Route::get('/category', [CategoryController::class, 'index'])->name('category');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    Route::get('/admin/orders', [OrderController::class, 'index'])->name('admin.orders');
    Route::post('/admin/orders/{order}/accept', [OrderController::class, 'accept'])->name('admin.orders.accept');
    Route::post('/admin/orders/{order}/reject', [OrderController::class, 'reject'])->name('admin.orders.reject');
    Route::get('/admin/orders/{order}/receipt', [OrderController::class, 'receipt'])->name('admin.orders.receipt');
    Route::get('/admin/messages', [ContactMessageController::class, 'index'])->name('admin.messages');
});

Route::middleware(['auth', 'role:manager'])->group(function () {
    Route::get('/manager/dashboard', [App\Http\Controllers\ManagerDashboardController::class, 'index'])->name('manager.dashboard');

    // Katalog
    Route::get('/manager/catalog', [App\Http\Controllers\CatalogController::class, 'index'])->name('manager.catalog');
    Route::get('/manager/catalog/create', [App\Http\Controllers\CatalogController::class, 'create'])->name('manager.catalog.create');
    Route::post('/manager/catalog', [App\Http\Controllers\CatalogController::class, 'store'])->name('manager.catalog.store');
    Route::get('/manager/catalog/{catalog}/edit', [App\Http\Controllers\CatalogController::class, 'edit'])->name('manager.catalog.edit');
    Route::put('/manager/catalog/{catalog}', [App\Http\Controllers\CatalogController::class, 'update'])->name('manager.catalog.update');
    Route::delete('/manager/catalog/{catalog}', [App\Http\Controllers\CatalogController::class, 'destroy'])->name('manager.catalog.destroy');

    // Blog
    Route::get('/manager/blog', [App\Http\Controllers\ArticleController::class, 'index'])->name('manager.blog');
    Route::get('/manager/blog/create', [App\Http\Controllers\ArticleController::class, 'create'])->name('manager.blog.create');
    Route::post('/manager/blog', [App\Http\Controllers\ArticleController::class, 'store'])->name('manager.blog.store');
    Route::get('/manager/blog/{article}/edit', [App\Http\Controllers\ArticleController::class, 'edit'])->name('manager.blog.edit');
    Route::put('/manager/blog/{article}', [App\Http\Controllers\ArticleController::class, 'update'])->name('manager.blog.update');
    Route::delete('/manager/blog/{article}', [App\Http\Controllers\ArticleController::class, 'destroy'])->name('manager.blog.destroy');

    // Laporan Pesanan
    Route::get('/manager/orders-report', [App\Http\Controllers\OrderController::class, 'report'])->name('manager.orders.report');
    // Laporan Keuangan
    Route::get('/manager/finance-report', [App\Http\Controllers\OrderController::class, 'financeReport'])->name('manager.finance.report');
    Route::get('/manager/finance-report/export', [App\Http\Controllers\OrderController::class, 'exportFinanceReport'])->name('manager.finance.report.export');
    // Stok Barang
    Route::get('/manager/stock', [App\Http\Controllers\CatalogController::class, 'stock'])->name('manager.stock');
    Route::put('/manager/stock/{catalog}', [App\Http\Controllers\CatalogController::class, 'updateStock'])->name('manager.stock.update');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/cart', [OrderController::class, 'cart'])->name('cart');
Route::post('/cart/add', [OrderController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/remove', [OrderController::class, 'removeFromCart'])->name('cart.remove');
Route::get('/checkout', [OrderController::class, 'checkoutForm'])->name('checkout');
Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout.process');

Route::get('/orders', [OrderController::class, 'userOrders'])->name('user.order');
