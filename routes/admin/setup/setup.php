<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Setup\AdminProfileSetupGetController;
use App\Http\Controllers\Admin\Setup\AdminProfileSetupPostController;
//vpx_imports

//vpx_attach
Route::get('admin/setup/profile', [AdminProfileSetupGetController::class,'index'])->name('admin.profile.setup');
Route::post('admin/setup/profile', [AdminProfileSetupPostController::class,'update']);
