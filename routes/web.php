<?php

use App\Http\Controllers\ResponseController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FormGeneratorController;
use App\Http\Controllers\AuditController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ModelController;
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

// Login Page
Route::get('/', function () {
    return Inertia::render('Auth/Login', [
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

    // Create Check Sheet Page
    Route::get('/generate', [FormGeneratorController::class, 'index'])->name('generate');

    // Audit Trail Page
    Route::get('/audit', [AuditController::class, 'index'])->name('audit');

    // Pending Reports Page
    Route::prefix('/Pending-Reports')->group(function () {
        Route::get('/', [ReportController::class, 'index'])->name('Pending-Reports');
        Route::put('/{status}/{id}', [ReportController::class, 'update'])->name('Pending-Reports.update');
    });
    
    // Model Manager Page
    Route::get('Models', function () {
        return Inertia::render('Models/Index', [
            'Forms' => \App\Models\Form::all(),
        ]);
    })->name('models.index');

    // Form Submission Function
    Route::post('/submit-response', [ResponseController::class, 'store']);
    Route::post('/ModelManager/Add', [ModelController::class, 'store'])->name('models.store');
});
