<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;
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
    return view('welcome');
});
Route::get("index",[ImageController::class,"index"]);
Route::get("create",[ImageController::class,"create"]);
Route::post("store",[ImageController::class,"store"]);
Route::get("edit/{id}",[ImageController::class,"edit"]);
Route::post("update/{id}",[ImageController::class,"update"])->name('image.update');
Route::get("delete/show/{id}",[ImageController::class,"deleteRecord"]);
Route::delete("/delete/{id}",[ImageController::class,"destroy"]);
