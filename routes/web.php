<?php

use App\Http\Controllers\GroupsController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/groups');

Route::get('product/{product}', ProductController::class)->name('product');
Route::get('groups/{path?}', GroupsController::class)->where(['path' => '.*'])->name('groups');
