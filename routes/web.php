<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ServiceController;

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

//сервисы
Route::get('/catalog', [ServiceController::class, 'index'])->name('services');
Route::get("/admin", [AdminController::class, "index"])->middleware("auth")->name("admin");
Route::post("/services", [ServiceController::class, "store"])->name("add_service");

//заказы
Route::get("/order-service/{service?}", [OrderController::class, "create"])->name("order_service");
