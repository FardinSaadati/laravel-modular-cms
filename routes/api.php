<?php
Route::get('settings', 'api\settingsController@getAllSettings');

Route::post('auth', 'api\auth\LoginController@numberReceive');
Route::post('auth/login', 'api\auth\LoginController@login');
Route::post('auth/activateAccount', 'api\auth\LoginController@activateAccount');

Route::post('auth/checkUser', 'api\auth\LoginController@checkUser');


Route::post('auth/register', 'api\auth\RegisterController@register');
Route::post('auth/accountActivate', 'api\auth\RegisterController@activate');
Route::post('auth/sendCodeAgain', 'api\auth\RegisterController@sendCodeAgain');

Route::post('auth/updateUserInfo', 'api\auth\RegisterController@updateUserInfo');

Route::post('auth/addAddress', 'api\auth\RegisterController@addAddress');
Route::post('auth/removeAddress', 'api\auth\RegisterController@removeAddress');

Route::post('profile/ajaxImageUpload', 'api\auth\RegisterController@ajaxImageUpload');
Route::post('profile/ajaxImageRemove', 'api\auth\RegisterController@ajaxImageRemove');


Route::get('/pay', 'api\paymentController@pay');
Route::any('/callBackFromBank', 'api\paymentController@callBack');


Route::get('/getSpecificPage/{Page}', 'api\pagesController@getSpecificPage');


//Route::get('/logVisit', 'api\visitors\visitorController@saveVisitLog');


Route::get('/getStates', 'CountryCities\CountryCitiesController@getStates');
Route::get('/getCities', 'CountryCities\CountryCitiesController@getCities');
Route::post('/getDistricts', 'CountryCities\CountryCitiesController@getDistricts');


