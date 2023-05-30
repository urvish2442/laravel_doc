<?php

//use App\Http\Controllers\EmailController;
use App\Http\Controllers\HomeController;
//use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\UserSubscriptionController;
use App\Mail\UserDeleteMail;
use Illuminate\Support\Facades\Auth;
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
//    Mail::to('r.urvish@gmail.com')
//        ->send(new UserDeleteMail());
    return view('welcome');

});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('users.index')->middleware('admin');

Route::get('/user/create', [HomeController::class, 'create']);
Route::post('/user/store', [HomeController::class, 'store']);

Route::get('/user/edit/{user}', [HomeController::class, 'edit']);
Route::patch('/user/update/{user}', [HomeController::class, 'update']);

Route::delete('/delete/{user}', [HomeController::class, 'destroy'])->name('delete');

Route::get('/user/subscribe/{user}', [UserSubscriptionController::class, 'create']);
Route::post('/user/subscribe', [UserSubscriptionController::class, 'store']);
//Route::get('send-email', [EmailController::class, 'sendEmail']);

//Route::post('/subscribe', [SubscriberController::class, 'subscribe']);
//Auth::routes();
//
//Route::get('/home', [HomeController::class, 'index'])->name('home');
