<?php

use Addons\TopicDemo\Http\Controller\Api\CategoryController;
use Addons\TopicDemo\Http\Controller\Api\TopicController;

Route::group([
    'prefix' => '/addons/TopicDemo/api/v1',
    'middleware' => ['api'],
], function () {
    Route::get('/categories', CategoryController::class . '@all');
    Route::get('/topics', TopicController::class . '@index');
    Route::get('/topic/{id}', TopicController::class . '@detail');
});