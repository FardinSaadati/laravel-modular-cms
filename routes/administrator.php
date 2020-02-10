<?php

Route::group( ['prefix' => 'administrator'] ,function() {

    Route::get( '403' , [ 'as' => '403' , function () { return view('errors.403')->with('title' , '403'); }]);

    Route::get('password/reset', 'Password\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
    Route::post('password/email', 'Password\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'Password\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'Password\ResetPasswordController@reset')->name('password.reset.post');

    Route::get('/lock', ['as' => 'admin.lock' , 'uses' => 'admin\auth\LockController@lockScreenGet']);
    Route::post('/lock',['as' => 'admin.lock' , 'uses' => 'admin\auth\LockController@lockScreenPost']);
    Route::get('/CancelLockScreen', ['as' => 'admin.lock.cancel' , 'uses' => 'admin\auth\LockController@lockScreenCancel']);

    Route::group( ['middleware' => 'admin_guest'] ,function() {
        Route::get('/login', ['as' => 'admin.login', 'uses' => 'admin\auth\LoginController@showLoginForm']);
        Route::post('/login', ['as' => 'admin.login', 'uses' => 'admin\auth\LoginController@login']);
    });

    Route::group( ['middleware' => ['admin_auth','admin_locked']] ,function() {

        Route::get('/', ['as' => 'admin', 'uses' => 'admin\DashboardController@index']);
        Route::get('/dashboard', ['as' => 'admin.dashboard', 'uses' => 'admin\DashboardController@index']);
        Route::get('/logout', ['as' => 'admin.logout', 'uses' => 'admin\auth\LoginController@logout']);

        Route::get('/settings', ['as' => 'admin.site.settings', 'uses' => 'admin\SettingsController@settingsView'])->middleware('can:'.config('permissions.PERMISSION_SETTINGS'));
        Route::post('/settings', ['as' => 'admin.site.settings', 'uses' => 'admin\SettingsController@settingsUpdate'])->middleware('can:'.config('permissions.PERMISSION_SETTINGS'));

        Route::get('/mediaManager', ['as' => 'admin.mediaManager', 'uses' => 'admin\DashboardController@mediaManager'])->middleware('can:'.config('permissions.PERMISSION_FILE_MANAGER'));

        Route::post('/AjaxGetCities', ['as' => 'admin.AjaxGetCities', 'uses' => 'CountryCities\CountryCitiesController@AjaxGetCities']);

        // Users Profile Section --------------------------------------------------------------------------------
        Route::get('/profile', ['as' => 'admin.profile', 'uses' => 'admin\auth\ProfileController@profile']);
        Route::get('/profile/edit', ['as' => 'admin.profile.edit', 'uses' => 'admin\auth\ProfileController@profileEdit']);
        Route::post('/profile/update', ['as' => 'admin.profile.update', 'uses' => 'admin\auth\ProfileController@profileUpdate']);
        Route::post('/profile/ajaxImageUpload', ['as' => 'admin.ajax.imageUpload', 'uses' => 'admin\auth\ProfileController@ajaxUpload']);
        Route::get('/profile/ImageRemove', ['as' => 'admin.profile.image.remove', 'uses' => 'admin\auth\ProfileController@profilePictureRemove']);
        // Users Profile Section --------------------------------------------------------------------------------

        // Admin Users Section ----------------------------------------------------------------------------------
        Route::group( ['middleware' => 'can:'.config('permissions.PERMISSION_ADMIN_USERS')] ,function() {

            Route::resource('roles' , 'admin\RoleController' , ['except' => ['destroy'] ]);
            Route::get('/roles/delete/{role}', ['as' => 'roles.delete', 'uses' => 'admin\RoleController@destroy']);


            Route::get('/users', ['as' => 'admin.users', 'uses' => 'admin\auth\RegisterController@usersList']);
            Route::get('/users/create', ['as' => 'admin.user.create', 'uses' => 'admin\auth\RegisterController@createAdmin']);
            Route::post('/users/create', ['as' => 'admin.user.create', 'uses' => 'admin\auth\RegisterController@postCreate']);
            Route::get('/users/update/{admin}', ['as' => 'admin.user.update', 'uses' => 'admin\auth\RegisterController@updateAdmin']);
            Route::post('/users/update/{admin}', ['as' => 'admin.user.update', 'uses' => 'admin\auth\RegisterController@postUpdate']);
            Route::get('/user/remove/{admin}', ['as' => 'admin.user.remove', 'uses' => 'admin\auth\RegisterController@userDelete']);
            Route::post('/users/AjaxStatusUpdate', ['as' => 'admin.status.update', 'uses' => 'admin\auth\RegisterController@statusUpdate']);
        });
        // Admin Users Section ----------------------------------------------------------------------------------

        // Public Users Section ----------------------------------------------------------------------------------
        Route::group( ['middleware' => 'can:'.config('permissions.PERMISSION_PUBLIC_USERS')] ,function() {

            Route::get('/publicUsers', ['as' => 'admin.publicUsers', 'uses' => 'admin\PublicUsersController@index']);
            Route::post('/publicUsers/dataTables', ['as' => 'admin.publicUsers.datatables.data', 'uses' => 'admin\PublicUsersController@anyData']);

            Route::post('/publicUsers/AjaxStatusUpdate', ['as' => 'admin.publicUsers.status.update', 'uses' => 'admin\PublicUsersController@statusUpdate']);

            Route::get('/publicUsers/create', ['as' => 'admin.publicUsers.create', 'uses' => 'admin\PublicUsersController@create']);
            Route::post('/publicUsers/save', ['as' => 'admin.publicUsers.save', 'uses' => 'admin\PublicUsersController@save']);
        });
        // Public Users Section ----------------------------------------------------------------------------------

        // Pages Section    -------------------------------------------------------------------------------------
        Route::group( ['middleware' => 'can:'.config('permissions.PERMISSION_STATIC_PAGES')] ,function() {
            Route::get('/pages/list', ['as' => 'admin.pages.list', 'uses' => 'admin\PagesController@index']);
            Route::get('/pages/add', ['as' => 'admin.pages.add', 'uses' => 'admin\PagesController@add']);
            Route::post('/pages/create', ['as' => 'admin.pages.create', 'uses' => 'admin\PagesController@create']);
            Route::get('/pages/edit/{page}', ['as' => 'admin.pages.edit', 'uses' => 'admin\PagesController@edit']);
            Route::post('/pages/update/{page}', ['as' => 'admin.pages.update', 'uses' => 'admin\PagesController@update']);
            Route::get('/pages/delete/{page}', ['as' => 'admin.pages.delete', 'uses' => 'admin\PagesController@delete']);
        });
        // Pages Section    -------------------------------------------------------------------------------------

    });
});