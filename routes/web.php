<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InstitutionController;
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

Route::get('dashboard','App\Http\Controllers\InstitutionController@index')->middleware(['auth'])->name('dashboard');


Route::post('dashboard/addInstitution','App\Http\Controllers\InstitutionController@addInstitution');
Route::post('dashboard/addGrade','App\Http\Controllers\GradeController@addGrade');
Route::post('dashboard/addSubject','App\Http\Controllers\SubjectController@addSubject');

require __DIR__.'/auth.php';
