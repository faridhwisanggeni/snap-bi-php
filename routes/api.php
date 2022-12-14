<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/**
 * route "/register"
 * @method "POST"
 */
Route::post('/register', App\Http\Controllers\Api\RegisterController::class)->name('register');

/**
 * route "/signature"
 * @method "POST"
 */
Route::post('/v1.0/utilities/signature-auth', App\Http\Controllers\Api\SNAPSignatureController::class)->name('signature');


/**
 * route "/login"
 * @method "POST"
 */
Route::post('/v1.0/access-token/b2b', App\Http\Controllers\Api\SNAPB2BController::class)->name('b2b');

/**
 * route "/login"
 * @method "POST"
 */
Route::post('/v1.0/debit/notify', App\Http\Controllers\Api\SNAPDirectDebitPaymentNotifyController::class)->name('paymentnotif');

/**
 * route "/user"
 * @method "GET"
 */
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
