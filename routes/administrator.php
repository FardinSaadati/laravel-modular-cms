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

        // Skills Section   -------------------------------------------------------------------------------------
        Route::group( ['middleware' => 'can:'.config('permissions.PERMISSION_SKILLS')] ,function() {
            Route::get('/skills/list', ['as' => 'admin.skills.list', 'uses' => 'admin\SkillsController@index']);
            Route::get('/skills/add', ['as' => 'admin.skills.add', 'uses' => 'admin\SkillsController@add']);
            Route::post('/skills/create', ['as' => 'admin.skills.create', 'uses' => 'admin\SkillsController@create']);
            Route::get('/skills/edit/{skill}', ['as' => 'admin.skills.edit', 'uses' => 'admin\SkillsController@edit']);
            Route::post('/skills/update/{skill}', ['as' => 'admin.skills.update', 'uses' => 'admin\SkillsController@update']);
            Route::get('/skills/delete/{skill}', ['as' => 'admin.skills.delete', 'uses' => 'admin\SkillsController@delete']);
            Route::post('/skills/AjaxStatusUpdate', ['as' => 'admin.skills.status', 'uses' => 'admin\SkillsController@statusUpdate']);
            Route::get('/skills/image/delete/{skill}', ['as' => 'admin.skills.image.delete', 'uses' => 'admin\SkillsController@SkillImageDelete']);

            Route::get('/skills/categories', ['as' => 'admin.skills.categories', 'uses' => 'admin\SkillsController@categoryList']);
            Route::get('/skills/categories/add', ['as' => 'admin.skills.categories.add', 'uses' => 'admin\SkillsController@categoryAdd']);
            Route::post('/skills/categories/create', ['as' => 'admin.skills.categories.create', 'uses' => 'admin\SkillsController@categoryCreate']);
            Route::get('/skills/categories/edit/{skill_cat}', ['as' => 'admin.skills.categories.edit', 'uses' => 'admin\SkillsController@categoryEdit']);
            Route::post('/skills/categories/update/{skill_cat}', ['as' => 'admin.skills.categories.update', 'uses' => 'admin\SkillsController@categoryUpdate']);
            Route::post('/skills/categories/AjaxStatusUpdate', ['as' => 'admin.skills.categories.status', 'uses' => 'admin\SkillsController@categoryStatusUpdate']);
            Route::get('/skills/categories/delete/{skill_cat}', ['as' => 'admin.skills.categories.delete', 'uses' => 'admin\SkillsController@categoryDelete']);

            Route::post('/skills/AjaxSort', ['as' => 'admin.skills.AjaxSort', 'uses' => 'admin\SkillsController@AjaxSort']);
        });
        // Skills Section   -------------------------------------------------------------------------------------


        // Projects Section   -------------------------------------------------------------------------------------
        Route::group( ['middleware' => 'can:'.config('permissions.PERMISSION_PROJECTS')] ,function() {
            Route::get('/projects/list', ['as' => 'admin.projects.list', 'uses' => 'admin\ProjectsController@index']);
            Route::get('/projects/add', ['as' => 'admin.projects.add', 'uses' => 'admin\ProjectsController@add']);
            Route::post('/projects/create', ['as' => 'admin.projects.create', 'uses' => 'admin\ProjectsController@create']);
            Route::get('/projects/edit/{project}', ['as' => 'admin.projects.edit', 'uses' => 'admin\ProjectsController@edit']);
            Route::post('/projects/update/{project}', ['as' => 'admin.projects.update', 'uses' => 'admin\ProjectsController@update']);
            Route::get('/projects/delete/{project}', ['as' => 'admin.projects.delete', 'uses' => 'admin\ProjectsController@delete']);
            Route::post('/projects/AjaxStatusUpdate', ['as' => 'admin.projects.status', 'uses' => 'admin\ProjectsController@statusUpdate']);
            Route::get('/projects/image/delete/{project}', ['as' => 'admin.projects.image.delete', 'uses' => 'admin\ProjectsController@ProjectImageDelete']);

            Route::get('/projects/categories', ['as' => 'admin.projects.categories', 'uses' => 'admin\ProjectsController@categoryList']);
            Route::get('/projects/categories/add', ['as' => 'admin.projects.categories.add', 'uses' => 'admin\ProjectsController@categoryAdd']);
            Route::post('/projects/categories/create', ['as' => 'admin.projects.categories.create', 'uses' => 'admin\ProjectsController@categoryCreate']);
            Route::get('/projects/categories/edit/{project_cat}', ['as' => 'admin.projects.categories.edit', 'uses' => 'admin\ProjectsController@categoryEdit']);
            Route::post('/projects/categories/update/{project_cat}', ['as' => 'admin.projects.categories.update', 'uses' => 'admin\ProjectsController@categoryUpdate']);
            Route::post('/projects/categories/AjaxStatusUpdate', ['as' => 'admin.projects.categories.status', 'uses' => 'admin\ProjectsController@categoryStatusUpdate']);
            Route::get('/projects/categories/delete/{project_cat}', ['as' => 'admin.projects.categories.delete', 'uses' => 'admin\ProjectsController@categoryDelete']);

            Route::post('/projects/AjaxSort', ['as' => 'admin.projects.AjaxSort', 'uses' => 'admin\ProjectsController@AjaxSort']);
        });
        // Projects Section   -------------------------------------------------------------------------------------
    });
});