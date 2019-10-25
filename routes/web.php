<?php

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

//Route::get('/{any}', 'SinglePageController@index')->where('any', '.*');
Route::get('/blog_admin', 'SinglePageController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/vuelogin', 'Auth\LoginController@vuelogin');

Route::get('/', '\WebDevEtc\BlogEtc\Controllers\BlogEtcReaderController@index')
    ->name('blogetc.admin.index');

//Route::post('/saveStackPreferences', '\WebDevEtc\BlogEtc\Controllers\BlogEtcAdminController@saveStackPreferences');

Route::get('ajaxRequest', 'HomeController@ajaxRequest');

Route::post('ajaxRequest', 'HomeController@ajaxRequestPost');

Route::post('ajaxRequestCommentJson', 'HomeController@ajaxRequestCommentJson');

Route::post('ajaxRequestPostJson', 'HomeController@ajaxRequestPostJson');

Route::post('save_comment_ajax/{blogPostSlug}', '\WebDevEtc\BlogEtc\Controllers\BlogEtcCommentWriterController@addNewCommentAjax');

Route::post('save_comment_comment/{commentId}', '\WebDevEtc\BlogEtc\Controllers\BlogEtcCommentWriterController@addNewCommentCommentAjax');