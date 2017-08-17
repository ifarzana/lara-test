<?php

/*Route::get('/', function () {
    return view('welcome');
});



Route::get('/home', 'HomeController@index');*/

Route::get('/',
    [
        'uses' => 'Index\IndexController@index',
        'middleware' => ['auth']
    ]
);

/*Dashboard*/
Route::get('home', [
        'as' => 'home',
        'uses' => 'HomeController@index',
        'middleware' => ['auth', 'acl']
    ]
);

/*Auth*/
Route::group(array('prefix' => 'auth'), function()
{

    Route::get('/',
        [
            'uses' => 'Auth\AuthController@index'
        ]
    );

    Route::match(array('GET', 'POST'), 'login',
        [
            'uses' => 'Auth\AuthController@login'
        ]
    );

    Route::get('logout',
        [
            'uses' => 'Auth\AuthController@logout'
        ]
    );

    Route::get('restricted-area',
        [
            'uses' => 'Auth\AuthController@restrictedArea'
        ]
    );

    Route::get('no-permission',
        [
            'uses' => 'Auth\AuthController@noPermission'
        ]
    );

    Route::get('suspended-account',
        [
            'uses' => 'Auth\AuthController@suspendedAccount'
        ]
    );

    Route::get('error',
        [
            'uses' => 'Auth\AuthController@error'
        ]
    );

});

/*Attractions*/
include_once('Routes/attractions.php');