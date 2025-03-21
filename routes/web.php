<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SystemManagementController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Carbon\Carbon;
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



Route::controller(LoginController::class)->group(function () {
    Route::get('/', 'login')->name('login');
    Route::post('login_function', 'login_function')->name('login_function');
    Route::get('logout', 'logout')->name('logout');
});



Route::controller(CategoryController::class)->group(function () {
    Route::post('add_category', 'add_category')->name('add_category');
    Route::get('categories_data', 'categories_data')->name('categories_data');
    Route::post('edit_category', 'edit_category')->name('edit_category');
    Route::get('delete_category/{id}', 'delete_category')->name('delete_category');

});

Route::controller(SystemManagementController::class)->group(function () {
    Route::post('add_system', 'add_system')->name('add_system');
    Route::get('get_system_data', 'get_system_data')->name('get_system_data');
    Route::post('edit_system', 'edit_system')->name('edit_system');
    Route::get('delete_system/{id}', 'delete_system')->name('delete_system');

});


//pages authenticated
Route::middleware(['auth'])->group(function () {
    route::get('category_management', [CategoryController::class, 'category_management'])->name('category_management');
    Route::get('ict_lib_dashboard', [UserController::class, 'ict_lib_dashboard'])->name('ict_lib_dashboard');
    Route::get('system_management', [SystemManagementController::class, 'system_management'])->name('system_management');
    Route::get('user_management', [UserController::class, 'user_management'])->name('user_management');
    Route::get('file_management', [FileController::class, 'file_management'])->name('file_management');

});


Route::controller(UserController::class)->group(function () {
    Route::post('get_department', 'get_department')->name('get_department');
    Route::post('get_position', 'get_position')->name('get_position');
    Route::get('get_users', 'get_users')->name('get_users');
    Route::post('add_users', 'add_users')->name('add_users');
    Route::get('retrieve_user/{id}', 'retrieve_user')->name('retrieve_user');
    Route::get('delete_user/{id}', 'delete_user')->name('delete_user');
    Route::post('edit_users', 'edit_users')->name('edit_users');
});
Route::controller(FileController::class)->group(function () {
    Route::post('get_categories_data', 'get_categories_data')->name('get_categories_data');
    Route::post('get_systems_data', 'get_systems_data')->name('get_systems_data');
    Route::post('upload_file', 'upload_file')->name('upload_file');
    Route::get('get_files_data', 'get_files_data')->name('get_files_data');
});

Route::get('array', [SystemManagementController::class, 'array'])->name('array');

Route::get('calendar', function () {
    return view('calendar');
});





Route::controller(TaskController::class)->group(function () {

    Route::get('get_task_data', 'get_task_data')->name('get_task_data');
    Route::post('add_task', 'add_task')->name('add_task');
    Route::post('get_users_data', 'get_users_data')->name('get_users_data');
    Route::post('get_scope_data', 'get_scope_data')->name('get_scope_data');

});



