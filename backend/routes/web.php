<?php

use Illuminate\Support\Facades\Route;
use MLL\GraphQLPlayground\GraphQLPlaygroundController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/graphql-playground', [\MLL\GraphQLPlayground\GraphQLPlaygroundController::class, '__invoke']);

