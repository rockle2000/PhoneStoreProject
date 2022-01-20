<?php
use Illuminate\Support\Facades\Route;

Route::namespace('Admin')->group(function () {
    Route::get('/login', 'LoginController@showLoginForm');
    Route::post('/login', 'LoginController@login')->name('admin.login');
    Route::post('/logout', 'LoginController@logout')->name('admin.logout');
});