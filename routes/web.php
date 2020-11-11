<?php

use App\Events\MessagePosted;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\ChallengeController;
use App\Http\Controllers\MessageController;
use App\Models\Message;

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

Auth::routes();

Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index']);
Route::get('/login', [LoginController::class, 'getLogin']);
Route::post('/authenticate', [LoginController::class, 'authenticate']);
Route::get('/logout', [LoginController::class, 'logout']);

Route::get('/users/show/{id}', [UserController::class, 'show']);
Route::get('/users/profile', [UserController::class, 'getProfile']);
Route::post('/users/updateProfile', [UserController::class, 'updateProfile']);
Route::get('/users/test', [UserController::class, 'test']);

Route::get('/students', [UserController::class, 'getAllStudents']);
Route::post('/students', [UserController::class, 'getStudents']);
Route::get('/students/create', [UserController::class, 'create']);
Route::post('/students/store', [UserController::class, 'store']);
Route::get('/students/edit/{id}', [UserController::class, 'edit']);
Route::post('/students/update/{id}', [UserController::class, 'update']);
Route::get('/students/delete/{id}', [UserController::class, 'destroy']);

Route::get('/teachers', [UserController::class, 'getAllTeachers']);

Route::get('/assignment', [AssignmentController::class, 'index']);
Route::get('/assignment/create', [AssignmentController::class, 'create']);
Route::post('/assignment/upload', [AssignmentController::class, 'upload']);
Route::get('/assignment/download/{id}', [AssignmentController::class, 'download']);
Route::get('/assignment/delete/{id}', [AssignmentController::class, 'destroy']);

Route::get('/submission/assignment/{id}', [SubmissionController::class, 'index']);
Route::get('/submission/create/{id}', [SubmissionController::class, 'create']);
Route::post('/submission/upload/{id}', [SubmissionController::class, 'upload']);
Route::get('/submission/download/{id}', [SubmissionController::class, 'download']);

Route::get('/challenges', [ChallengeController::class, 'index']);
Route::get('/challenges/create', [ChallengeController::class, 'create']);
Route::post('/challenges/upload', [ChallengeController::class, 'upload']);
Route::get('/challenges/download/{id}', [ChallengeController::class, 'download']);
Route::get('/challenges/delete/{id}', [ChallengeController::class, 'destroy']);
Route::post('/challenges/answer/{id}', [ChallengeController::class, 'answer']);
Route::get('/challenges/result', [ChallengeController::class, 'result']);

Route::get('/messagebox/{sender_id}/{receiver_id}', [MessageController::class, 'index']);
Route::post('/messagebox/send', [MessageController::class, 'store']);
Route::post('/messagebox/update/{id}', [MessageController::class, 'update']);
Route::get('/messagebox/delete/{id}', [MessageController::class, 'destroy']);



Route::get('/getUserLogin', function() {
	return Auth::user();
});
Route::view('/chat', 'chat')->middleware('auth');;
Route::get('/messages', [MessageController::class, 'index']);
Route::post('/messages', [MessageController::class, 'store']);
