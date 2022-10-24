<?php
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\NoteController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//when you make get request at /test then you go to specific contriller and then a methed inside this controller "index"
Route::get('/test/{name}',[CustomersController::class,'index']);

Route::get('customers', [CustomersController::class,'index']);

Route::post('customers',[CustomersController::class,'create']);

Route::patch('customer/{id}', [CustomersController::class,'update']);

Route::delete('customer/{id}', [CustomersController::class,'delete']);

Route::get('customer/{id}', [CustomersController::class,'show']);



Route::get('customers/{customerId}/notes/{id}', [NoteController::class,'show']);
Route::post('customers/{customerId}/notes',[NoteController::class,'create']);
Route::patch('customers/{customerId}/notes/{id}', [NoteController::class,'update']);
Route::delete('customers/{customerId}/notes/{id}', [NoteController::class,'delete']);
Route::get('customers/{customerId}/notes', [NoteController::class,'index']);

