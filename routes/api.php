<?php

use Illuminate\Http\Request;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Authorization");

Route::get('/test','Gpon\TestController@index');


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
