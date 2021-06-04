<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::get('/needpermissions', function () {
    return view('needpermissions');
})->name('needpermissions');

Route::get('/todolist', [App\Http\Controllers\TaskController::class, 'index'])->name('todolist')->middleware('auth');

Route::get('/users-list', [App\Http\Controllers\UserController::class, 'index'])->name('users.index')->middleware('admin');
Route::get('/users/{user}', [App\Http\Controllers\UserController::class, 'edit'])->name('users.edit')->middleware('admin');
Route::post('/users/{user}', [App\Http\Controllers\UserController::class, 'update'])->name('users.update')->middleware('admin');
Route::delete('/users/{user}', [App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy')->middleware('admin');

Route::get('/projects', [App\Http\Controllers\ProjectController::class, 'index'])->name('projects.index')->middleware('auth');
Route::get('/projects/create', [App\Http\Controllers\ProjectController::class, 'create'])->name('projects.create')->middleware('auth');
Route::get('/projects/{project}', [App\Http\Controllers\ProjectController::class, 'show'])->name('projects.show')->middleware('auth');
Route::get('/projects/{project}/e/{event}', [App\Http\Controllers\ProjectController::class, 'show_e'])->name('projects.show_e')->middleware('auth');
Route::post('/projects', [App\Http\Controllers\ProjectController::class, 'store'])->name('projects.store')->middleware('auth');
Route::get('/projects/edit/{project}', [App\Http\Controllers\ProjectController::class, 'edit'])->name('projects.edit')->middleware('auth');
Route::post('/projects/{project}', [App\Http\Controllers\ProjectController::class, 'update'])->name('projects.update')->middleware('auth');
Route::delete('/projects/{project}', [App\Http\Controllers\ProjectController::class, 'destroy'])->name('projects.destroy')->middleware('auth');
Route::get('/projects/export/{project}', [App\Http\Controllers\ProjectController::class, 'export'])->name('projects.export')->middleware('auth');

Route::get('/actiones/{id}', [App\Http\Controllers\ActionController::class, 'getActiones'])->name('actiones.index')->middleware('auth');
Route::post('/actiones/{id}', [App\Http\Controllers\ActionController::class, 'store'])->name('actiones.store')->middleware('auth');
Route::delete('/actiones/{action}', [App\Http\Controllers\ActionController::class, 'destroy'])->name('actiones.destroy')->middleware('auth');

Route::post('/events/{id}', [App\Http\Controllers\EventController::class, 'store'])->name('events.store')->middleware('auth');
Route::delete('/events/{event}', [App\Http\Controllers\EventController::class, 'destroy'])->name('events.destroy')->middleware('auth');

Route::get('/password/change', [App\Http\Controllers\ChangePasswordController::class, 'edit'])->name('password.editnew')->middleware('auth');
Route::post('/password/change', [App\Http\Controllers\ChangePasswordController::class, 'update'])->name('password.updatenew')->middleware('auth');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
