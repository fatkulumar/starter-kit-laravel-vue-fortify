<?php

use App\Http\Controllers\Admin\User\Web\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('dashboard')->as('dashboard.')->middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::get('user', UserController::class);
});