<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;



// Route::livewire('/home/test', 'pages::post.create');
Route::livewire('/', 'pages::home.index');