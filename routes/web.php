<?php

use App\Http\Controllers\ChapterController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DanhmucController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\SachController;
use App\Http\Controllers\TheloaiController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\UserController;
use App\Models\Sach;
use App\Models\User;

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

Route::get('/',[ IndexController::class,'home']);
Route::get('/danh-muc/{slug}',[ IndexController::class,'danhmuc']);
Route::get('/xem-sach/{slug}', [IndexController::class,'xemsach']);
Route::get('/xem-chapter/{slug_sach}/{slug}', [IndexController::class,'xemchapter']);
Route::get('/the-loai/{slug}', [IndexController::class,'theloai']);
Route::post('/tim-kiem', [IndexController::class,'timkiem']);
Route::post('/timkiem-ajax', [IndexController::class,'timkiem_ajax']);
Route::get('/tag/{tag}',[IndexController::class,'tag']);
Route::post('/sachnoibat',[SachController::class,'sach_hot']);
Route::post('/xem-pdf',[IndexController::class,'xempdf']);
Auth::routes();
Route::group(['middleware'=> ['auth']], function(){
    Route::resource('/user',UserController::class);
    Route::get('/phan-vaitro/{id}',[UserController::class,'phanvaitro']);
    Route::post('/insert_roles/{id}', [UserController::class, 'insert_roles']);
    Route::resource('/danhmuc',DanhmucController::class);
    Route::resource('/sach',SachController::class);
    Route::resource('/chapter',ChapterController::class);
    Route::resource('/theloai',TheloaiController::class);
    Route::resource('/information',InformationController::class);

    Route::get('/home', [UserController::class, 'index'])->name('home');
    Route::get('/impersonate/user/{id}',[UserController::class,'impersonate']);
    Route::get('/user/stopImpersonate',[UserController::class,'stopImpersonate']);
});



