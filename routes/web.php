<?php

use App\Http\Controllers\BasketController;
use App\Http\Controllers\HomePageController;
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
Route::get('/', [HomePageController::class, 'index']);
Route::get('/catalog', [HomePageController::class, 'catalog']);
Route::get('/catalog/subcatalog/{id}', [HomePageController::class, 'subCatalog']);
Route::get('/catalog/subcatalog/{id}/{id_product}', [HomePageController::class, 'products']);

/*
 * basket directory
 */
Route::get('/basket', [BasketController::class, 'index'])->name('basket.index');
Route::get('/basket/checkout', [BasketController::class, 'create'])->name('basket.checkout');
Route::post('/basket/add/{id}', [BasketController::class, 'store'])->where('id', '[0-9]+')->name('basket.add');