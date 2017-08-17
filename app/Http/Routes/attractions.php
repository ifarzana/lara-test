<?php

/*Attractions*/
Route::group(array('prefix' => 'attractions', 'as' => 'attractions'), function()
{

    Route::get('/',
        [
            'uses' => 'Attraction\AttractionController@index',
            'middleware' => ['auth', 'acl']
        ]
    );

    Route::get('view',
        [
            'uses' => 'Attraction\AttractionController@view',
            'middleware' => ['auth', 'acl']
        ]
    );

    Route::match(array('GET', 'POST'), 'edit',
        [
            'uses' => 'Attraction\AttractionController@edit',
            'middleware' => ['auth', 'acl']
        ]
    );

    Route::match(array('GET', 'POST'), 'create',
        [
            'uses' => 'Attraction\AttractionController@create',
            'middleware' => ['auth', 'acl']
        ]
    );

    Route::get('delete',
        [
            'uses' => 'Attraction\AttractionController@delete',
            'middleware' => ['auth', 'acl']
        ]
    );

    Route::get('top-attractions',
        [
            'uses' => 'Attraction\AttractionController@topAttractions',
            'middleware' => ['auth', 'acl']
        ]
    );

    Route::get('reviews',
        [
            'uses' => 'Attraction\AttractionController@reviews',
            'middleware' => ['auth', 'acl']
        ]
    );



    /*User groups*/
    Route::group(array('prefix' => 'reviews'), function()
    {
        Route::get('change-status',
            [
                'uses' => 'Attraction\AttractionController@changeStatus',
            ]
        );

        Route::match(array('GET', 'POST'), 'edit',
        [
            'uses' => 'Attraction\AttractionController@editReview',
        ]
         );

        Route::match(array('GET', 'POST'), 'edit-my-review',
        [
            'uses' => 'Attraction\AttractionController@editMyReview',
        ]
         );

        Route::match(array('GET', 'POST'), 'create',
        [
            'uses' => 'Attraction\AttractionController@createReview',
        ]
         );

    });



});