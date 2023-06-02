<?php

use App\Http\Controllers\JobsController;
use App\Http\Controllers\SalariesController;
use App\Http\Controllers\SpecialistsController;
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
    $salaries = \App\Models\salary::query()->get()->sortByDesc('amount_of_hours');
    $specialists = \App\Models\specialist::query()->get();
    return view('admin.rank', compact('salaries', 'specialists'));
});
Route::prefix('specialists')->name('specialists.')->group(function (){
    Route::get('',[SpecialistsController::class, 'index'])->name('index');
    Route::get('create', [SpecialistsController::class, 'create'])->name('create');
    Route::post('', [SpecialistsController::class, 'store'])->name('store');
    Route::get('{specialist}/edit', [SpecialistsController::class, 'edit'])->whereNumber('specialist')->name('edit');
    Route::put('{specialist}', [SpecialistsController::class, 'update'])->name('update');
    Route::delete('{specialist}', [SpecialistsController::class, 'destroy'])->name('destroy');
});
Route::prefix('jobs')->name('jobs.')->group(function (){
    Route::get('',[JobsController::class, 'index'])->name('index');
    Route::get('create', [JobsController::class, 'create'])->name('create');
    Route::post('', [JobsController::class, 'store'])->name('store');
});
Route::prefix('salary')->name('salary.')->group(function(){
   Route::get('',[SalariesController::class, 'show'])->name('show');
});
