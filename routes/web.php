<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/',['as'=>'home' ,"uses"=>"FrontController@index"]);

Route::get('/district/{name?}',['uses'=>'FrontController@district'])->where('name','[a-zA-Z -]+');

Route::get('/commune/{name?}',['uses'=>'FrontController@commune'])->where('name','[a-zA-Z -]+');

Route::get('/fokontany/{name?}',['uses'=>'FrontController@fokontany'])->where('name','[a-zA-Z -]+');

Route::get('/region/{name?}', ['uses'=>'FrontController@region'])->where('name','[a-zA-Z -]+');

Route::get('/match', 'FrontController@match')->name('match');

Route::get('/localizeMe', 'FrontController@localizeMe')->name('localize');

Route::group(['middleware'=>'auth','prefix'=>'gstion/admin'], function() {

    Route::get('/', ['uses'=>'Back\ViewController@index'])->name('admin.index');

    Route::get('/logout' ,['uses'=>'Auth\LoginController@logout','as'=>'admin.logout']);

    Route::get('/profile/{name}', ['uses'=>'Back\ViewController@profile','admin.profile']);
    
    Route::group(['prefix'=>'territory'], function() {

        Route::get('/place/all','Back\PlaceController@all')->name('territory.allPlace');
        Route::get('/place','Back\PlaceController@index')->name('territory.indexPlace');
        Route::post('/place','Back\PlaceController@store')->name('territory.createPlace');
        Route::get('/place/{id}','Back\PlaceController@readPlace')->name('territory.readPlace')->where('id','([0-9\[?\]? ]+)(-)?([a-zA-Z-]+)?');
        Route::post('/place/{id}/update','Back\PlaceController@updatePlace')->name('territory.updatePlace')->where('id','([0-9]+)');
        Route::post('/place/{id}/delete','Back\PlaceController@deletePlace')->name('territory.deletePlace')->where('id','([0-9]+)');

        Route::get('/country','Back\TerritoryController@country')->name('territory.country');
        Route::post('/country','Back\TerritoryController@createCountry')->name('territory.createCountry');
        Route::get('/country/{id}','Back\TerritoryController@readCountry')->name('territory.readCountry')->where('id','([0-9]+)-([a-zA-Z-]+)');
        Route::get('/country/all','Back\TerritoryController@allCountry')->name('territory.allCountry');
        Route::post('/country/{id}/update','Back\TerritoryController@updateCountry')->name('territory.updateCountry')->where('id','([0-9]+)');

        Route::get('/town', 'Back\TerritoryController@town')->name('territory.town');
        Route::post('/town' , 'Back\TerritoryController@createTown')->name('territory.createTown');
        Route::get('/town/{id}' , 'Back\TerritoryController@readTown')->name('territory.readTown')->where('id','([0-9 ]+)-([ a-zA-Z-]+)');
        Route::get('/town/all' , 'Back\TerritoryController@allTown')->name('territory.allTown');
        Route::post('/town/{id}/update','Back\TerritoryController@updateTown')->name('territory.updateTown')->where('id','([0-9]+)');
        
        Route::get('/state','Back\TerritoryController@state')->name('territory.state');
        
        Route::get('/province' ,'Back\TerritoryController@province')->name('territory.province');
        Route::post('/province', 'Back\TerritoryController@createProvince')->name('territory.createProvince');
        Route::get('/province/{id}' , 'Back\TerritoryController@readProvince')->name('territory.readProvince')->where('id','([0-9 ]+)-([ a-zA-Z-]+)');
        Route::get('/province/all' , 'Back\TerritoryController@allProvince')->name('territory.allProvince');
        Route::post('/province/{id}/update','Back\TerritoryController@updateProvince')->name('territory.updateProvince')->where('id','([0-9]+)');
        
        Route::get('/district' ,'Back\TerritoryController@district')->name('territory.district');
        Route::post('/district', 'Back\TerritoryController@createDistrict')->name('territory.createDistrict');
        Route::get('/district/{id}' , 'Back\TerritoryController@readDistrict')->name('territory.readDistrict')->where('id','([0-9 ]+)-([ a-zA-Z-]+)');
        Route::get('/district/all' , 'Back\TerritoryController@allDistrict')->name('territory.allDistrict');
        Route::post('/district/{id}/update','Back\TerritoryController@updateDistrict')->name('territory.updateDistrict')->where('id','([0-9]+)');

        Route::get('/fokontany' , 'Back\TerritoryController@fokontany')->name('territory.fokontany');
        Route::post('/fokontany', 'Back\TerritoryController@createFokontany')->name('territory.createFokontany');
        Route::get('/fokontany/{id}' , 'Back\TerritoryController@readFokontany')->name('territory.readFokontany')->where('id','([0-9\s?]+)-([ a-zA-Z-]+)');
        Route::get('/fokontany/all' , 'Back\TerritoryController@allFokontany')->name('territory.allFokontany');
        Route::post('/fokontany/{id}/update','Back\TerritoryController@updateFokontany')->name('territory.updateFokontany')->where('id','([0-9]+)');

    });

});

Route::get('/login', ['uses'=>'Auth\LoginController@showLoginForm',"as"=>'login']);
Route::post('/login', ['uses'=>'Auth\LoginController@login']);

