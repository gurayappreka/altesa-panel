<?php

use Illuminate\Support\Facades\Route;

// Ana sayfa Filament admin paneline yönlendir
Route::get('/', fn() => redirect('/admin'));
