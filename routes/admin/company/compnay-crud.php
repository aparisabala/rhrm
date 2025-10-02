<?php

use App\Http\Controllers\Admin\Company\Crud\CompanyCurdController;
use Illuminate\Support\Facades\Route;
//vpx_imports
Route::prefix('admin')->group(function(){
    Route::resource('company',CompanyCurdController::class)->except(['destroy', 'show']);
    Route::post('company/list',[CompanyCurdController::class,'list']);
    Route::post('company/delete-list',[CompanyCurdController::class,'deleteList']);
    Route::post('company/update-list',[CompanyCurdController::class,'updateList']);
});
