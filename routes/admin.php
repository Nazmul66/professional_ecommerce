<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\ChildCategoryController;
use App\Http\Controllers\Backend\BrandController;


Route::group(['prefix' => 'admin'], function(){
    Route::get('/dashboard', [AdminController::class, "dashboard"])->name('dashboard');


    //____ Category ____//
    Route::resource('category', CategoryController::class)->names('admin.category');
    Route::get('/get-category',[CategoryController::class,'getData'])->name('admin.get-category');
    Route::post('/category/status',[CategoryController::class,'adminCategoryStatus'])->name('admin.category.status');


    //____ SubCategory ____//
    Route::resource('subCategory', SubCategoryController::class)->names('admin.subCategory');
    Route::get('/get-subCategory',[SubCategoryController::class,'getData'])->name('admin.get-subCategory');
    Route::post('/subCategory/status',[SubCategoryController::class,'adminSubCategoryStatus'])->name('admin.subCategory.status');


    //____ ChildCategory ____//
    Route::resource('childCategory', ChildCategoryController::class)->names('admin.childCategory');
    Route::get('/get-childCategory',[ChildCategoryController::class,'getData'])->name('admin.get-childCategory');
    Route::post('/childCategory/status',[ChildCategoryController::class,'adminChildCategoryStatus'])->name('admin.childCategory.status');


    //____ Brand ____//
    Route::resource('brand', BrandController::class)->names('admin.brand');
    Route::get('/get-brand',[BrandController::class,'getData'])->name('admin.get-brand');
    Route::post('/brand/status',[BrandController::class,'adminBrandStatus'])->name('admin.brand.status');

});


?>