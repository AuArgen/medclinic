<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DepartmentController as AdminDepartmentController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\BuildingController;
use App\Http\Controllers\Admin\FloorController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DocumentationController;
use App\Http\Controllers\MedicController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/documentation', [DocumentationController::class, 'index'])->name('documentation');

// Public routes
Route::get('medics', [MedicController::class, 'index'])->name('medics.index');
Route::get('medics/{medic}', [MedicController::class, 'show'])->name('medics.show');
Route::get('departments', [DepartmentController::class, 'index'])->name('departments.index');
Route::get('departments/{department}', [DepartmentController::class, 'show'])->name('departments.show');

Route::middleware(['auth', 'verified'])->group(function () {
    // Admin routes
    Route::prefix('admin')->name('admin.')->middleware(['admin'])->group(function () {
        Route::resource('users', UserController::class);
        Route::resource('departments', AdminDepartmentController::class);
        Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
        Route::put('settings', [SettingController::class, 'update'])->name('settings.update');
        Route::resource('schedules', ScheduleController::class);
        Route::resource('appointments', \App\Http\Controllers\Admin\AppointmentController::class)->except(['create', 'store']);
        Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
        Route::resource('buildings', BuildingController::class);
        Route::resource('floors', FloorController::class);
        Route::resource('rooms', RoomController::class);
    });

    // Medic routes
    Route::prefix('medic')->name('medic.')->middleware(['medic'])->group(function () {
        Route::get('appointments', [MedicAppointmentController::class, 'index'])->name('appointments.index');
        Route::get('appointments/{appointment}', [MedicAppointmentController::class, 'show'])->name('appointments.show');
        Route::put('appointments/{appointment}', [MedicAppointmentController::class, 'update'])->name('appointments.update');
    });

    // User appointments routes
    Route::get('medics/{medic}/book', [AppointmentController::class, 'create'])->name('appointments.create');
    Route::post('appointments', [AppointmentController::class, 'store'])->name('appointments.store');
    Route::get('my-appointments', [AppointmentController::class, 'myAppointments'])->name('appointments.my');

    // Messaging routes
    Route::get('messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('messages/{user}', [MessageController::class, 'show'])->name('messages.show');
    Route::post('messages/{user}', [MessageController::class, 'store'])->name('messages.store');
});

// Default dashboard route for authenticated users
Route::get('/dashboard', function () {
    if (Auth::user()->role === 'admin') {
        return redirect()->route('admin.users.index');
    } elseif (Auth::user()->role === 'medic') {
        return redirect()->route('medic.appointments.index');
    } else {
        return view('dashboard');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
require __DIR__.'/profile.php';
