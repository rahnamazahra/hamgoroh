<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProvinceController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\FieldController;

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


// Admin Panel
Route::get('/', function () {
    return view('admin.index');
})->name('admin.dashboard');
// users
Route::controller(UserController::class)->group(function () {
    Route::get('/users', 'index')->name('admin.users.index');
    Route::post('/users', 'store')->name('admin.users.store');
    Route::patch('/users/{user}', 'update')->name('admin.users.update');
    Route::get('/users/{user}/delete', 'delete')->name('admin.users.delete');
});
// provinces
Route::controller(ProvinceController::class)->group(function () {
    Route::get('/provinces', 'index')->name('admin.provinces.index');
    Route::post('/provinces', 'store')->name('admin.provinces.store');
    Route::patch('/provinces/{province}', 'update')->name('admin.provinces.update');
    Route::delete('/provinces/{province}/delete', 'delete')->name('admin.provinces.delete');
});
// cities
Route::controller(CityController::class)->group(function () {
    Route::get('/cities', 'index')->name('admin.cities.index');
    Route::post('/cities', 'store')->name('admkn.cities.store');
    Route::patch('/cities/{city}', 'update')->name('admin.cities.update');
    Route::get('/cities/{city}/delete', 'delete')->name('admin.cities.delete');
});
// Fields
Route::controller(FieldController::class)->group(function () {
    // Route::get('/field-categories', 'index')->name('admin.fieldCategories.index');
    Route::get('/fields', 'index')->name('admin.fields.index');
    Route::post('/fields', 'store')->name('admin.fields.store');
    Route::patch('/fields/{field}', 'update')->name('admin.fields.update');
    Route::get('/fields/{field}/delete', 'delete')->name('admin.fields.delete');
});
