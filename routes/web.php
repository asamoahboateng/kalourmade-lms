<?php

use App\Http\Controllers\HomeController;
use App\Livewire\Users\ListRoles;
use Livewire\Volt\Volt;
use Illuminate\Support\Facades\Route;

//Volt::route('/', 'users.index');
//Route::view('/', 'admin.dashboard  ');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('/logout', [HomeController::class, 'logout'])->name('logout');

    // Roles
    Route::get('/roles', ListRoles::class)->name('roles');

    // Users
    Route::get('/users', \App\Livewire\Users\User::class)->name('users');

    // User Profile
    Route::get('/user-profile/{user}/{slug}', \App\Livewire\Users\Profile\UserProfile::class)->name('user-profile.show');

    // Subjects
    Route::get('/subjects', \App\Livewire\General\ListSubjects::class)->name('subjects');

    //classes
    Route::get('/classes', \App\Livewire\General\ListClasses::class)->name('classes');

    // academic settings
    Route::get('/academic-settings', [\App\Http\Controllers\General\AcadmicsSettingsController::class , 'academicList'])->name('academic-settings.list');
});

//Route::get('/roles', function () {
//    return view('admin.roles');
//});
/* Auth Route Group */
Route::group(['prefix'=>'auth'],function(){
//    Route::view('/login', 'auth.login');
    Route::get('/login', \App\Livewire\Users\AuthenticateUser::class )->name('login');
});
/* Auth Route Ends Here */
