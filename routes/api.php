<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
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

Route::post('/login' , [AuthController::class, 'login' ]);
Route::get ('/logout', [AuthController::class, 'logout']);
Route::post('/register' , [AuthController::class, 'register' ]);

Route::get ('/roles', [RoleController::class, 'index']);
Route::post ('/roles', [RoleController::class, 'store']);
Route::get ('/roles/{id}', [RoleController::class, 'index']);
Route::patch ('/roles/{id}', [RoleController::class, 'update']);
Route::delete ('/roles/{id}', [RoleController::class, 'destroy']);

Route::get ('/users', [UserController::class, 'index']);
Route::post ('/users', [UserController::class, 'store']);
Route::get ('/users/{id}', [UserController::class, 'index']);
Route::patch ('/users/{id}', [UserController::class, 'update']);
Route::delete ('/users/{id}', [UserController::class, 'destroy']);

Route::get ('/categories', [CategoryController::class, 'index']);
Route::post ('/categories', [CategoryController::class, 'store']);
Route::get ('/categories/{id}', [CategoryController::class, 'index']);
Route::patch ('/categories/{id}', [CategoryController::class, 'update']);
Route::delete ('/categories/{id}', [CategoryController::class, 'destroy']);

Route::get ('/products', [ProductController::class, 'index']);
Route::post ('/products', [ProductController::class, 'store']);
Route::get ('/products/{id}', [ProductController::class, 'index']);
Route::patch ('/products/{id}', [ProductController::class, 'update']);
Route::delete ('/products/{id}', [ProductController::class, 'destroy']);
