<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\UserController;
use  App\Http\Controllers\ProductController;
use  App\Http\Controllers\ParamController;
use  App\Http\Controllers\ParamTypeController;
use  App\Http\Controllers\ProviderController;
use  App\Http\Controllers\OrderDetailController;
use  App\Http\Controllers\OrderController;
use  App\Http\Controllers\RatingController;
use App\Http\Controllers\API\AuthController;
use App\Models\Order;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('X_API_KEY')->group(function () {
    Route::get('countries',[ParamController::class,'countriesList']);
    Route::get('departments',[ParamController::class,'departmentsList']);
    Route::get('cities',[ParamController::class,'citiesList']);
    Route::get('typesUsers',[ParamController::class,'typesOfUsersList']);
    Route::get('roles',[ParamController::class,'rolesList']);
    Route::get('states',[ParamController::class,'statesList']);
    Route::get('banks',[ParamController::class,'banksList']);
    Route::get('typesBankAccounts',[ParamController::class,'typesOfBankAccountsList']);
    Route::get('sizes',[ParamController::class,'sizesList']);
    Route::get('gender',[ParamController::class,'genderList']);
    Route::get('categories',[ParamController::class,'categoriesList']);
    Route::get('subcategories',[ParamController::class,'subcategoriesList']);
    Route::get('marks',[ParamController::class,'marksList']);
    Route::get('colors',[ParamController::class,'colorsList']);
    Route::get('paymentMethods',[ParamController::class,'paymentMethodsList']);
    Route::get('purchaseStatuses',[ParamController::class,'purchaseStatusesList']);
    Route::get('showShopping',[OrderController::class,'showShopping']);
    Route::get('shoppingCardCreate',[OrderController::class,'shoppingCardCreate']);
    Route::get('shoppingCardUpdate',[OrderController::class,'shoppingCardUpdate']);
    Route::resource('products', ProductController::class);
    Route::resource('params', ParamController::class);
    Route::resource('providers', ProviderController::class);
    Route::resource('ratings', RatingController::class);
    Route::resource('paramTypes', ParamTypeController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('ordersDetail', OrderDetailController::class);
    Route::resource('users', UserController::class);
});


Route::controller(AuthController::class)->group(function () {
Route::post('login', 'login');
Route::post('register', 'register');
Route::post('logout', 'logout');
Route::post('refresh', 'refresh');
});


