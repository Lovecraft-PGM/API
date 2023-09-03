<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use  App\Http\controllers\UserController;
use  App\Http\controllers\ProductController;
use  App\Http\controllers\ParamController;
use  App\Http\controllers\ParamTypeController;
use  App\Http\controllers\ProviderController;
use  App\Http\controllers\OrderDetailController;
use  App\Http\controllers\OrderController;
use  App\Http\controllers\RatingController;
use App\Http\Controllers\API\AuthController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('X_API_KEY')->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
    Route::resource('params', ParamController::class);
    Route::resource('providers', ProviderController::class);
    Route::resource('ratings', RatingController::class);
    Route::resource('paramTypes', ParamTypeController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('orders', OrderController::class);
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
    Route::get('typesOrders',[ParamController::class,'typesOfordersList']);
});

Route::controller(AuthController::class)->group(function () {
Route::post('login', 'login');
Route::post('register', 'register');
Route::post('logout', 'logout');
Route::post('refresh', 'refresh');
});


