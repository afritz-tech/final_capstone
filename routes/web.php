<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\ContentHubController;
use App\Http\Controllers\DashboardController;

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

Route::get ('/', [PageController::class, 'page']);
Route::get ('about', [PageController::class, 'about']);
Route::get ('hub', [PageController::class, 'hub']);
Route::get ('contact', [PageController::class, 'contact']);

Route::get ('login', [AuthController::class, 'login']);
Route::post ('login', [AuthController::class, 'auth_login']);

Route::get ('register', [AuthController::class, 'register']);
Route::post ('register', [AuthController::class, 'create']);
Route::get ('verify/{token}', [AuthController::class, 'verify']);


Route::get ('forgot-pass', [AuthController::class, 'forgot']);
Route::post ('forgot-pass', [AuthController::class, 'forgot_password']);

Route::get ('reset/{token}', [AuthController::class, 'reset']);
Route::post ('reset/{token}', [AuthController::class, 'post_reset']);

Route::get ('logout', [AuthController::class, 'logout']);


Route::group(['middleware' => 'admin'], function() {

    Route::get ('panel/user/list', [UserController::class, 'user']);
    Route::get ('panel/user/add', [UserController::class, 'add']);
    Route::post ('panel/user/add', [UserController::class, 'insert']);
    Route::get ('panel/user/edit{id}', [UserController::class, 'edit']);
    Route::post ('panel/user/edit{id}', [UserController::class, 'update']);
    Route::get (' panel/user/delete{id}', [UserController::class, 'delete']);


    Route::get ('panel/category/list', [CategoryController::class, 'category']);
    Route::get ('panel/category/add', [CategoryController::class, 'add_category']);
    Route::post ('panel/category/add', [CategoryController::class, 'insert_category']);
    Route::get ('panel/category/edit{id}', [CategoryController::class, 'edit_category']);
    Route::post ('panel/category/edit{id}', [CategoryController::class, 'update_category']);
    Route::get (' panel/category/delete{id}', [CategoryController::class, 'delete_category']);


});

Route::group(['middleware' => 'authuser'], function() {

    Route::get ('panel/change-password', [UserController::class, 'ChangePassword']);
    Route::post ('panel/change-password', [UserController::class, 'UpdatePassword']);

    Route::get ('panel/account_setting', [UserController::class, 'AccountSetting']);
    Route::post ('panel/account_setting', [UserController::class, 'UpdateAccountSetting']);

    Route::get ('panel/dashboard', [DashboardController::class, 'dashboard']);

    Route::get ('panel/hub/list', [ContentController::class, 'hub']);
    Route::get ('panel/hub/add', [ContentController::class, 'add_hub']);
    Route::post ('panel/hub/add', [ContentController::class, 'insert_hub']);
    Route::get ('panel/hub/edit{id}', [ContentController::class, 'edit_hub']);
    Route::post ('panel/hub/edit{id}', [ContentController::class, 'update_hub']);
    Route::get (' panel/hub/delete{id}', [ContentController::class, 'delete_hub']);

    Route::post ('comment-submit', [PageController::class, 'submit']);
    Route::post ('comment-reply-submit', [PageController::class, 'ReplySubmit']);


});

Route::get ('{slug}', [PageController::class, 'contentdetail']);

