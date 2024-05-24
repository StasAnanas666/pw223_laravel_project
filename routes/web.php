<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Auth;

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
    return view('home');
});

Auth::routes();

/* **********сервисы*********** */

//страница каталога, именованная services
Route::get('/catalog', [ServiceController::class, 'index'])->name('services');
//страница админа, добавление услуг, доступна только при авторизации
Route::get("/admin", [ServiceController::class, "create"])->middleware("auth")->name("admin");
//маршрут сохранения услуги в бд
Route::post("/services", [ServiceController::class, "store"])->name("add_service");

/* **********заказы*********** */

//переход на страницу оформления заказа с кнопки в карточке услуги
Route::get("/order-service/{service?}", [OrderController::class, "create"])->name("order_service");
//переход на страницу оформления заказа из меню. услуга будет отображаться на странице, только если ранее была добавлена из карточки услуги в каталоге
Route::get("/order-page", [OrderController::class, "index"])->name("order_page");
//маршрут сохранения заказа в бд
Route::post("/save-order", [OrderController::class, "store"])->name("save_order");
//страница заказов авторизованного пользователя
Route::get("/my-orders", [OrderController::class, "userOrders"])->name("my_orders")->middleware("auth");
