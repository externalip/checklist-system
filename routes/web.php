<?php

use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\AuditController;
use App\Http\Controllers\CheckSheetController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ModelController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
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

Route::get('/Login', function () {
    return Inertia::render('Auth/Login', [
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// Registration Page
Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('register');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::middleware(['permission:dashboard'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    });

    Route::middleware(['permission:users'])->group(function () {
        Route::prefix('roles')->group(function () {
            Route::get('/', [RoleController::class, 'index'])->name('roles.index');
            Route::get('/create', [RoleController::class, 'create'])->name('roles.create');
            Route::post('/', [RoleController::class, 'store'])->name('roles.store');
            Route::get('/{id}/edit', [RoleController::class, 'edit'])->name('roles.edit');
            Route::put('/{id}', [RoleController::class, 'update'])->name('roles.update');
            Route::delete('/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');
        });

        // User Manager Page
        Route::prefix('Users')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('users');
            Route::get('/create', [UserController::class, 'create'])->name('users.create');
            Route::post('/', [UserController::class, 'store'])->name('users.store');
            Route::get('/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
            Route::put('/{user}', [UserController::class, 'update'])->name('users.update');
            Route::delete('/{user}', [UserController::class, 'destroy'])->name('users.destroy');
        });
    });

    Route::middleware(['permission:models'])->group(function () {
        // Model Manager Page
        Route::prefix('Models')->group(function () {
            Route::get('/', [ModelController::class, 'index'])->name('models.index');
            Route::get('/{id}/edit', [ModelController::class, 'edit'])->name('models.edit');
            Route::post('/', [ModelController::class, 'store'])->name('models.store');
            Route::put('/{id}', [ModelController::class, 'update'])->name('models.update');
            Route::delete('/', [ModelController::class, 'destroy'])->name('models.destroy');
        });
    });

    // Audit Trail Page
    Route::middleware(['permission:audit'])->group(function () {
        Route::get('/audit', [AuditController::class, 'index'])->name('audit');
    });

    Route::middleware(['permission:view-checklist'])->group(function () {

        //Forms
        Route::get('Forms/{id}', [CheckSheetController::class, 'Form'])->name('showForm');
        // Form Submission Function
        Route::post('/submit', [ResponseController::class, 'storeResponse'])->name('FormSubmission');
    });

    Route::middleware(['permission:manage-checksheet'])->group(function () {
        // Form Creator/Generator
        Route::prefix('/generate')->group(function () {
            Route::get('/', [CheckSheetController::class, 'create'])->name('generate');
            Route::post('/', [CheckSheetController::class, 'store'])->name('generate.store');
            Route::put('/', [CheckSheetController::class, 'update'])->name('generate.update');
        });

        // Form Editor
        Route::prefix('/checksheet')->group(function () {
            // Show Check Sheets Table
            Route::get('/', [CheckSheetController::class, 'index'])->name('checksheet');

            // Save Form Changes
            Route::put('/edit', [CheckSheetController::class, 'update'])->name('checksheet.update');

            //edit based on id
            Route::get('/edit/{id}', [CheckSheetController::class, 'edit'])->name('checksheet.edit');

            // Delete Check Sheet
            Route::delete('/delete', [CheckSheetController::class, 'destroy'])->name('checksheet.delete');
        });
    });

    Route::middleware(['permission:pending-reports'])->group(function () {
        // Pending Reports Page
        Route::prefix('/Pending-Reports')->group(function () {
            Route::get('/', [ReportController::class, 'index'])->name('Pending-Reports');
            Route::put('/{status}/{id}', [ReportController::class, 'update'])->name('Pending-Reports.update');
        });
    });

    Route::middleware(['permission:archives'])->group(function () {
        //Archives
        Route::get('/Archives', [ArchiveController::class, 'index'])->name('archives');
    });

    Route::middleware(['permission:user-manual'])->group(function () {
        // User Manual
        Route::get('/UserManual', [UserController::class, 'showUserManual'])->name('UserManual');
    });

    // Exports
    Route::get('users/export/', [UserController::class, 'exportUsers']);
    Route::get('models/export/', [UserController::class, 'exportModels']);

    // Route::middleware(['permission:revision'])->group(function () {
        // Revision History
        Route::get('/revision/{id}', [CheckSheetController::class, 'showRevision'])->name('revision');

        // DCC
        Route::get('/dcc', [UserController::class, 'showPendingApproval'])->name('dcc');
    // });

    Route::get('/audit/{auditId}/view', [AuditController::class, 'viewDataProperties'])->name('audit.data.view');
});

route::get('/test/{id}', [CheckSheetController::class, 'draftForm']);
