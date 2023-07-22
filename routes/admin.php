<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AjaxController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\FieldController;
use App\Http\Controllers\Admin\ProvinceController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\CompetitionController;

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

// permissions
Route::controller(PermissionController::class)->group(function () {
    Route::get('/permissions', 'index')->name('admin.permissions.index');
    Route::get('/permissions/create', 'create')->name('admin.permissions.create');
    Route::post('/permissions', 'store')->name('admin.permissions.store');
    Route::get('/permissions/{permission}/edit', 'edit')->name('admin.permissions.edit');
    Route::patch('/permissions/{permission}', 'update')->name('admin.permissions.update');
    Route::delete('/permissions/{permission}/delete', 'delete')->name('admin.permissions.delete');
});

// users
Route::controller(UserController::class)->group(function () {
    Route::get('/users', 'index')->name('admin.users.index');
    Route::get('/users/create', 'create')->name('admin.users.create');
    Route::post('/users', 'store')->name('admin.users.store');
    Route::get('/users/{user}/edit', 'edit')->name('admin.users.edit');
    Route::patch('/users/{user}', 'update')->name('admin.users.update');
    Route::delete('/users/{user}/delete', 'delete')->name('admin.users.delete');
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
    Route::delete('/cities/{city}/delete', 'delete')->name('admin.cities.delete');
});

// Fields
Route::controller(FieldController::class)->group(function () {
    Route::get('/fields', 'index')->name('admin.fields.index');
    Route::post('/fields', 'store')->name('admin.fields.store');
    Route::patch('/fields/{field}', 'update')->name('admin.fields.update');
    Route::delete('/fields/{field}/delete', 'delete')->name('admin.fields.delete');
});

// Conpetitions
Route::controller(CompetitionController::class)->group(function () {
    Route::get('/competitions', 'index')->name('admin.competitions.index');
    Route::post('/competitions', 'store')->name('admin.competitions.store');
    Route::patch('/competitions/{competition}', 'update')->name('admin.competitions.update');
    Route::delete('/competitions/{competition}/delete', 'delete')->name('admin.competitions.delete');
});

// Ajax
Route::controller(AjaxController::class)->group(function () {
    Route::post('/province/cities', 'showCitiesByProvince')->name('admin.ajax.cities');
});

//Export excel
Route::get('co/data/export', 'ExportController@export')->middleware('auth')->name('export.excel');
