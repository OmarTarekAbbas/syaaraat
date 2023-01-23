<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Users\Controllers\Admin\UsersController;
use App\Modules\Users\Controllers\Site\Auth\LoginController;
use App\Modules\Users\Controllers\Site\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| Coupons Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your admin "back office/dashboard" application.
| Please note that this file is auto imported in the main routes file, so it will inherit the main "prefix"
| and "namespace", so don't edit it to add for example "admin" as a prefix.
|
| Also, all routes have `admin.` as route name prefix so it prevents the duplicate routes conflict.
|
| If route method is set to restfulApi() then api resource is patchable therefore a PATCH handler
| method is added automatically to RestfulApiController, the additional route will be Route::patch('/module', [ControllerClass::class, 'patch'])
*/

Route::Resource("users",  UsersController::class);
Route::get("home",  [UsersController::class, 'home']);

// user register
Route::get('register', [RegisterController::class, 'register']);
Route::post('register', [RegisterController::class, 'create'])->name('register');

//user login
Route::get('login', [LoginController::class, 'login']);
Route::post('login', [LoginController::class, 'findForLogin']);
