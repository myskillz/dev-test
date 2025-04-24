<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DogController;

Route::controller(DogController::class)->group(function () 
{
    Route::get('/', 'list');
    Route::prefix('dog')->group(function () 
    {
        Route::get('/breed/{name}', 'breedDetail');
    });
});