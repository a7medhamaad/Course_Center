<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CourseController as ApiCourseController;
use App\Http\Controllers\Api\VideoController;
use App\Http\Controllers\dashboard\CourseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/my-courses', [ApiCourseController::class, 'myCourses']);
    Route::post('/buy-course/{id}', [ApiCourseController::class, 'buy']);
    Route::post('/courses', [ApiCourseController::class, 'store']);
    Route::delete('/courses/{id}', [ApiCourseController::class, 'destroy']);
    Route::post('/courses/{id}/restore', [ApiCourseController::class, 'restore']);
    Route::get('/courses/trashed', [ApiCourseController::class, 'trashed']);
    Route::put('/courses/{id}', [ApiCourseController::class, 'update']);
    Route::post('/videos', [VideoController::class, 'store']);
});

Route::get('/courses', [ApiCourseController::class, 'index']);
Route::get('/courses/{id}', [ApiCourseController::class, 'show']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);