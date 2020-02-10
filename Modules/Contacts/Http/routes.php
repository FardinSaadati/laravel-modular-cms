<?php

Route::group(['middleware' => ['web' , 'admin_auth', 'admin_locked' , 'can:'.config('permissions.PERMISSION_CONTACTS')] , 'prefix' => 'administrator/contacts', 'namespace' => 'Modules\Contacts\Http\Controllers'], function()
{
    Route::get('/list', ['as' => 'admin.contacts.list', 'uses' => 'ContactController@index']);
    Route::post('/dataTables', ['as' => 'admin.contacts.datatables.data', 'uses' => 'ContactController@anyData']);
    Route::post('/view/{contact}', ['as' => 'admin.contacts.view', 'uses' => 'ContactController@view']);
    Route::post('/delete/{contact}', ['as' => 'admin.contacts.delete', 'uses' => 'ContactController@delete']);
    Route::post('/AjaxStatusUpdate', ['as' => 'admin.contacts.status', 'uses' => 'ContactController@statusUpdate']);

    Route::get( 'clearAll' , ['as' => 'admin.contacts.clearAll', 'uses' => 'ContactController@clearAll']);

});


//API Routes
Route::group(['middleware' => ['api'] , 'prefix' => 'api/contacts', 'namespace' => 'Modules\Contacts\Http\Controllers'], function()
{
    Route::get( 'getContactInfo'     , 'ContactApiController@getContactInfo');
    Route::post('contactMessageSend' , 'ContactApiController@contactMessageSend');
});
//API Routes