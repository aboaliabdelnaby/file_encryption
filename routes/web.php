<?php

use App\Livewire\User\Home;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('login');
});

Auth::routes();
Route::middleware(['auth'])->group(function () {
    Route::get('home', Home::class)->name('home');
});
