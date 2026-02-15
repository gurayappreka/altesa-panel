<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;

// Public
Route::get('/', fn() => redirect('/login'));

// Auth
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
});

// Protected
Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    
    // Customers
    Route::resource('customers', CustomerController::class);
    
    // Quotes
    Route::resource('quotes', QuoteController::class);
    Route::get('/quotes/{quote}/pdf', [QuoteController::class, 'pdf'])->name('quotes.pdf');
    
    // Suppliers
    Route::resource('suppliers', SupplierController::class);
    
    // Purchases
    Route::resource('purchases', PurchaseController::class);
    
    // Products & Stock
    Route::resource('products', ProductController::class);
    Route::get('/stock/alerts', [StockController::class, 'alerts'])->name('stock.alerts');
    
    // Projects & Tasks
    Route::resource('projects', ProjectController::class);
    Route::get('/my-tasks', [TaskController::class, 'myTasks'])->name('tasks.my');
    Route::resource('projects.tasks', TaskController::class)->shallow();
    
    // Files
    Route::get('/files', [FileController::class, 'index'])->name('files.index');
    Route::post('/files/upload', [FileController::class, 'upload'])->name('files.upload');
    
    // Admin Only
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('users', UserController::class);
    });
});
