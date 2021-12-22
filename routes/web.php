<?php

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
    return view('welcome');
});

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/detail/{slug}', [App\Http\Controllers\HomeController::class, 'detail'])->name('detail');
Route::match(['get','post'],'/login', [App\Http\Controllers\HomeController::class, 'login'])->name('login');
Route::match(['get','post'],'/register', [App\Http\Controllers\HomeController::class, 'register'])->name('register');
Route::match(['get','post'],'/userLogout', [App\Http\Controllers\HomeController::class, 'logout'])->name('userLogout');

Route::match(['get','post'],'/add-signature', [App\Http\Controllers\HomeController::class, 'addSignature'])->name('add-signature');
Route::get('/signature', [App\Http\Controllers\HomeController::class, 'index'])->name('signature');

Route::group([

	'namespace' => 'admin',

], function (){
	// Route::get('/admin', [App\Http\Controllers\admin\AdminController::class, 'login'])->name('admin');
	Route::match(['get','post'],'admin', [App\Http\Controllers\admin\AdminController::class, 'login'])->name('admin');

	Route::group(['middleware'=> ['auth','isAdmin']], function(){
		
	Route::get('/logout', [App\Http\Controllers\admin\AdminController::class, 'logout']);

		//**********Petitions************\\

	    Route::match(['get','post'],'search_petitions',[App\Http\Controllers\admin\PetitionsController::class, 'search']);

	    Route::match(['get','post'],'add-petitions',[App\Http\Controllers\admin\PetitionsController::class, 'add']);

		Route::match(['get','post'],'create-petitions', [App\Http\Controllers\admin\PetitionsController::class, 'create'])->name('create-petitions');

	    Route::match(['get','post'],'edit-petitions/{id}',[App\Http\Controllers\admin\PetitionsController::class, 'edit']);

	    Route::match(['get','post'],'delete-petitions',[App\Http\Controllers\admin\PetitionsController::class, 'delete']);

	    Route::get('view-petitions',[App\Http\Controllers\admin\PetitionsController::class, 'view']);
	    Route::get('dashboard',[App\Http\Controllers\admin\PetitionsController::class, 'view']);

	});


});
