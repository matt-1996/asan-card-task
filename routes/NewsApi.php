<?php

use Illuminate\Support\Facades\Route;
use App\Domain\NewsApi\Http\Controllers\Api\V1\NewsApiController;

Route::get('index' , [NewsApiController::class , 'index']);
