<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/

    Route::prefix('admin')->namespace('Admin')->middleware(['auth:admin'])->group(function(){

            Route::get('/','DashboardController@index')->name('admin.dashboard');

             //admins route
             Route::resource('admins','AdminController')->except(['show']);
        

            //Languages route
            Route::resource('languages','LanguagesController')->except(['show']);
        

            
            //MainCategories route
            Route::resource('maincategories','MainCategoriesController')->except(['show']);

               
            //vendors route
            Route::resource('vendors','VendorController')->except(['show']);
        

        

        });//end of admin routs





Route::group([ 'prefix'=>'admin' , 'namespace'=>'Admin','middleware'=>'guest:admin'] ,function(){
            Route::get('login','loginController@getlogin');
            Route::post('login','loginController@postlogin')->name('admin.login');

        });

