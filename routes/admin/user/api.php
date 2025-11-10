<?php

use App\Http\Controllers\Admin\User\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('api/dashboard')->as('api.')->middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::resource('user', UserController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::delete('user/purge', [UserController::class, 'purge'])->name('purge');
});