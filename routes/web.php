<?php



//Route::get('/test', 'TestController@test', ['name'=>'test','middleware'=>MiddlewareTest::class]);
use App\Http\Middleware\CheckAdmin;
use System\Router\Web\Route;

//home
Route::get('/', 'HomeController@index', ['name'=>'home.index',]);
Route::get('/home', 'HomeController@index', ['name'=>'home.home',]);
Route::get('/about', 'HomeController@about', ['name'=>'home.about',]);
Route::get('/ads', 'HomeController@allAds', ['name'=>'home.all.ads',]);
Route::get('/posts', 'HomeController@allPost', ['name'=>'home.all.post',]);
Route::get('/post/{id}', 'HomeController@post', ['name'=>'home.post',]);
Route::get('/category/{id}', 'HomeController@category', ['name'=>'home.category',]);
Route::post('/post/comment/{id}', 'HomeController@comment', ['name'=>'home.post.comment',]);
Route::get('/ads/{id}', 'HomeController@ads', ['name'=>'home.ads',]);
Route::get('/search', 'HomeController@search', ['name'=>'home.search',]);



//admin routes 
Route::get('/admin', 'Admin\AdminController@index', ['name'=>'admin.index','middleware'=>CheckAdmin::class]);

//category routes
Route::get('/admin/category', 'Admin\CategoryController@index', ['name'=>'admin.category.index']);
Route::get('/admin/category/create', 'Admin\CategoryController@create', ['name'=>'admin.category.create']);
Route::post('/admin/category/store', 'Admin\CategoryController@store', ['name'=>'admin.category.store']);
Route::get('/admin/category/edit/{id}', 'Admin\CategoryController@edit', ['name'=>'admin.category.edit']);
Route::put('/admin/category/update/{id}', 'Admin\CategoryController@update', ['name'=>'admin.category.update']);
Route::delete('/admin/category/delete/{id}', 'Admin\CategoryController@destroy', ['name'=>'admin.category.delete']);

//post routes
Route::get('/admin/post', 'Admin\PostController@index', ['name'=>'admin.post.index']);
Route::get('/admin/post/create', 'Admin\PostController@create', ['name'=>'admin.post.create']);
Route::post('/admin/post/store', 'Admin\PostController@store', ['name'=>'admin.post.store']);
Route::get('/admin/post/edit/{id}', 'Admin\PostController@edit', ['name'=>'admin.post.edit']);
Route::put('/admin/post/update/{id}', 'Admin\PostController@update', ['name'=>'admin.post.update']);
Route::delete('/admin/post/delete/{id}', 'Admin\PostController@destroy', ['name'=>'admin.post.delete']);

//ads routes
Route::get('/admin/ads', 'Admin\AdsController@index', ['name'=>'admin.ads.index']);
Route::get('/admin/ads/create', 'Admin\AdsController@create', ['name'=>'admin.ads.create']);
Route::post('/admin/ads/store', 'Admin\AdsController@store', ['name'=>'admin.ads.store']);
Route::get('/admin/ads/edit/{id}', 'Admin\AdsController@edit', ['name'=>'admin.ads.edit']);
Route::put('/admin/ads/update/{id}', 'Admin\AdsController@update', ['name'=>'admin.ads.update']);
Route::delete('/admin/ads/delete/{id}', 'Admin\AdsController@destroy', ['name'=>'admin.ads.delete']);
Route::get('/admin/ads/gallery/{id}', 'Admin\AdsController@gallery', ['name'=>'admin.ads.gallery']);
Route::post('/admin/ads/store-gallery-image/{id}', 'Admin\AdsController@storeGalleryImage', ['name'=>'admin.ads.store.gallery.image']);
Route::get('/admin/ads/delete-gallery-image/{gallery_id}', 'Admin\AdsController@deleteGalleryImage', ['name'=>'admin.ads.delete.gallery.image']);


//slideshow routes
Route::get('/admin/slide', 'Admin\SlideController@index', ['name'=>'admin.slide.index']);
Route::get('/admin/slide/create', 'Admin\SlideController@create', ['name'=>'admin.slide.create']);
Route::post('/admin/slide/store', 'Admin\SlideController@store', ['name'=>'admin.slide.store']);
Route::get('/admin/slide/edit/{id}', 'Admin\SlideController@edit', ['name'=>'admin.slide.edit']);
Route::put('/admin/slide/update/{id}', 'Admin\SlideController@update', ['name'=>'admin.slide.update']);
Route::delete('admin/slide/delete/{id}', 'Admin\SlideController@destroy', ['name'=>'admin.slide.delete']);


//comment routes
Route::get('/admin/comment', 'Admin\CommentController@index', ['name'=>'admin.comment.index']);
Route::get('/admin/comment/show/{id}', 'Admin\CommentController@show', ['name'=>'admin.comment.show']);
Route::get('admin/comment/approved/{id}', 'Admin\CommentController@approved', ['name'=>'admin.comment.approved']);
Route::post('admin/comment/answer/{id}', 'Admin\CommentController@answer', ['name'=>'admin.comment.answer']);


//user routes
Route::get('/admin/user', 'Admin\UserController@index', ['name'=>'admin.user.index']);
Route::get('/admin/user/edit/{id}', 'Admin\UserController@edit', ['name'=>'admin.user.edit']);
Route::put('/admin/user/update/{id}', 'Admin\UserController@update', ['name'=>'admin.user.update']);
Route::get('admin/user/change-status/{id}', 'Admin\UserController@changeStatus', ['name'=>'admin.user.change.status']);


//auth routes
Route::get('/login', 'Auth\LoginController@view', ['name'=>'auth.login.view']);
Route::post('/login', 'Auth\LoginController@login', ['name'=>'auth.login']);
Route::get('/register', 'Auth\RegisterController@view', ['name'=>'auth.register.view']);
Route::post('/register', 'Auth\RegisterController@register', ['name'=>'auth.register']);
Route::get('/activation/{token}', 'Auth\RegisterController@activation', ['name'=>'auth.activation']);
Route::get('/forgot', 'Auth\ForgotController@view', ['name'=>'auth.forgot.password']);
Route::post('/forgot', 'Auth\ForgotController@forgot', ['name'=>'auth.forgot']);
Route::get('/reset-password/{token}', 'Auth\ResetPasswordController@view', ['name'=>'auth.reset-password.view']);
Route::post('/reset-password/{token}', 'Auth\ResetPasswordController@resetPassword', ['name'=>'auth.reset-password']);
Route::get('/logout', 'Auth\LogoutController@logout', ['name'=>'auth.logout']);


