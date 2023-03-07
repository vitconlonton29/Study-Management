<?php

use Illuminate\Support\Facades\Route;


//Nhóm các route thành 1 nhóm
//prefix: chung tiền tố ở url
//as: chung phần đầu của name Route
Route::group(['prefix'=>'course', 'as'=>'course.'], function (){
    Route::get('/',[\App\Http\Controllers\CourseController::class, 'index']);
    Route::get('/create',[\App\Http\Controllers\CourseController::class, 'create'])->name('create');
    Route::post('/create',[\App\Http\Controllers\CourseController::class, 'store'])->name('store');
});

