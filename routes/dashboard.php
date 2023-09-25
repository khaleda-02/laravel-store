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

    //? Categories Routes 
    Route::get('/categories/trash', [CategoriesController::class, 'trash'])->name('categories.trash');
    Route::put('/categories/{category}/restore', [CategoriesController::class, 'restore'])->name('categories.restore');
    Route::delete('/categories/{category}/force-delete', [CategoriesController::class, 'forceDelete'])->name('categories.force-delete');
    Route::resource('/categories', CategoriesController::class); // must be in most bottom , to avoid the conflict . 
  });

//?  IN Resource : the name of the route by default is the last word 
//! NOTE: the name of this resource's routes (to avoid the conflict)-> last word + the actions  
//? categories.index , categories.create ... 