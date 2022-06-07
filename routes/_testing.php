<?php

use App\Http\Controllers\Api\PaymentController;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    Auth::login(\App\Models\User::where("email", request('email'))->first());
});

Route::get('/create', function () {
    $modelClass = 'App\Models\\' . request('model');
    return $modelClass::factory()->create();
});
