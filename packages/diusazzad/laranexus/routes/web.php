<?php

use Diusazzad\LaraNexus\Http\Controllers\LaraNexusController;
use Illuminate\Support\Facades\Route;

Route::middleware(config('laranexus.middleware', ['web']))
    ->prefix(config('laranexus.path', 'laranexus'))
    ->group(function () {
        Route::get('/', [LaraNexusController::class, 'index'])->name('laranexus.index');
    });
