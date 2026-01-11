<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\ProductList;
use App\Livewire\CartManager;

Route::get('/', ProductList::class)->name('products');

Route::get('/products', ProductList::class)->name('products.list');

Route::get('/cart', CartManager::class)->middleware(['auth'])->name('cart');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
