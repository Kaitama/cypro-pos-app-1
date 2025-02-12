<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


Route::get('/', function () {
	return view('welcome');
});

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::middleware('auth')->group(function () {
	// Route menu kategori
	Route::resource('categories', CategoryController::class)
		->middleware('apakah_admin');

	// Route menu produk
	Route::resource('products', ProductController::class);

	// Route untuk menu user
	Route::prefix('users')->group(function () {
		// tampilan semua user (index)
		Route::get('/index', [UserController::class, 'index'])
			->name('users.index');
		// tambah user baru (create)
		Route::get('/create', [UserController::class, 'create'])
			->name('users.create');
		// simpan data user baru (store)
		Route::post('/store', [UserController::class, 'store'])
			->name('users.store');
		// ubah user yang ada (edit)
		Route::get('/{id}/edit', [UserController::class, 'edit'])
			->name('users.edit');
		// simpan perubahan data (update)
		Route::post('/update', [UserController::class, 'update'])
			->name('users.update');
		// hapus user (delete)
		Route::post('/{id}/delete', [UserController::class, 'delete'])
			->name('users.delete');
	});
});
