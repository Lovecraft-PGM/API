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

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::controller(AuthController::class)->group(function () {
Route::post('login', 'login');
Route::post('register', 'register');
Route::post('logout', 'logout');
Route::post('refresh', 'refresh');
});

//Routes user
Route::get('users',[UserController::class,'index']);
Route::get('users/{user}',[UserController::class,'show']);
Route::post('users',[UserController::class,'store']);
Route::put('users/{user}',[UserController::class,'update']);
Route::delete('users/{user}',[UserController::class,'destroy']);

//Routes Products
Route::get('products',[ProductController::class,'index']);
Route::get('products/{product}',[ProductController::class,'show']);
Route::post('products',[ProductController::class,'store']);
Route::put('products/{product}',[ProductController::class,'update']);
Route::delete('products/{product}',[ProductController::class,'destroy']);

//Routes Params
Route::get('params',[ParamController::class,'index']);
Route::get('params/{param}',[ParamController::class,'show']);
Route::post('params',[ParamController::class,'store']);
Route::put('params/{param}',[ParamController::class,'update']);
Route::delete('params/{param}',[ParamController::class,'destroy']);

//Routes poviders
Route::get('providers',[ProviderController::class,'index']);
Route::get('providers/{provider}',[ProviderController::class,'show']);
Route::post('providers',[ProviderController::class,'store']);
Route::put('providers/{provider}',[ProviderController::class,'update']);
Route::delete('providers/{provider}',[ProviderController::class,'destroy']);

//Routes ratings
Route::get('ratings',[RatingController::class,'index']);
Route::get('ratings/{rating}',[RatingController::class,'show']);
Route::post('ratings',[RatingController::class,'store']);
Route::put('ratings/{rating}',[RatingController::class,'update']);
Route::delete('ratings/{rating}',[RatingController::class,'destroy']);

//Routes Param Types
Route::get('paramTypes',[ParamTypeController::class,'index']);
Route::get('paramTypes/{paramType}',[ParamTypeController::class,'show']);
Route::post('paramTypes',[ParamTypeController::class,'store']);
Route::put('paramTypes/{paramType}',[ParamTypeController::class,'update']);
Route::delete('paramTypes/{paramType}',[ParamTypeController::class,'destroy']);

//Routes orders Details
Route::get('orders',[OrderController::class,'index']);
Route::get('orders/{order}',[OrderController::class,'show']);
Route::post('orders',[OrderController::class,'store']);
Route::put('orders/{order}',[OrderController::class,'update']);
Route::delete('orders/{order}',[OrderController::class,'destroy']);



//Routes Gets Param Lits
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