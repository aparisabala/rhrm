<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Dashboard\AdminDashboardGetController;

//vpx_imports

Route::get('admin/dashboard', [AdminDashboardGetController::class,'index'])->name('admin.dashboard.index');

//vpx_attach
