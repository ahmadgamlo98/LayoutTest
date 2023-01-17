<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\AuthController;


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

// Route::get('/', function () {
//     return view('welcome');
// });
/** Contact */
Route::get('/index_contact', [ContactController::class, 'index']);
Route::get('/contact_create', [ContactController::class, 'create']);
Route::post('/save_contact', [ContactController::class, 'saveContact']);
Route::post('/save_contactdepartment', [ContactController::class, 'saveDepartment']);
Route::get('/edit_contact/{id}', [ContactController::class, 'edit']);
Route::get('/choose_department/{id}', [ContactController::class, 'department']);
Route::get('/delete_contact/{id}', [ContactController::class, 'delete']);
Route::get('/index_contactDepartment', [ContactController::class, 'contact_depart']);
Route::get('/index_search', [ContactController::class, 'get_search']);
Route::get('/index_cotdep', [ContactController::class, 'index_contactDepartment']);
Route::get('/export-csv', [ContactController::class, 'exportCSV']);
Route::post('/uploadFile', [ContactController::class, 'uploadFile']);

/** Auth */
Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post'); 
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post'); 
Route::get('dashboard', [AuthController::class, 'dashboard']); 
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

/** Department */
Route::get('/index_department', [DepartmentController::class, 'index']);
Route::get('/department_create', [DepartmentController::class, 'create']);
Route::post('/save_department', [DepartmentController::class, 'saveDepartment']);
Route::get('/edit_department/{id}', [DepartmentController::class, 'edit']);
Route::get('/delete_department/{id}', [DepartmentController::class, 'delete']);