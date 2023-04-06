<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TimeLogController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin All Routes
Route::controller(AdminController::class)->group(function () {
    Route::get('/admin/logout', 'destroy')->name('admin.logout');
    Route::get('/admin/profile', 'profile')->name('admin.profile');
    Route::get('/edit/profile', 'EditProfile')->name('edit.profile');
    Route::post('/store/profile', 'StoreProfile')->name('store.profile');

    Route::get('/change/password', 'ChangePassword')->name('change.password');
    Route::post('/update/password', 'UpdatePassword')->name('update.password');
});


Route::middleware('auth')->group(function () {

	// Route to display a list of all time logs for the authenticated user
    Route::get('/timelogs', [TimeLogController::class, 'index'])->name('timelog.index');

    // Route to display the time log creation form
    Route::get('/timelogs/create', [TimeLogController::class, 'create'])->name('timelog.create');

    // Route to handle form submission and create a new time log
    Route::post('/timelogs', [TimeLogController::class, 'store'])->name('timelog.store');

    // Route to display the edit form for a specific time log
    Route::get('/timelogs/{timelog}/edit', [TimeLogController::class, 'edit'])->name('timelog.edit');

    // Route to handle form submission and update a specific time log
    Route::put('/timelogs/{timelog}', [TimeLogController::class, 'update'])->name('timelog.update');

    // Route to handle deleting a specific time log
    Route::delete('/timelogs/delete/{id}', [TimeLogController::class, 'destroy'])->name('timelog.delete');


    // Project All Routes
Route::controller(ProjectController::class)->group(function () {
Route::get('/projects', 'index')->name('projects.index');
Route::get('/project/create',  'create')->name('project.create');
Route::get('/projects/{id}',  'show')->name('project.show');
Route::post('/project/store', 'store')->name('project.store');
Route::get('/project/edit/{id}', 'edit')->name('project.edit');
Route::put('/project/update/{id}', 'update')->name('project.update');
Route::delete('/project/delete/{id}', 'destroy')->name('project.delete');
});


// Task All Routes
Route::controller(TaskController::class)->group(function () {
Route::get('/tasks',  'index')->name('task.index');
Route::get('/tasks/create',  'create')->name('task.create');
Route::post('/tasks',  'store')->name('projects.tasks.store');
Route::get('/tasks/{id}',  'show')->name('task.show');
Route::get('/tasks/{id}/edit',  'edit')->name('task.edit');
Route::put('/tasks/{id}',  'update')->name('task.update');
Route::delete('/tasks/{id}',  'destroy')->name('task.destroy');
});

});


require __DIR__.'/auth.php';
