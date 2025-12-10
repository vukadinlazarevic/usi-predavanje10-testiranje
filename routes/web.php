<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect("/advertisements");
});

Route::resource('categories', App\Http\Controllers\CategoryController::class);

Route::resource('advertisements', App\Http\Controllers\AdvertisementController::class);
