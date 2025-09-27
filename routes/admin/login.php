<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Login\AdminLoginGetController;
use App\Http\Controllers\Admin\Login\AdminLoginPostController;

//vpx_imports

Route::get('admin/login', [AdminLoginGetController::class,'index'])->name('admin.login.index');
Route::post('admin/login', [AdminLoginPostController::class,'login'])->name('admin.login');

//vpx_attach
