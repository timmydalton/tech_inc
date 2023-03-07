<?php

use Illuminate\Http\Request;
use Illuminate\Http\Middleware;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\VariationController;

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

Route::post('/upload_asset', [AssetController::class, 'upload_asset']);

Route::prefix('account')->group(function() {
  Route::get('/login_token', [AccountController::class, 'get_account_by_token']);
  Route::post('/create', [AccountController::class, 'create_account']);
  Route::post('/login', [AccountController::class, 'handle_login']);
  Route::post('/update_info', [AccountController::class, 'update_info']);
  Route::post('/change_password', [AccountController::class, 'change_password']);
});
Route::prefix('categories')->group(function() {
  Route::get('/all', [CategoriesController::class, 'get_all']);
});
Route::prefix('product')->group(function() {
  Route::post('/create', [ProductController::class, 'create_product'])->middleware('checkAdmin');
  Route::post('/update', [ProductController::class, 'update_product'])->middleware('checkAdmin');
  Route::post('/delete', [ProductController::class, 'delete_product'])->middleware('checkAdmin');
  Route::get('/all', [ProductController::class, 'index']);
  Route::post('/get_by_id', [ProductController::class, 'get_by_id']);
});
Route::prefix('variation')->group(function() {
  Route::post('/create', [VariationController::class, 'create_variation'])->middleware('checkAdmin');
  Route::post('/update', [VariationController::class, 'update_variation'])->middleware('checkAdmin');
  Route::post('/get_by_product_id', [VariationController::class, 'get_by_product_id'])->middleware('checkAdmin');
});

Route::fallback(function(){
  return response()->json([
    'message' => 'Page Not Found.'], 404);
})->where('any', '.*');
