<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
     return response()-> json([
            "message"=>"Welcome to Buckhill API Test",
            "success" => true,
            "statusCode" => 200
    ]);
});
