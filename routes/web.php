<?php

use App\Http\Controllers\NoteController;
use App\Mail\NoteMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(
    [
        'namespace' => 'App\Http\Controllers'
    ],
    function ()
    {
        Route::get('/email', 'EmailController@welcome')->name('email.welcome');

        Route::get('/', 'SiteController@index')->name('home');
        Route::get('/search', 'SearchController@search')->name('search');
        Route::get('/mail', 'MailController@index')->name('mail');
        Route::get('/admin', 'AdminController@index')->name('admin');
        Route::get('/about', 'SiteController@about')->name('about');

        Route::get('/note', 'NoteController@catalog')->name('note');
        Route::get('/note/create', 'NoteController@create')->name('create');
        Route::post('/note/store', 'NoteController@store')->name('store');
        Route::get('/note/{id}', 'NoteController@view')->name('view')
            ->where('id', '[0-9]+');
        Route::get('/note/edit/{note}', 'NoteController@edit')->name('edit');
        Route::get('/note/delete/{note}', 'NoteController@delete')->name('delete');

        Route::put('/note/update/{note}', 'NoteController@update')->name('update');
    }
);

Auth::routes();

