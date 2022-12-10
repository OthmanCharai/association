<?php

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

 Route::get('/', function () {
    return redirect()->route('filament.resources.children.index');
});



Route::resource('child', App\Http\Controllers\ChildController::class);

Route::resource('widow', App\Http\Controllers\WidowController::class);

Route::resource('sponsor', App\Http\Controllers\SponsorController::class);





Route::resource('child', App\Http\Controllers\ChildController::class);

Route::resource('widow', App\Http\Controllers\WidowController::class);

Route::resource('sponsor', App\Http\Controllers\SponsorController::class);


Route::resource('child', App\Http\Controllers\ChildController::class);

Route::resource('widow', App\Http\Controllers\WidowController::class);

Route::resource('sponsor', App\Http\Controllers\SponsorController::class);
