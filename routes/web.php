<?php



use System\Router\Web\Route;

Route::get('/', 'HomeController@index', ['name'=>'home.index',]);

//Route::get('/test', 'TestController@test', ['name'=>'test','middleware'=>MiddlewareTest::class]);




