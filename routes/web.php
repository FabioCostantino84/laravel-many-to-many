<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use App\Models\Project;

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

/* Admin routes */

// aggiungo ->prefix('nome') in questo modo tutte le mie rotte avranno come prefisso il nome che ho scelto
Route::middleware('auth', 'verified')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
    // Tutte queste rotte inizieranno con '/admin/.....'

    Route::resource('projects', ProjectController::class)->parameters(['projects' => 'project:slug']);
});

Route::get('recycle', [ProjectController::class, 'recycle'])->name('project.recycle');

Route::get('project/{id}/restore', [ProjectController::class, 'restore'])->name('admin.projects.restore');



/* Routs Admin Profile */
Route::middleware('auth',)->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
