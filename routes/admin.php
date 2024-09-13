<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\CategoryController;
use Illuminate\Support\Facades\Session;

Route::group(['prefix' => 'admin'], function(){
    Route::get('/dashboard', [AdminController::class, "dashboard"])->name('dashboard');


    //____ Category ____//
    Route::resource('category', CategoryController::class)->names('category');
    Route::get('/get-category',[CategoryController::class,'getData'])->name('get-category');
    Route::post('/category/status',[CategoryController::class,'adminCategoryStatus'])->name('category.status');

});


?>