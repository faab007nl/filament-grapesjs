<?php

use Illuminate\Support\Facades\Route;

if(app('filament')->hasPlugin('filament-grapesjs')) {
    Route::group(['[prefix' => 'filament-grapesjs'], function () {



        Route::get('/store', function () {
            return view('filament-grapesjs::grapesjs');
        })->name('grapesjs');

    });

}
