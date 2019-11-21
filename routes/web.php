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

Route::get('/', 'UserPageController@show_home_page')->name('home_page');
Route::get('/reading/{article_id}','UserPageController@show_reading_page')->name('reading_page');
Route::get('/discussion/{discussion_id}','UserPageController@show_discussion_reading_page')->name('discussion_reading_page');
Route::get('/articles','UserPageController@show_articles_page')->name('show_articles_page');
Route::get('/forum','UserPageController@show_forum_page')->name('show_forum_page');
Route::any('/search','SearchingController@search_term')->name('search');
Route::get('/articles_with_subject/{subject_id}','ArticleController@get_articles_with_subject')->name('get_articles_with_subject');
Route::post('/user_preview','UserPageController@show_user_profile_preview');

Route::group(['prefix' => 'user','middleware' => 'auth'],function(){
  Route::get('/','UserController@show_dashboard')->name('user_dashboard');
  Route::get('/user_staticstic','UserController@show_user_staticstic')->name('show_user_staticstic_page');

  Route::prefix('profile')->group(function(){
    Route::get('/','UserController@show_user_profile')->name('show_user_profile_page');
    Route::post('/avatar_with_url','UserController@set_avatar_with_url');
    Route::post('/avatar_with_file','UserController@set_avatar_with_file');
    Route::post('/update','UserController@update_profile')->name('update_profile');
    Route::get('/show_pw_page','UserController@show_user_changing_password')->name('show_user_changing_password_page');
    Route::post('/change_password','UserController@update_password')->name('change_password');
  });

  Route::prefix('action')->group(function(){
    Route::get('/get_article_subjects','ArticleController@get_all_subjects');
    Route::get('/get_tags_list','ArticleController@get_tags_with_query');
    Route::post('/add_image','ArticleController@add_image');

    Route::post('/post_article_comment','ReadingController@add_comment_with_ajax');
    Route::post('/post_article_reply','ReadingController@add_reply_with_ajax');
    Route::post('/like_comment','ReadingController@like_comment_with_ajax');
    Route::post('/unlike_comment','ReadingController@unlike_comment_with_ajax');

    Route::post('/post_discussion_comment','DiscussionController@add_comment_with_ajax');
    Route::post('/post_discussion_reply','DiscussionController@add_reply_with_ajax');
    Route::post('/like_discussion_comment','DiscussionController@like_comment_with_ajax');
    Route::post('/unlike_discussion_comment','DiscussionController@unlike_comment_with_ajax');
    Route::post('/like_discussion','DiscussionController@like_discussion_with_ajax');
    Route::post('/unlike_discussion','DiscussionController@unlike_discussion_with_ajax');
    Route::post('/upvote_discussion','DiscussionController@upvote_discussion_with_ajax');
    Route::post('/downvote_discussion','DiscussionController@downvote_discussion_with_ajax');

    Route::get('/get_discussion_categories','DiscussionController@get_discussion_categories');
  });

  Route::prefix('bdteam')->group(function(){
    Route::get('/content_executive/approve_page','UserController@show_article_approving')->name('show_article_approving_page');
    Route::get('/content_executive/approve_article/approve/{article_id}','ArticleController@approve_article');
    Route::post('/content_executive/approve_article/deny','ArticleController@deny_article');
  });

  Route::prefix('article')->group(function(){
    Route::get('/new','UserController@show_creating_article')->name('show_creating_article_page');
    Route::post('/create','ArticleController@create')->name('create_article');
    Route::post('/update','ArticleController@update')->name('update_article');
    Route::get('/view/{article_id}','UserController@show_editing_article')->name('show_editing_article_page');
    Route::get('/list','UserController@show_article_list')->name('show_article_list_page');
    Route::get('/rules','UserController@show_rule')->name('show_writing_article_rule_page');
    Route::get('/review/{article_id}','ArticleController@get_article_ajax');
    Route::delete('/delete','ArticleController@delete');
    Route::get('/denied_info/{article_id}','ArticleController@get_denied_info');
  });

  Route::prefix('discussion')->group(function(){
    Route::get('/new','UserController@show_creating_discussion')->name('show_creating_discussion_page');
    Route::post('/create','DiscussionController@create')->name('creating_discussion');
  });
});


Route::get('bongden_login','BongdenLoginController@index')->name('bongden_login_show_form')->middleware('isloginbefore');
Route::post('bongden_login','BongdenLoginController@login')->name('bongden_login');
Route::post('bongden_register','BongdenRegisterController@register')->name('bongden_register');
Route::get('bongden_logout','AuthSession@destroy')->name('bongden_logout');

Route::get('/home', 'HomeController@index')->name('home');

/*For debug only. Remove these routes when release*/
Route::get('/_debugbar/assets/stylesheets', [
'as' => 'debugbar-css',
'uses' => '\Barryvdh\Debugbar\Controllers\AssetController@css']);

Route::get('/_debugbar/assets/javascript', [
'as' => 'debugbar-js',
'uses' => '\Barryvdh\Debugbar\Controllers\AssetController@js']);
