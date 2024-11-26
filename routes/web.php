<?php

use App\Http\Controllers\JadwalController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::resource('jadwal', JadwalController::class)->middleware('auth');
Route::resource('task', TaskController::class)->middleware('auth');

Route::put('/jadwal/{id}/update-status', [JadwalController::class, 'updateStatus'])->name('jadwal.update-status');
Auth::routes();

Route::get('/', [JadwalController::class, 'index'])->name('jadwal.index')->middleware('auth');
