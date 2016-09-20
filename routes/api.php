<?php

use App\Http\Requests\SearchRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::get('/local', function() {
    return response()->json(['local'=> App::getLocale()]);
});

Route::post('/local', function($local) {
   App::setLocal($local); 
});

Route::get('/search', ['uses'=>'FrontController@search']);