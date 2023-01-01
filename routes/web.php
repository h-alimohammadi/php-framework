<?php

use System\Router\Web\Route;

Route::get('/', 'HomeController@index',['name'=>'home']);

Route::add(['get','post'],'/home/{id}/comment/{cid}', 'HomeController@index',['name'=>'comment']);
Route::get('/create', function(){
    echo 'hi';
}, ['name'=>'create']);

// Route::post('store', 'HomeController@store', ['name'=>'store']);
// Route::get('edit/{id}', 'HomeController@edit', ['name'=>'edit']);
// Route::put('/update/{id}', 'HomeController@update', ['name'=>'update']);
// Route::delete('/delete/{id}', 'HomeController@destroy', ['name'=>'delete']);
