<?php

use App\Http\Controllers\EmployeeAttendanceController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('attendances/export', [EmployeeAttendanceController::class, 'reports'])->name('attendances.export');
Route::resource('attendances', EmployeeAttendanceController::class);
