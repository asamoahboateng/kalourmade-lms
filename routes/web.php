<?php

use App\Http\Controllers\HomeController;
use App\Livewire\Users\ListRoles;
use Livewire\Volt\Volt;
use Illuminate\Support\Facades\Route;

//Volt::route('/', 'users.index');
//Route::view('/', 'admin.dashboard  ');
Route::get('/', [HomeController::class, 'dashboard'])->name('dashboard');
Route::get('/logout', [HomeController::class, 'logout'])->name('logout');

// Roles
Route::get('/roles', ListRoles::class)->name('roles');

// Users
Route::get('/users', \App\Livewire\Users\User::class)->name('users');
//Route::get('/roles', function () {
//    return view('admin.roles');
//});
/* Auth Route Group */
Route::group(['prefix'=>'auth'],function(){
//    Route::view('/login', 'auth.login');
    Route::get('/login', \App\Livewire\Users\AuthenticateUser::class )->name('users.login');
});
/* Auth Route Ends Here */
