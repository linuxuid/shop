<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UsersController;
use Faker\Guesser\Name;
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

/**
 * error auth
 */
Route::get('/error', function(){
    return view('error.auth');
})->name('error');

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
Route::get('/basket', [BasketController::class, 'index'])->middleware('auth')->name('basket.index');
Route::get('/basket/checkout', [BasketController::class, 'create'])->middleware('auth')->name('basket.checkout');
Route::get('/basket/success', [BasketController::class, 'storeOrder'])->middleware('auth')->name('basket.success');
Route::post('/basket/add/{id}', [BasketController::class, 'store'])->middleware('auth')->where('id', '[0-9]+')->name('basket.add');
Route::post('/basket/createorder', [BasketController::class, 'createOrder'])->middleware('auth')->name('create.order');

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
Route::get('/control/index', [CategoryController::class, 'index'])->middleware('auth','admin')->name('admin.index');

Route::get('/control/category/create', [CategoryController::class, 'create'])->middleware('auth','admin')->name('admin.create');
Route::post('/control/category/create', [CategoryController::class, 'store'])->middleware('auth','admin')->name('admin.store');

// Route::get('/control/edit', [AdminController::class, 'show'])->middleware('admin')->name('admin.edit');

// category create
Route::get('/control/category/edit/{id}', [CategoryController::class, 'edit'])->middleware('auth','admin')->name('admin.show');
Route::post('/control/edit/{id}', [CategoryController::class, 'editStore'])->middleware('auth','admin')->name('admin.edit.store');
Route::post('/control/delete/{id}', [CategoryController::class, 'destroy'])->middleware('auth','admin')->name('admin.destroy');

// product create
Route::get('/control/product/create', [ProductController::class, 'create'])->middleware('auth','admin')->name('admin.product.create');
Route::post('/control/product/create', [ProductController::class, 'store'])->middleware('auth','admin')->name('admin.product.store');

Route::get('/control/product/edit/{id}', [ProductController::class, 'edit'])->middleware('auth','admin')->name('admin.product.edit');
Route::post('/control/product/edit/{id}', [ProductController::class, 'update'])->middleware('auth','admin')->name('admin.product.edit.store');


//USERS LIST
Route::resource('/control/users', UsersController::class)->middleware('auth','admin');

// Personal Area
Route::get('index/{id}', [ProfileController::class, 'index'])->middleware('auth')->name('personal.area');

// add profile
Route::get('/index/create', [ProfileController::class, 'create'])->middleware('auth')->name('personal.create');
Route::post('/index/create', [ProfileController::class, 'store'])->middleware('auth')->name('personal.store');

/**
 * user data in profile
 */
Route::get('/index/show', [ProfileController::class, 'showUserData'])->middleware('auth')->name('personal.show');
// update user data in profile
Route::post('/index/show', [ProfileController::class, 'updateUserData'])->middleware('auth')->name('personal.show.store');

