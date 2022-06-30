<?php

use App\Models\User;

Route::middleware([
    // 'localeSessionRedirect',
    // 'localizationRedirect',
    // 'localeViewPath',
    'auth',
    'role:admin|super_admin|user',
])
    ->group(function () {

        Route::name('admin.')->prefix('admin')->group(function () {

            //home
                Route::get('/home/top_statistics', 'HomeController@topStatistics')->name('home.top_statistics');
                Route::get('/home/movies_chart', 'HomeController@moviesChart')->name('home.movies_chart');
            Route::get('/home', 'HomeController@index')->name('home');
            //product
            Route::get('/product' , 'ProductController@index')->name('product.index');
            Route::get('/product/create' , 'ProductController@create')->name('product.create');
            Route::post('/product/store' , 'ProductController@store')->name('product.store');
            Route::get('/product/data' , 'ProductController@data')->name('product.data');
            Route::post('/user/{id}/{type}' , function($id , $type){
                    $user = User::find($id);
                    $type == 0 ? $user->status =1  : $user->status =0  ;
                    $user->save();
                    session()->flash('success', ( $type == 0 ? "unblock success" : "block success"  ));
                  return redirect()->route('admin.users.index');


            });


            //role routes
            Route::get('/roles/data', 'RoleController@data')->name('roles.data');
            Route::delete('/roles/bulk_delete', 'RoleController@bulkDelete')->name('roles.bulk_delete');
            Route::resource('roles', 'RoleController');

            //admin routes
            Route::get('/admins/data', 'AdminController@data')->name('admins.data');
            Route::delete('/admins/bulk_delete', 'AdminController@bulkDelete')->name('admins.bulk_delete');
            Route::resource('admins', 'AdminController');

            //user routes
            Route::get('/users/data', 'UserController@data')->name('users.data');
            Route::delete('/users/bulk_delete', 'UserController@bulkDelete')->name('users.bulk_delete');
            Route::resource('users', 'UserController');

            //genre routes
            Route::get('/genres/data', 'GenreController@data')->name('genres.data');
            Route::delete('/genres/bulk_delete', 'GenreController@bulkDelete')->name('genres.bulk_delete');
            Route::resource('genres', 'GenreController')->only(['index', 'destroy']);



            //setting routes
            Route::get('/settings/general', 'SettingController@general')->name('settings.general');
            // Route::get('/settings/social_links', 'SettingController@socialLinks')->name('settings.social_links');
            // Route::get('/settings/mobile_links', 'SettingController@mobileLinks')->name('settings.mobile_links');
            Route::resource('settings', 'SettingController')->only(['store']);

            //profile routes
            Route::get('/profile/edit', 'ProfileController@edit')->name('profile.edit');
            Route::put('/profile/update', 'ProfileController@update')->name('profile.update');

            Route::name('profile.')->namespace('Profile')->group(function () {

                //password routes
                Route::get('/password/edit', 'PasswordController@edit')->name('password.edit');
                Route::put('/password/update', 'PasswordController@update')->name('password.update');

            });

        });

    });
