<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
 * home directory
 */
Route::get('/', [HomePageController::class, 'index'])->name('home.index');
Route::get('/catalog', [HomePageController::class, 'catalog']);
Route::get('/catalog/subcatalog/{id}', [HomePageController::class, 'subCatalog'])->name('catalog.product');
Route::get('/catalog/subcatalog/{id}/{id_product}', [HomePageController::class, 'products']);

/*
 * basket directory
 */
Route::get('/basket', [BasketController::class, 'index'])->middleware('check')->name('basket.index');
Route::get('/basket/checkout', [BasketController::class, 'create'])->middleware('check')->name('basket.checkout');
Route::get('/basket/success', [BasketController::class, 'storeOrder'])->middleware('check')->name('basket.success');
Route::post('/basket/add/{id}', [BasketController::class, 'store'])->middleware('check')->where('id', '[0-9]+')->name('basket.add');
Route::post('/basket/createorder', [BasketController::class, 'createOrder'])->middleware('check')->name('create.order');

// in order to change quantity of the product
Route::post('/basket/plus/{id}', [BasketController::class, 'plus'])->name('basket.plus');
Route::post('/basket/minus/{id}', [BasketController::class, 'minus'])->name('basket.minus');

// remove 
Route::post('/basket/remove/{id}', [BasketController::class, 'remove'])->name('basket.remove');

/*
 * Authorization and Registration controller
 */ 

// register
Route::get('register', [RegisterController::class, 'create'])->name('users');
Route::post('register', [RegisterController::class, 'store'])->name('register.users')->middleware('guest');

// auth
Route::get('login', [SessionController::class, 'create'])->name('session.create');
Route::post('login', [SessionController::class, 'store'])->name('session.store')->middleware('guest');
Route::post('logout', [SessionController::class, 'destroy'])->name('session.destroy');

/*
 * Admin panel controll
 */ 
Route::get('/control/create', [AdminController::class, 'create'])->middleware('admin')->name('admin.create');
