<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BlogController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware' => ['auth']], function () {

    Route::resource('categories', CategoryController::class);
    Route::get('import/categories', [CategoryController::class, 'importCategory'])->name('import.categories');
    Route::post('category/import', [CategoryController::class, 'import'])->name('categories.import');
    Route::get('category/export', [CategoryController::class, 'export'])->name('categories.export');
    Route::get('ajaxgetcategory', [CategoryController::class,'ajaxGetCategory'])->name('ajaxgetcategory'); 

    Route::resource('blogs', BlogController::class);
});