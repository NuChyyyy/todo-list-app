<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

Route::view('/', 'home')
    ->middleware(['auth', 'verified'])
    ->name('/');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
