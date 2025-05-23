<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

// Redirect root to login page for guests
Route::get('/', function () {
    return redirect()->route('login');
});

// Add a dashboard route that redirects to todos.index
// This helps with Laravel's default auth redirects
Route::get('/dashboard', function () {
    return redirect()->route('todos.index');
})->middleware(['auth'])->name('dashboard');

// Protected routes that require authentication
Route::middleware(['auth'])->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Todo routes - all protected by auth middleware
    Route::get('/todos', [TodoController::class, 'index'])->name('todos.index');
    Route::post('/todos', [TodoController::class, 'store'])->name('todos.store');
    Route::put('/todos/{todo}', [TodoController::class, 'update'])->name('todos.update');
    Route::delete('/todos/{todo}', [TodoController::class, 'destroy'])->name('todos.destroy');
    Route::patch('/todos/{todo}/toggle', [TodoController::class, 'toggle'])->name('todos.toggle');
    Route::get('/todos/{todo}/edit', [TodoController::class, 'edit'])->name('todos.edit');
});

// Auth routes (login, register, etc.)
require __DIR__ . '/auth.php';
