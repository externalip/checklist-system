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

// Home Page
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),

        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// Registration Page
Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('register');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::prefix('Users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users');
        Route::get('/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/', [UserController::class, 'store'])->name('users.store');
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    });

    // 5S Checklist Form Page
    Route::get('/5S-Checklist', [UserController::class, 'show5SForm'])->name('5S-Checklist');

    // Audit Trail Page
    Route::get('/audit', [\App\Http\Controllers\AuditController::class, 'index'])->name('audit');

    // Pending Reports Page
    Route::prefix('/Pending-Reports')->group(function () {
        Route::get('/', [\App\Http\Controllers\ReportController::class, 'index'])->name('Pending-Reports');
        Route::put('/{id}', [\App\Http\Controllers\ReportController::class, 'update'])->name('Pending-Reports.update');
    });
    
    // Model Manager Page
    Route::get('Models', function () {
        return Inertia::render('Models/Index', [
            'Forms' => \App\Models\Form::all(),
        ]);
    })->name('models.index');

    // Form Submission Function
    Route::post('/submit-response', [ResponseController::class, 'store']);
    Route::post('/ModelManager/Add', [\App\Http\Controllers\ModelController::class, 'store'])->name('models.store');
});
