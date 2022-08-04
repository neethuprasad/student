<?php

use App\Http\Controllers\StudentController;
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

Route::get('/add-student', [StudentController::class, 'studentForm']);
Route::post('/add-student', [StudentController::class, 'addStudent']);
Route::get('/students', [StudentController::class, 'viewStudents']);
Route::get('/edit-student/{id}', [StudentController::class, 'editStudent']);
Route::post('/update-student/{id}', [StudentController::class, 'updateStudent']);
Route::get('/delete-student/{id}', [StudentController::class, 'deleteStudent']);

Route::get('/add-marks', [StudentController::class, 'marksForm']);
Route::post('/add-marks', [StudentController::class, 'addMarks']);
Route::get('/edit-mark/{id}', [StudentController::class, 'editMark']);
Route::get('/marks', [StudentController::class, 'viewMarks']);
Route::post('/update-mark/{id}', [StudentController::class, 'updateMark']);
Route::get('/delete-mark/{id}', [StudentController::class, 'deleteMark']);

Route::get('/', [StudentController::class, 'viewStudents']);
