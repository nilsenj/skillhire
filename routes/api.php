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

Route::group(['middleware' => ['api']], function () {
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
        });

        Route::group(['prefix' => 'profile'], function () {
            Route::get('/show/{id?}', [
                'uses' => 'ProfileController@show',
            ]);
            Route::post('/delete', [
                'uses' => 'ProfileController@create',
            ]);
            Route::put('/update', [
                'uses' => 'ProfileController@update',
            ]);
        });
        Route::group(['prefix' => 'contacts'], function () {
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