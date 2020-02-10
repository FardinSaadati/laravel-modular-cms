<?php

//Administrator Routs
include_once 'administrator.php';
//Administrator Routs


Route::get( '/' , ['as' => 'home', 'uses' => 'Web\webController@index']);
