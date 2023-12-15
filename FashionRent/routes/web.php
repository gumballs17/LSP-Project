<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FashionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\RentLogController;
use App\Http\Controllers\FashionRentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;

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

Route::get('/', [PublicController::class, 'index']);
Route::get('fashionlist', [PublicController::class, 'fashionlist']);


Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'authenticating']);
    Route::get('register', [AuthController::class, 'register']);
    Route::post('register', [AuthController::class, 'registerProcess']);
});

Route::middleware('auth')->group(function () {
    Route::get('logout', [AuthController::class, 'logout']);

    Route::get('profile', [UserController::class, 'profile'])->middleware('only_client');

    Route::middleware('only_admin')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index']);

        Route::get('fashions', [FashionController::class, 'index']);
        Route::get('fashion-add', [FashionController::class, 'add']);
        Route::post('fashion-add', [FashionController::class, 'store']);
        Route::get('fashion-edit/{slug}', [FashionController::class, 'edit']);
        Route::put('fashion-edit/{slug}', [FashionController::class, 'update']);
        Route::get('fashion-delete/{slug}', [FashionController::class, 'delete']);
        Route::delete('fashion-delete/{slug}', [FashionController::class, 'destroy']);
        Route::get('fashion-deleted', [FashionController::class, 'deletedfashion']);
        Route::get('fashion-restore/{slug}', [FashionController::class, 'restore']);
        Route::delete('fashion-permanent-delete/{slug}', [FashionController::class, 'permanentDelete']);

        Route::get('categories', [CategoryController::class, 'index']);
        Route::get('category-add', [CategoryController::class, 'add']);
        Route::post('category-add', [CategoryController::class, 'store']);
        Route::get('category-edit/{slug}', [CategoryController::class, 'edit']);
        Route::put('category-edit/{slug}', [CategoryController::class, 'update']);
        Route::get('category-delete/{slug}', [CategoryController::class, 'delete']);
        Route::delete('category-delete/{slug}', [CategoryController::class, 'destroy']);
        Route::get('category-deleted', [CategoryController::class, 'deletedCategory']);
        Route::get('category-restore/{slug}', [CategoryController::class, 'restore']);
        Route::delete('category-permanent-delete/{slug}', [CategoryController::class, 'permanentDelete']);

        Route::get('users', [UserController::class, 'index']);
        Route::get('registered-users', [UserController::class, 'registeredUsers']);
        Route::get('user-detail/{slug}', [UserController::class, 'show']);
        Route::get('user-approve/{slug}', [UserController::class, 'approve']);
        Route::get('user-ban/{slug}', [UserController::class, 'delete']);
        Route::delete('user-ban/{slug}', [UserController::class, 'destroy']);
        Route::get('user-deleted', [UserController::class, 'bannedUsers']);
        Route::get('user-restore/{slug}', [UserController::class, 'restore']);
        Route::delete('user-permanent-ban/{slug}', [UserController::class, 'permanentDelete']);
        Route::get('edit-user/{slug}', [UserController::class, 'edit'])->name('edit-user');
        Route::put('update-user/{slug}', [UserController::class, 'update'])->name('update-user');
        
        Route::get('fashion-rent', [FashionRentController::class, 'index']);
        Route::post('fashion-rent', [FashionRentController::class, 'store']);
        Route::get('rent-logs', [RentLogController::class, 'index']);
        Route::get('fashion-return', [FashionRentController::class, 'returnFashion']);
        Route::get('get-user-fashions/{user_id}', [FashionRentController::class, 'getUserFashions']);
        Route::post('fashion-return', [FashionRentController::class, 'saveReturnFashion']);
    });
});
