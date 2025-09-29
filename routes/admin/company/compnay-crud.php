<?php

use App\Http\Controllers\Admin\Company\Crud\CompanyController;
use Illuminate\Support\Facades\Route;
//vpx_imports
Route::prefix('admin')->group(function(){
    Route::resource('company',CompanyController::class)->except(['destroy', 'show']);
    Route::post('company/list',[CompanyController::class,'list']);
});
