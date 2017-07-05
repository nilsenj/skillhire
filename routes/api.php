<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => ['api'], 'as' => 'api.'], function () {
    Route::post('/register', [
        'uses' => 'Auth\AuthController@register',
    ]);

    Route::post('/signin', [
        'uses' => 'Auth\AuthController@signin',
    ]);

    Route::group(['middleware' => 'jwt.auth'], function () {
        Route::get('/user', [
            'uses' => 'UserController@index',
        ]);
        Route::group(['prefix' => 'vacancy'], function () {
            Route::get('/all', [
                'uses' => 'VacanciesController@all',
            ]);
            Route::get('/show/{id}', [
                'uses' => 'VacanciesController@show',
            ]);
            Route::post('/create', [
                'uses' => 'VacanciesController@create',
            ]);
            Route::put('/update', [
                'uses' => 'VacanciesController@update',
            ]);
            Route::get('/byUser/{id?}', [
                'uses' => 'VacanciesController@byUser',
            ]);
            Route::get('/getDistinctLocations', [
                'uses' => 'VacanciesController@getDistinctLocations',
            ]);
            Route::get('/byLocation/{location}', [
                'uses' => 'VacanciesController@byLocation',
            ]);
            Route::get('/byTrend/{trend}', [
                'uses' => 'VacanciesController@byTrend',
            ]);
            Route::get('/byVariant/{variant}', [
                'uses' => 'VacanciesController@byVariant',
            ]);
        });

        Route::group(['prefix' => 'profile'], function () {
            Route::get('/show/{id?}', [
                'uses' => 'ProfileController@show',
            ]);
            Route::post('/delete', [
                'uses' => 'ProfileController@create',
            ]);
            Route::get('/getVisibility', [
                'uses' => 'ProfileController@getVisibility',
            ]);
            Route::post('/toggleVisibility', [
                'uses' => 'ProfileController@toggleVisibility',
            ]);
            Route::put('/update', [
                'uses' => 'ProfileController@update',
            ]);
        });

        Route::group(['prefix' => 'proposals'], function () {
            Route::post('/store', [
                'uses' => 'ProposalsController@store',
            ]);
        });

        Route::group(['prefix' => 'working_variants'], function () {
            Route::get('/', [
                'uses' => 'WorkingVariantsController@index',
            ]);
        });

        Route::group(['prefix' => 'contacts', 'as' => 'contacts.'], function () {
            Route::get('/show/{id?}', [
                'uses' => 'ContactController@show',
            ]);
            Route::post('/delete', [
                'uses' => 'ContactController@create',
            ]);
            Route::put('/update', [
                'uses' => 'ContactController@update',
            ]);
        });
        Route::group(['prefix' => 'trends', 'as' => 'trends.'], function () {
            Route::get('/', [
                'uses' => 'UserTrendsController@index',
            ]);
        });
        Route::group(['prefix' => 'additional_settings', 'as' => 'additional_settings.'], function () {
            Route::get('/show/{id?}', [
                'uses' => 'AdditionalSettingsController@show',
            ]);
            Route::put('/update', [
                'uses' => 'AdditionalSettingsController@update',
            ]);
        });

        Route::group(['prefix' => 'skills'], function () {
            Route::get('/all', [
                'uses' => 'SkillsController@all',
            ]);
            Route::get('/userSkills', [
                'uses' => 'SkillsController@userSkills',
            ]);
            Route::put('/userSkills', [
                'uses' => 'SkillsController@updateUserSkills',
            ]);
            Route::put('/updateSkillCounter', [
                'uses' => 'SkillsController@updateSkillCounter',
            ]);
            Route::post('/deleteSkill', [
                'uses' => 'SkillsController@deleteSkill',
            ]);
            Route::get('/show/{id}', [
                'uses' => 'SkillsController@show',
            ]);
            Route::post('/create', [
                'uses' => 'SkillsController@create',
            ]);
            Route::put('/update', [
                'uses' => 'SkillsController@update',
            ]);
        });
    });

});
Route::group(['prefix' => 'file', 'as' => 'file.'], function () {
    Route::get('/avatar/{day}/{filename}', [
        'uses' => 'FilesController@avatar',
        'as' => 'avatar'
    ]);
    Route::post('/uploadAvatar', [
        'uses' => 'FilesController@uploadAvatar',
        'middleware' => 'jwt.auth',
        'as' => 'uploadAvatar'
    ]);
    Route::post('/uploadResume', [
        'uses' => 'FilesController@uploadResume',
        'middleware' => 'jwt.auth',
        'as' => 'uploadResume'
    ]);
    Route::get('/resume/{day}/{filename}', [
        'uses' => 'FilesController@resume',
        'as' => 'resume'
    ]);
});