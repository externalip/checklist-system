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

//Model Manager Multiselect Autocomplete
Route::get('/model-names/{query}', [\App\Http\Controllers\ModelController::class, 'limitedModelNames'])->name('api.model-limitedModelNames');
Route::get('/model-names', [\App\Http\Controllers\ModelController::class, 'getModelNames'])->name('api.model-ModelNames');

//Personnel Manager Multiselect Autocomplete
Route::get('/user-usernames/{query}', [\App\Http\Controllers\UserController::class, 'limitedUsernameOptions'])->name('api.user-limitedUsernames');
Route::get('/user-usernames', [\App\Http\Controllers\UserController::class, 'usernameOptions'])->name('api.user-Usernames');
Route::get('/user-names/{query}', [\App\Http\Controllers\UserController::class, 'limitedNameOptions'])->name('api.user-limitedNames');
Route::get('/user-names', [\App\Http\Controllers\UserController::class, 'nameOptions'])->name('api.user-Names');

//Checksheet Manager Multiselect Autocomplete
Route::get('/checksheet-names/{query}', [\App\Http\Controllers\CheckSheetController::class, 'limitedChecksheetOptions'])->name('api.checksheet-limitedChecksheet');
Route::get('/checksheet-names', [\App\Http\Controllers\CheckSheetController::class, 'checksheetOptions'])->name('api.checksheet');
