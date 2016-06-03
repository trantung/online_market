<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::group(['prefix' => 'admin'], function () {

	Route::get('/login', array('uses' => 'AdminController@login', 'as' => 'admin.login'));
	Route::post('/login', array('uses' => 'AdminController@doLogin'));
	Route::get('/logout', array('uses' => 'AdminController@logout', 'as' => 'admin.logout'));
	Route::resource('/', 'AdminController');

	Route::get('/manager/changepassword/{id}', array('uses' => 'ManagerController@changePassword', 'as' => 'admin.manager.chanpassword'));
	Route::post('/manager/updatePassword/{id}', array('uses' => 'ManagerController@updatePassword'));
	Route::get('/manager/search', array('uses' => 'ManagerController@search', 'as' => 'admin.manager.search'));
	Route::resource('/manager', 'ManagerController');

	Route::resource('/feedback', 'FeedbackController');
	Route::resource('/price', 'PriceController');
	Route::resource('/category', 'CategoryController');
	Route::get('/product/check/{id}', 'ProductController@check');
	Route::get('/product/refuse/{id}', 'ProductController@refuse');
	Route::resource('/product', 'ProductController');

	Route::get('/user/changepassword/{id}', array('uses' =>  'UserController@changepassword', 'as' => 'admin.user.changepassword'));
	Route::get('/user/search', array('uses' =>  'UserController@search', 'as' => 'admin.user.search'));
	Route::resource('/user', 'UserController');

});

Route::group(['prefix' => 'api'], function () {

	//check login, logout -> finish
	Route::get('/login', 'LoginController@getLogin');
	Route::post('/login', 'LoginController@postLogin');
	Route::post('/logout', 'LogoutController@logout');
	Route::get('/register', 'RegisterController@index');
	Route::post('/register', 'RegisterController@store');
	//login by facebook or google->finish
	Route::post('/login_social', 'LoginController@loginSocial');

	//home->finish
	Route::get('/', 'MainController@index');

	//setting
	Route::post('/setting', 'ApiSettingController@index');

	//list category
	Route::post('/category', 'ApiCategoryController@index');

	//list products following category->finish
	Route::post('/category/{id}', 'ApiCategoryController@show');
	// favorite category
	Route::post('/category/{id}/action', 'ApiCategoryController@action');

	//detail product
	Route::post('/product/{id}', 'ApiProductController@index');
	Route::post('/product_saved/{id}', 'ApiProductController@saved');

	//list product saved->finish
	Route::post('/product_log', 'ApiProductLogController@index');
	Route::post('/product_log/{id}/delete', 'ApiProductLogController@destroy');

	//upload product
	Route::get('/post_product', 'ApiPostController@index');
	Route::post('/post_product', 'ApiPostController@post');

	//list favorite user 
	Route::post('/favorite', 'ApiFavoriteController@index');
	//detail favorite user
	Route::post('/favorite/{user_favorite_id}/detail', 'ApiFavoriteController@detailFavorite');
	//delete favorite user
	Route::post('/favorite/{id}/delete', 'ApiFavoriteController@destroy');
	// favorite user action
	Route::post('/favorite/{id}/action', 'ApiFavoriteController@action');

	//search products
	Route::get('/search/{id}', 'ApiSearchController@index');
	Route::get('/search_action', 'ApiSearchController@action');
	Route::post('/search_saved', 'ApiSearchController@saved');
	//search log
	Route::post('/search_log', 'ApiSearchController@searchLog');
	Route::post('/search_log/{search_id}/delete', 'ApiSearchController@searchLogDestroy');

	//user profile->TODO
	Route::get('/profile', 'ApiProfileController@index');
	Route::post('/profile', 'ApiProfileController@post');

	//verify user->later
	Route::post('/verify_phone', 'ApiVerifyAccountController@index');
	Route::post('/check_verify_phone', 'ApiVerifyAccountController@check');

	//reset password user
	Route::post('/resetpassword', 'ApiPasswordController@resetpassword');

	//list products user->finish
	Route::post('/product_user/{id}', 'ApiProductController@listProductUser');

	//black list user->finish
	Route::post('/blacklist', 'ApiBlackListController@index');
	Route::post('/blacklist/{black_id}/delete', 'ApiBlackListController@destroy');

	//list message
	Route::post('/message/history/{chat_id}', 'ApiMessageController@history');
	Route::post('/message', 'ApiMessageController@index');
	//send message in the user inter@bcc0me
	Route::post('/message/user/{chat_id}', 'ApiMessageController@sendUser');
	//delete convertion with chat_id
	Route::post('/message/user/delete/{chat_id}', 'ApiMessageController@deleteUserMessage');

	Route::post('/message/show/{message_id}', 'ApiMessageController@show');
	Route::post('/message/delete/{message_id}', 'ApiMessageController@destroy');
	//send chat offline in the product
	Route::post('/message/send/{id}', 'ApiMessageController@sendProduct');
	//active status message
	Route::post('/message/active/{id}', 'ApiMessageController@active');

	//send report, feedback
	Route::post('/product/{id}/report', 'ApiReportController@post');

	//list products status->finish
	Route::post('/product_status/{status}', 'ApiProductController@listStatus');

	//list products hidden->finish
	Route::post('/product_hidden', 'ApiProductController@listHidden');

	//list product of account:TODO
	Route::post('/account/{id}', 'ApiProfileController@account');
	//block account:TODO
	Route::post('/block/{id}', 'ApiProfileController@block');

	//text hardcode: policy, introduce, contact
	Route::post('/text/{id}', 'ApiTextController@index');

	//upload images user
	Route::post('/upload_image', 'ApiUploadController@store');
	//upload images product
	Route::post('/upload_image/product', 'ApiUploadController@imageProduct');

	Route::post('/moMessage', 'ApiSmsController@moMessage');
	Route::post('/mtMessage', 'ApiSmsController@mtMessage');


});
