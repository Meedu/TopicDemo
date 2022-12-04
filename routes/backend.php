<?php

use Addons\TopicDemo\Http\Controller\Backend\CategoryController;
use Addons\TopicDemo\Http\Controller\Backend\TopicController;

Route::group([
    'prefix' => '/addons/TopicDemo/backend/api/v1',
    'middleware' => ['api', 'auth:administrator', 'backend.permission'],
], function () {
    Route::group(['prefix' => 'category'], function () {
        Route::get('/index', CategoryController::class . '@index');
        Route::get('/create', CategoryController::class . '@create');
        Route::post('/create', CategoryController::class . '@store');
        Route::get('/{id}', CategoryController::class . '@edit');
        Route::put('/{id}', CategoryController::class . '@update');
        Route::delete('/{id}', CategoryController::class . '@destroy');
    });

    Route::group(['prefix' => 'topic'], function () {
        Route::get('/index', TopicController::class . '@index');
        Route::get('/create', TopicController::class . '@create');
        Route::post('/create', TopicController::class . '@store');
        Route::get('/{id}', TopicController::class . '@edit');
        Route::put('/{id}', TopicController::class . '@update');
        Route::delete('/{id}', TopicController::class . '@destroy');
    });
});