<?php

use App\Livewire\MakeTransactionDetail as LivewireMakeTransactionDetail;
use Illuminate\Support\Facades\Route;
use App\Livewire\Pages\Dashboard\Dashboard;
use App\Livewire\Pages\Product\AddProduct;
use App\Livewire\Pages\Product\EditProduct;
use App\Livewire\Pages\Product\Product;
use App\Livewire\Pages\Selling\MakeTransaction;
use App\Livewire\Pages\Selling\MakeTransactionDetail;
use App\Livewire\Pages\Selling\TransactionView;
use App\Livewire\Pages\Selling\TransactionManagement;
use App\Livewire\Pages\User\AddUser;
use App\Livewire\Pages\User\EditUser;
use App\Livewire\Pages\User\UserManagement;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    Route::prefix('product')->middleware('role:Admin|Officer')->group(function() {
        Route::get('/', Product::class)->name('product');
        Route::get('/add', AddProduct::class)->name('product.add');
        Route::get('/edit/{id}', EditProduct::class)->name('product.edit');
        Route::put('/update/{id}', [EditProduct::class, 'updateProduct'])->name('product.update');
    });

    Route::prefix('transaction')->middleware('role:Admin|Officer')->group(function() {
        Route::get('/', TransactionManagement::class)->name('transaction');
        Route::get('/view/{id}', TransactionView::class)->name('transaction.view');
        Route::get('/add', MakeTransaction::class)->name('transaction.add');
        Route::get('/add/detail/{id}',MakeTransactionDetail::class)->name('transaction.add.detail');

    });

    Route::prefix('user')->middleware('role:Admin')->group(function() {
        Route::get('/', UserManagement::class)->name('user');
        Route::get('/add', AddUser::class)->name('user.add');
        Route::get('/edit/{id}', EditUser::class)->name('user.edit');
        Route::put('/update/{id}', [EditUser::class, 'updateUser'])->name('user.update');
    });
});
