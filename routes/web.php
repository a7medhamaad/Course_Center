<?php

use App\Http\Controllers\Api\VideoController;
use App\Http\Controllers\dashboard\AdminController;
use App\Http\Controllers\dashboard\CategoryController;
use App\Http\Controllers\dashboard\CourseController;
use App\Http\Controllers\dashboard\PaymentController;
use App\Http\Controllers\dashboard\UserController;
use App\Http\Controllers\dashboard\VideoController as DashboardVideoController;
use App\Http\Controllers\Front\CourseFrontController;
use App\Http\Controllers\Front\ProfileeController;
use App\Http\Controllers\Front\WelcomeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController as ControllersUserController;
use Illuminate\Support\Facades\Auth;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [WelcomeController::class, 'index'])->name('home');

// this Auth::routes for route for login and register and logout
Auth::routes();

// Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::group([
    'middleware'=>['auth','role:admin'],
    // 'middleware'=>['auth','role:user'],
    // 'middleware'=>['auth'],
    'as'=>'dashboard.',
    'prefix'=>'dashboard',
],function(){
    Route::resource('/admin', AdminController::class); 
    Route::resource('/courses', CourseController::class);
    Route::resource('/categories', CategoryController::class);
    Route::get('/course-purchases', [AdminController::class, 'coursePurchases'])->name('purchases');
    Route::get('/videos',[DashboardVideoController::class, 'index'])->name('video');
    Route::get('/videos/create',[DashboardVideoController::class, 'create'])->name('video.create');
    Route::post('/videos/store',[DashboardVideoController::class,'store'])->name('video.store');
    Route::delete('/videos/{id}',[DashboardVideoController::class, 'destroy'])->name('videos.destroy');
    Route::get('/payments', [PaymentController::class, 'index'])->name('payment');

});

Route::group([
    'middleware'=>['auth','role:user'],
    // 'middleware'=>['auth','role:user'],
    // 'middleware'=>['auth'],
    'as'=>'users.',
    'prefix'=>'users',
],function(){
    Route::resource('/dashboard', UserController::class);

    // صفحة عرض كل الكورسات
    Route::get('/courses', [CourseFrontController::class, 'index'])->name('courses.index');
    
    // صفحة الشراء (checkout page)
    Route::get('/courses/{course}/checkout', [CourseFrontController::class, 'checkout'])->name('courses.checkout');
    
    // تنفيذ الدفع (Stripe)
    Route::post('/courses/{course}/pay', [CourseFrontController::class, 'pay'])->name('courses.pay');
    
    // كورساتي
    Route::get('/my-courses', [CourseFrontController::class, 'myCourses'])->name('courses.my');
    
    // حذف الاشتراك في كورس
    Route::delete('/my-courses/{course}', [CourseFrontController::class, 'destroy'])->name('my-courses.destroy');
    // web.php
    Route::get('/my-courses/{course}/videos', [CourseFrontController::class, 'show'])->name('my-courses.show');
    Route::get('/notifications', [CourseFrontController::class, 'showNotifications'])->name('notifications');
    
    Route::get('/profile', [ProfileeController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileeController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileeController::class, 'update'])->name('profile.update');

});

Route::get('users/courses', [CourseFrontController::class, 'index'])->name('users.courses.index');
