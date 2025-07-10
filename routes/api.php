<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix("/user/")->group(function() {
    Route::get("list_all_users", [UserController::class,"listAllUsers"]);
    Route::get("get_user_by_id/{id}", [UserController::class,"getUserById"]);
    Route::post("create_user", [UserController::class,"createUser"]);
    Route::post("update_user_by_id/{id}", [UserController::class,"updateUserById"]);
    Route::delete("delete_user_by_id/{id}", [UserController::class,"deleteUserById"]);
});