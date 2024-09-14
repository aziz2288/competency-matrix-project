<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TechController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\DurationController;
use App\Http\Controllers\HomeController;

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

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/ajouter', [UserController::class,'add']);
Route::post('/ajouter', [UserController::class,'store']);
Route::get('/update/{id}', [UserController::class,'edit']);
Route::post('/update', [UserController::class, 'update'])->name('update');
Route::get('/delete/{id}', [UserController::class, 'destroy'])->name('delete');
Route::get('/user-managment', [UserController::class,'index']);
Route::get('/user/information/{id}', [UserController::class, 'showInformation']);


Route::get('/tech-managment', [TechController::class,'index'])->name('techManagement');
Route::get('/ajouterTech',[TechController::class,'add'])->name('ajouterTech');
Route::post('/ajouterTech',[TechController::class,'store'])->name('ajouterTech');
Route::get('/tech/{id}/update', [TechController::class, 'edit'])->name('updateTech');
Route::post('/tech/update', [TechController::class, 'update']);
Route::get('/tech/{id}/delete', [TechController::class, 'destroy'])->name('deleteTech');

Route::get('/notes', [NotesController::class,'index']);
Route::post('/notes', [NotesController::class, 'saveNote'])->name('notes');

Route::get('/projects', [DurationController::class, 'index'])->name('projects.index');
Route::post('/projects/save-duration', [DurationController::class, 'saveDuration'])->name('projects.saveDuration');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/project-managment', [ProjectController::class,'index'])->name('projectManagement');
Route::get('/ajouterProject',[ProjectController::class,'add'])->name('ajouterProject');
Route::post('/ajouterProject',[ProjectController::class,'store'])->name('ajouterProject');
Route::get('/project/{id}/update', [ProjectController::class, 'edit'])->name('updateProject');
Route::post('/project/update', [ProjectController::class, 'update']);
Route::get('/project/{id}/delete', [ProjectController::class, 'destroy'])->name('deleteProject');