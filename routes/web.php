<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SupervisorController;
use App\Http\Controllers\Admin\StatisticController;
use App\Http\Controllers\Admin\SectionController;

use App\Http\Controllers\Admin\transportController;
use App\Http\Controllers\Admin\userController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\ComplaintsController;
use App\Http\Controllers\Admin\TrippController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|


Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/', function () {
    return redirect()->route('login');
});


Route::get('/orders', function () {
    return view('orders');
})->name('admin.orders');

Auth::routes();

Route::get('admin/overview/data', [StatisticController::class, 'getOverviewData'])->name('admin.overview.data');
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::prefix('supervisor')->group(function () {
Route::get('/', [SupervisorController::class, 'index'])->name('supervisors.index');
Route::get('/create', [SupervisorController::class,'create'])->name('supervisors.create');
Route::post('/store', [SupervisorController::class, 'store'])->name('supervisors.store');
Route::delete('/delete/{id}', [SupervisorController::class, 'destroy'])->name('supervisors.destroy');
Route::get('/edit/{id}',[SupervisorController::class, 'edit'])->name('supervisors.edit');
Route::put('/update/{id}', [SupervisorController::class, 'update'])->name('supervisors.update');
});
Route::prefix('section')->group(function () {
Route::get('/', [SectionController::class, 'index'])->name('sections.index');
Route::get('/create', [SectionController::class,'create'])->name('sections.create');
Route::post('/store', [SectionController::class, 'store'])->name('sections.store');
Route::delete('/delete/{section}', [SectionController::class, 'destroy'])->name('sections.destroy');
Route::get('/edit/{id}',[SectionController::class, 'edit'])->name('sections.edit');
Route::put('/update/{id}', [SectionController::class, 'update'])->name('sections.update');
});
Route::prefix('transport')->group(function () {
Route::get('/', [transportController::class, 'index'])->name('transport.index');
Route::get('/create', [transportController::class,'create'])->name('transport.create');
Route::post('/store', [transportController::class, 'store'])->name('transport.store');
Route::delete('/delete/{section}', [transportController::class, 'destroy'])->name('transport.destroy');
Route::get('/edit/{id}',[transportController::class, 'edit'])->name('transport.edit');
Route::put('/update/{id}', [transportController::class, 'update'])->name('transport.update');
});
Route::prefix('user')->group(function () {
Route::get('/', [userController::class, 'index'])->name('users.index');
Route::get('/showblocked', [userController::class, 'showblock'])->name('users.showblock');
Route::post('/block/{id}', [userController::class, 'block'])->name('users.block');
Route::delete('/delete/{user}', [userController::class, 'destroy'])->name('users.destroy');
Route::post('/showunblock/{id}', [userController::class, 'unblock'])->name('users.unblock');
});
Route::prefix('employee')->group(function () {
    Route::get('/', [EmployeeController::class, 'index'])->name('employees.index');
    Route::get('/upgrade/{id}', [EmployeeController::class, 'upgrade'])->name('employees.upgrade');
    Route::delete('/delete/{id}', [EmployeeController::class, 'destroy'])->name('employees.destroy');
});
Route::get('/complaint', [ComplaintsController::class, 'index'])->name('complaints.index');
Route::get('/trips/{id}', [TrippController::class, 'index'])->name('trips.index');