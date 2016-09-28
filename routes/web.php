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

Route::get('/departement/{name?}',['uses'=>'FrontController@department']);

Route::get('/commune/{name?}',['uses'=>'FrontController@commune']);

Route::get('/fokontany/{name?}',['uses'=>'FrontController@fokontany'])->where('name','[a-zA-Z]+');

Route::group(['middleware'=>'auth','prefix'=>'gstion/admin'], function() {

    Route::get('/', ['uses'=>'Back\ViewController@index'])->name('admin.index');

    Route::get('/logout' ,['uses'=>'Auth\LoginController@logout','as'=>'admin.logout']);

    Route::get('/profile/{name}', ['uses'=>'Back\ViewController@profile','admin.profile']);
    
    Route::group(['prefix'=>'territory'], function() {

        Route::get('/place/all','Back\PlaceController@all')->name('territory.allPlace');
        Route::get('/place','Back\PlaceController@index')->name('territory.indexPlace');
        Route::post('/place','Back\PlaceController@store')->name('territory.createPlace');
        Route::get('/place/{id}','Back\PlaceController@readPlace')->name('territory.readPlace')->where('id','([0-9]+)(-)?([a-zA-Z-]+)?');
        Route::post('/place/{id}/update','Back\PlaceController@updatePlace')->name('territory.updatePlace')->where('id','([0-9]+)');
        Route::post('/place/{id}/delete','Back\PlaceController@deletePlace')->name('territory.deletePlace')->where('id','([0-9]+)');

        Route::get('/country','Back\TerritoryController@country')->name('territory.country');
        Route::post('/country','Back\TerritoryController@createCountry')->name('territory.createCountry');
        Route::get('/country/{id}','Back\TerritoryController@readCountry')->name('territory.readCountry')->where('id','([0-9])-([a-zA-Z-]+)');
        Route::get('/country/all','Back\TerritoryController@allCountry')->name('territory.allCountry');
        Route::post('/country/{id}/update','Back\TerritoryController@updateCountry')->name('territory.updateCountry')->where('id','([0-9])-([a-zA-Z-]+)');

        Route::get('/town', 'Back\TerritoryController@town')->name('territory.town');
        Route::post('/town' , 'Back\TerritoryController@createTown')->name('territory.createTown');
        Route::get('/town/{id}' , 'Back\TerritoryController@readTown')->name('territory.readTown')->where('id','([0-9])-([a-zA-Z-]+)');
        Route::get('/town/all' , 'Back\TerritoryController@allTown')->name('territory.allTown');
        Route::post('/town/{id}/update','Back\TerritoryController@updateTown')->name('territory.updateTown')->where('id','([0-9])-([a-zA-Z-]+)');
        
        Route::get('/state','Back\TerritoryController@state')->name('territory.state');
        
        Route::get('/province' ,'Back\TerritoryController@province')->name('territory.province');
        Route::post('/province', 'Back\TerritoryController@createProvince')->name('territory.createProvince');
        Route::get('/province/{id}' , 'Back\TerritoryController@readProvince')->name('territory.readProvince')->where('id','([0-9])-([a-zA-Z-]+)');
        Route::get('/province/all' , 'Back\TerritoryController@allProvince')->name('territory.allProvince');
        Route::post('/province/{id}/update','Back\TerritoryController@updateProvince')->name('territory.updateProvince')->where('id','([0-9])-([a-zA-Z-]+)');


        Route::get('/departement' ,'Back\TerritoryController@departement')->name('territory.departement');
        Route::post('/departement', 'Back\TerritoryController@createDepartement')->name('territory.createDepartement');
        Route::get('/departement/{id}' , 'Back\TerritoryController@readDepartement')->name('territory.readDepartement')->where('id','([0-9])-([a-zA-Z-]+)');
        Route::get('/departement/all' , 'Back\TerritoryController@allDepartement')->name('territory.allDepartement');
        Route::post('/departement/{id}/update','Back\TerritoryController@updateDepartement')->name('territory.updateDepartement')->where('id','([0-9])-([a-zA-Z-]+)');

        Route::get('/fokontany' , 'Back\TerritoryController@fokontany')->name('territory.fokontany');
        Route::post('/fokontany', 'Back\TerritoryController@createFokontany')->name('territory.createFokontany');
        Route::get('/fokontany/{id}' , 'Back\TerritoryController@readFokontany')->name('territory.readFokontany')->where('id','([0-9])-([a-zA-Z-]+)');
        Route::get('/fokontany/all' , 'Back\TerritoryController@allFokontany')->name('territory.allFokontany');
        Route::post('/fokontany/{id}/update','Back\TerritoryController@updateFokontany')->name('territory.updateFokontany')->where('id','([0-9])-([a-zA-Z-]+)');

    });

});

Route::get('/login', ['uses'=>'Auth\LoginController@showLoginForm',"as"=>'login']);
Route::post('/login', ['uses'=>'Auth\LoginController@login']);

