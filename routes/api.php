<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix("/api/user/")->group(function() {
    Route::get("list_all_users", [UserController::class,"listAllUsers"]);
    Route::get("get_user_by_id", [UserController::class,"getUserById"]);
    Route::get("create_user", [UserController::class,"createUser"]);
    Route::get("update_user_by_id", [UserController::class,"updateUserById"]);
    Route::get("delete_user_by_id", [UserController::class,"deleteUserById"]);
});