<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Market\BrandController;
use App\Http\Controllers\Market\CartItemController;
use App\Http\Controllers\Market\CashPaymentController;
use App\Http\Controllers\Market\DeliveryController;
use App\Http\Controllers\Market\GuaranteeController;
use App\Http\Controllers\Market\OfflinePaymentController;
use App\Http\Controllers\Market\ProductCategoryController;
use App\Http\Controllers\Market\ProductController;
use App\Http\Controllers\Market\ProductImageController;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\ProvinceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::get('/mobile', function (Request $request) {
    $mobile = "09387589696";
    $programmer = "mehrdad ebrahimi";
    return response()->json(['programmer' => $programmer, 'mobile' => $mobile]);
});

//version v1
Route::prefix('v1')->group(function () {



    Route::prefix('auth')->group(function () {
        Route::get('login', function () {
            return redirect('/');
        })->name('login');
        Route::post('login', [AuthController::class, 'login'])->name('login');
        Route::prefix('otp')->group(function () {
            Route::post('/', [AuthController::class, 'otp'])->name('otp');
            Route::post('/verify', [AuthController::class, 'verifyMobile'])->name('verifyMobile');
         //   Route::get('/verify', [AuthController::class, 'verifyMobile'])->name('verifyMobile');
        });
        Route::post('register', [AuthController::class, 'register'])->name('register');
    });


    Route::middleware('auth:sanctum')->group(function () {

        Route::group(['prefix' => 'province'], function () {
            Route::get('/', [ProvinceController::class, 'index'])->name('index');
            Route::post('/store', [ProvinceController::class, 'store'])->name('store'); //->middleware('is_admin')
            Route::get('/show/{id}', [ProvinceController::class, 'show'])->name('show');
            Route::patch('/update/{id}', [ProvinceController::class, 'update'])->name('update'); //->middleware('is_admin')
            Route::delete('/delete/{id}', [ProvinceController::class, 'destroy'])->name('delete'); //->middleware('is_admin')
        });




        Route::group(['prefix' => 'city'], function () {
            Route::get('/', [CityController::class, 'index'])->name('index');
            Route::post('/store', [CityController::class, 'store'])->name('store'); //->middleware('is_admin')
            Route::get('/show/{id}', [CityController::class, 'show'])->name('show');
            Route::patch('/update/{id}', [CityController::class, 'update'])->name('update'); //->middleware('is_admin')
            Route::delete('/delete/{id}', [CityController::class, 'destroy'])->name('delete');  //->middleware('is_admin')
        });



        Route::group(['prefix' => 'address'], function () {
            Route::get('/', [AddressController::class, 'index'])->name('index');
            Route::post('/store', [AddressController::class, 'store'])->name('store'); //->middleware('is_admin')
            Route::get('/show/{id}', [AddressController::class, 'show'])->name('show');
            Route::patch('/update/{id}', [AddressController::class, 'update'])->name('update'); //->middleware('is_admin')
            Route::delete('/delete/{id}', [AddressController::class, 'destroy'])->name('delete');  //->middleware('is_admin')
        });




        Route::group(['prefix' => 'otp'], function () {
            Route::get('/', [OtpController::class, 'index'])->name('index');
//            Route::post('/store', [OtpController::class, 'store'])->name('store'); //->middleware('is_admin')
            Route::get('/show/{id}', [OtpController::class, 'show'])->name('show');
//            Route::patch('/update/{id}', [OtpController::class, 'update'])->name('update'); //->middleware('is_admin')
            Route::delete('/delete/{id}', [OtpController::class, 'destroy'])->name('delete');  //->middleware('is_admin')
        });


        Route::group(['prefix' => 'brand'], function () {
            Route::get('/', [BrandController::class, 'index'])->name('index');
            Route::post('/store', [BrandController::class, 'store'])->name('store'); //->middleware('is_admin')
            Route::get('/show/{id}', [BrandController::class, 'show'])->name('show');
            Route::post('/update/{id}', [BrandController::class, 'update'])->name('update'); //->middleware('is_admin')
            Route::delete('/delete/{id}', [BrandController::class, 'destroy'])->name('delete');  //->middleware('is_admin')
        });


        Route::group(['prefix' => 'cart-item'], function () {
            Route::get('/', [CartItemController::class, 'index'])->name('index');
            Route::post('/store', [CartItemController::class, 'store'])->name('store'); //->middleware('is_admin')
            Route::get('/show/{id}', [CartItemController::class, 'show'])->name('show');
            Route::patch('/update/{id}', [CartItemController::class, 'update'])->name('update'); //->middleware('is_admin')
            Route::delete('/delete/{id}', [CartItemController::class, 'destroy'])->name('delete');  //->middleware('is_admin')
        });



        Route::group(['prefix' => 'cash-payment'], function () {
            Route::get('/', [CashPaymentController::class, 'index'])->name('index');
            Route::post('/store', [CashPaymentController::class, 'store'])->name('store'); //->middleware('is_admin')
            Route::get('/show/{id}', [CashPaymentController::class, 'show'])->name('show');
            Route::patch('/update/{id}', [CashPaymentController::class, 'update'])->name('update'); //->middleware('is_admin')
            Route::delete('/delete/{id}', [CashPaymentController::class, 'destroy'])->name('delete');  //->middleware('is_admin')
        });



        Route::group(['prefix' => 'delivery'], function () {
            Route::get('/', [DeliveryController::class, 'index'])->name('index');
            Route::post('/store', [DeliveryController::class, 'store'])->name('store'); //->middleware('is_admin')
            Route::get('/show/{id}', [DeliveryController::class, 'show'])->name('show');
            Route::patch('/update/{id}', [DeliveryController::class, 'update'])->name('update'); //->middleware('is_admin')
            Route::delete('/delete/{id}', [DeliveryController::class, 'destroy'])->name('delete');  //->middleware('is_admin')
        });



        Route::group(['prefix' => 'guarantee'], function () {
            Route::get('/', [GuaranteeController::class, 'index'])->name('index');
            Route::post('/store', [GuaranteeController::class, 'store'])->name('store'); //->middleware('is_admin')
            Route::get('/show/{id}', [GuaranteeController::class, 'show'])->name('show');
            Route::patch('/update/{id}', [GuaranteeController::class, 'update'])->name('update'); //->middleware('is_admin')
            Route::delete('/delete/{id}', [GuaranteeController::class, 'destroy'])->name('delete');  //->middleware('is_admin')
        });



        Route::group(['prefix' => 'offline-payment'], function () {
            Route::get('/', [OfflinePaymentController::class, 'index'])->name('index');
            Route::post('/store', [OfflinePaymentController::class, 'store'])->name('store'); //->middleware('is_admin')
            Route::get('/show/{id}', [OfflinePaymentController::class, 'show'])->name('show');
            Route::patch('/update/{id}', [OfflinePaymentController::class, 'update'])->name('update'); //->middleware('is_admin')
            Route::delete('/delete/{id}', [OfflinePaymentController::class, 'destroy'])->name('delete');  //->middleware('is_admin')
        });


        Route::group(['prefix' => 'product-category'], function () {
            Route::get('/', [ProductCategoryController::class, 'index'])->name('index');
            Route::post('/store', [ProductCategoryController::class, 'store'])->name('store'); //->middleware('is_admin')
            Route::get('/show/{id}', [ProductCategoryController::class, 'show'])->name('show');
            Route::post('/update/{id}', [ProductCategoryController::class, 'update'])->name('update'); //->middleware('is_admin')
            Route::delete('/delete/{id}', [ProductCategoryController::class, 'destroy'])->name('delete');  //->middleware('is_admin')
        });


        Route::group(['prefix' => 'product'], function () {
            Route::get('/', [ProductController::class, 'index']);
            Route::post('/store', [ProductController::class, 'store'])->name('store'); //->middleware('is_admin')
            Route::get('/show/{id}', [ProductController::class, 'show'])->name('show');
            Route::post('/update/{id}', [ProductController::class, 'update'])->name('update'); //->middleware('is_admin')
            Route::delete('/delete/{id}', [ProductController::class, 'destroy'])->name('delete');  //->middleware('is_admin')
        });



        Route::group(['prefix' => 'product-image'], function () {
            Route::get('/', [ProductImageController::class, 'index']);
            Route::post('/store', [ProductImageController::class, 'store'])->name('store'); //->middleware('is_admin')
            Route::get('/show/{id}', [ProductImageController::class, 'show'])->name('show');
            Route::post('/update/{id}', [ProductImageController::class, 'update'])->name('update'); //->middleware('is_admin')
            Route::delete('/delete/{id}', [ProductImageController::class, 'destroy'])->name('delete');  //->middleware('is_admin')
        });


    });
});
