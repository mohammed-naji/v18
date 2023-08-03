<?php

use Illuminate\Support\Facades\Route;

Route::prefix('customer')->name('customer.')->group(function() {
    Route::get('profile', function() {
        return 'User Page';
    })->name('profile');

    Route::get('courses', function() {
        return 'User courses';
    })->name('courses');

    Route::get('comments', function() {
        return 'User comments';
    })->name('comments');

    Route::get('posts', function() {
        return 'User posts';
    })->name('posts');

});

