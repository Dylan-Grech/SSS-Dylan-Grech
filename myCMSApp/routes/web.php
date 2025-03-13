<?php

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
    return redirect('/colleges');
});

Route::get('/colleges', [CollegeController::class, 'index'])->name('colleges.index');

Route::get('/colleges/create', [CollegeController::class, 'create'])->name('colleges.create');

Route::get('colleges/{id}/edit', [CollegeController::class, 'edit'])->name('colleges.edit');

Route::put('colleges/{id}', [CollegeController::class, 'update'])->name('colleges.update');

Route::post('colleges', [CollegeController::class, 'store'])->name('colleges.store');

Route::get('/students', [StudentController::class, 'index'])->name('students.index');

Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');

Route::post('/students', [StudentController::class, 'store'])->name('students.store');

Route::get('students/{id}/edit', [StudentController::class, 'edit'])->name('students.edit');

Route::put('students/{id}', [StudentController::class, 'update'])->name('students.update');

Route::delete('students/{id}', [StudentController::class, 'delete'])->name('students.delete');
