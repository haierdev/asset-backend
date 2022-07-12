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

//API route for register new user
Route::post('/register', [App\Http\Controllers\API\AuthController::class, 'register']);
//API route for login user
Route::post('/login', [App\Http\Controllers\API\AuthController::class, 'login']);
Route::fallback(function () {
    return response()->json(
        [
            'status' => '405',
            'message' => 'Method Not Allowed',
        ], 405);
    // return view('errors.404');  // incase you want to return view
});
//Protecting Routes
Route::group(['middleware' => ['auth:api']], function () {
    Route::get('/profile', function(Request $request) {
        return auth()->user();
    });
    //API route for MasterLokasi
    Route::resource('location', App\Http\Controllers\API\LocationController::class)
                    ->missing(function (Request $request) {
                        return response()->json([
                            'status' => '404',
                            'message' => 'Data Not Found',
                        ], 404); 
                    });
    Route::resource('parent_location', App\Http\Controllers\API\ParentLocationController::class)
                    ->missing(function (Request $request) {
                        return response()->json([
                            'status' => '404',
                            'message' => 'Data Not Found',
                        ], 404); 
                    });
    Route::resource('category', App\Http\Controllers\API\CategoryController::class)
                    ->missing(function (Request $request) {
                        return response()->json([
                            'status' => '404',
                            'message' => 'Data Not Found',
                        ], 404); 
                    });
    Route::resource('vendor', App\Http\Controllers\API\VendorController::class)
                    ->missing(function (Request $request) {
                        return response()->json([
                            'status' => '404',
                            'message' => 'Data Not Found',
                        ], 404); 
                    });
    Route::resource('cost', App\Http\Controllers\API\CostController::class)
                    ->missing(function (Request $request) {
                        return response()->json([
                            'status' => '404',
                            'message' => 'Data Not Found',
                        ], 404); 
                    });
    Route::resource('dept', App\Http\Controllers\API\DeptController::class)
                    ->missing(function (Request $request) {
                        return response()->json([
                            'status' => '404',
                            'message' => 'Data Not Found',
                        ], 404); 
                    });
    Route::resource('condition', App\Http\Controllers\API\ConditionController::class)
                    ->missing(function (Request $request) {
                        return response()->json([
                            'status' => '404',
                            'message' => 'Data Not Found',
                        ], 404); 
                    });
    // API route for logout user
    Route::post('/logout', [App\Http\Controllers\API\AuthController::class, 'logout']);
});
