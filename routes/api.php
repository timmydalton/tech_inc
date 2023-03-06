<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CategoriesController;

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

Route::get('/user/all', function() {
  $user = DB::table('users')->select('id', 'name', 'email') -> get();
  return Response::json($user, 200);
});

Route::prefix('account')->group(function() {
  Route::get('/login_token', [AccountController::class, 'get_account_by_token']);
  Route::post('/create', [AccountController::class, 'create_account']);
  Route::post('/login', [AccountController::class, 'handle_login']);
  Route::post('/update_info', [AccountController::class, 'update_info']);
});
Route::prefix('categories')->group(function() {
  Route::get('/all', [CategoriesController::class, 'get_all']);
});

Route::fallback(function(){
  return response()->json([
    'message' => 'Page Not Found.'], 404);
})->where('any', '.*');
