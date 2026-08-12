<?php

use App\Http\Controllers\GroupsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('groups/{path?}', GroupsController::class)->where(['path' => '.*'])->name('groups');
