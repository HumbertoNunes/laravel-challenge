<?php

use App\Http\Controllers\ApplyController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ProfileController;
use App\Models\Job;
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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth', 'verified', 'profile.completed'])->group(function () {
    Route::get('/dashboard', fn () => to_route('job.index'))->name('dashboard');

    Route::get('/jobs', [JobController::class, 'index'])->name('job.index');

    Route::get('/jobs/create', [JobController::class, 'create'])->name('job.create');
    Route::post('/jobs', [JobController::class, 'store'])->name('job.store');
    Route::post('/jobs/{job}/apply', ApplyController::class)->name('job.apply');
    Route::delete('/jobs/{job}', [JobController::class, 'destroy'])->name('job.destroy');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/candidate/profile', [CandidateController::class, 'store'])->name('candidate.profile.store');
    Route::patch('/candidate/profile', [CandidateController::class, 'update'])->name('candidate.profile.update');

    Route::post('/companies', CompanyController::class)->name('company.store');

    Route::post('/employee/profile', [EmployeeController::class, 'store'])->name('employee.profile.store');
    Route::patch('/employee/profile', [EmployeeController::class, 'update'])->name('employee.profile.update');
});

require __DIR__.'/auth.php';
