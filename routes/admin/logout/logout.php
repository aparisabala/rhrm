<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Logout\AdminLogoutGetController;

//vpx_imports

Route::get('admin/logout', [AdminLogoutGetController::class,'logout'])->name('admin.logout');

//vpx_attach
