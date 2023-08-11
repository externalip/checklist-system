<?php

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
Route::get('/users', [UserController::class, 'AccountManager']);
Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('register');
Route::get('/5S-Checklist', [UserController::class, 'show5SForm'])->name('5S-Checklist');


Route::Get('/Test', function () {
    return Inertia::render('AccountManager/Components/EditUserModal');
});

Route::get('users', [UserController::class, 'index'])
    ->name('users')
    ->middleware('auth');
Route::get('users/create', [UserController::class, 'create'])
    ->name('users.create')
    ->middleware('auth');
Route::post('users', [UserController::class, 'store'])
    ->name('users.store')
    ->middleware('auth');
Route::get('users/{id}/edit', [UserController::class, 'edit'])
    ->name('users.edit', ['id' => 'id'])
    ->middleware('auth');
Route::put('users/{user}', [UserController::class, 'update'])
    ->name('users.update')
    ->middleware('auth');
Route::delete('users/{user}', [UserController::class, 'destroy'])
    ->name('users.destroy', ['user' => 'user'])
    ->middleware('auth');
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
