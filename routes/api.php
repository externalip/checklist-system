<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Audit Trail
Route::get('/audit', [\App\Http\Controllers\AuditController::class, 'index'])
    ->name('audit');

Route::get('/TableView', [\App\Http\Controllers\ModelController::class, 'TableView'])
    ->name('TableView');

Route::get('/model-names/{name}', [\App\Http\Controllers\ModelController::class, 'limitedModelNames'])->name('api.limited-model-names');
Route::get('/model-names', [\App\Http\Controllers\ModelController::class, 'getModelNames'])->name('api.model-names');
