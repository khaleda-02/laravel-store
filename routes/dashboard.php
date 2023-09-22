<?php

use App\Http\Controllers\Dashboard\CategoriesController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')
  ->as('dashboard.')
  ->prefix('dashboard')
  ->group(function () {
    Route::get('/', function () {
      return view('dashboard.index');
    })->name('home');

    Route::resource('/categories', CategoriesController::class);
  });

//?  IN Resource : the name of the route by default is the last word 
//! NOTE: the name of this resource's routes (to avoid the conflict)-> last word + the actions  
//? categories.index , categories.create