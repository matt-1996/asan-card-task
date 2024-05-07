<?php

use Illuminate\Support\Facades\Route;
use App\Domain\NYTimes\Http\Controllers\Api\V1\NYTimesController;

Route::get('index' , [NyTimesController::class, 'index'])->middleware([]);

Route::get('show/{id}' , [NyTimesController::class, 'show'])->middleware([]);

