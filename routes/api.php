<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KanyeQuotesController;

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

Route::get('/kanye', [KanyeQuotesController::class, 'index']);
Route::get('/kanye/refresh', [KanyeQuotesController::class, 'refresh']);

Route::fallback(function(){
    return response()->json([
        'error' => "Endpoint Not Found. Only '/api/kanye' and '/api/kanye/refresh' are available endpoints."
    ], 404);
});
