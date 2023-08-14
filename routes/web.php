<?php

use App\Http\Controllers\ResponseController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),

        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});
Route::get('/accountmanager', [UserController::class, 'AccountManager']);
Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('register');
Route::get('/5S-Checklist', [UserController::class, 'show5SForm'])->name('5S-Checklist');
Route::post('/submit-response', [ResponseController::class, 'store']);

Route::Get('/Test', function () {
    return Inertia::render('AccountManager/Components/EditUserModal');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

// Audit Trail

Route::get('/audit', [\App\Http\Controllers\AuditController::class, 'index'])
    ->name('audit');
