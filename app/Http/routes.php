<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Input;

Route::group([
	'middleware' => ['web'], 
	'namespace'  => 'Def',
], function () {
	if(!DB::connection()->getDatabaseName()){
		Route::get('/', [
			'as'   => 'instal',
			'uses' => 'InstallController@index',
		]);

		Route::post('/', [
			'as'   => 'instal',
			'uses' => 'InstallController@index',
		]);
	} else {
		# Index
		Route::get('/', [
			'as'   => 'index',
			'uses' => 'IndexController@index',
		]);
	}

	# Home
	Route::get('/home', [
		'as'   => 'home',
		'uses' => 'IndexController@index',
	]);

	# Movies
	Route::get('/movies', [
		'as'   => 'movies',
		'uses' => 'IndexController@movies',
	]);

	# Show Movies
	Route::get('/movies/{id}-{slug}', [
		'as'   => 'show.movies',
		'uses' => 'IndexController@showMovies',
	]);

	# Tv
	Route::get('/tv', [
		'as'   => 'tv',
		'uses' => 'IndexController@tv',
	]);

	# Show Tv
	Route::get('/tv/{id}-{slug}', [
		'as'   => 'show.tv',
		'uses' => 'IndexController@showTv',
	]);

	# Comments
	Route::post('/mc', [
		'as'   => 'add.com',
		'uses' => 'CommentsController@store',
	]);

	Route::post('/mc/delete/{id}', [
		'as'   => 'delete.com',
		'uses' => 'CommentsController@destroy',
	]);

	# Celebs
	Route::get('/celebs', [
		'as'   => 'celebs',
		'uses' => 'IndexController@celebs',
	]);

	# Show Celebs
	Route::get('/celebs/{id}-{slug}', [
		'as'   => 'show.celebs',
		'uses' => 'IndexController@showCelebs',
	]);

	# News
	Route::get('/news', [
		'as'   => 'news',
		'uses' => 'IndexController@news',
	]);

	# Show News
	Route::get('/news/{id}-{slug}', [
		'as'   => 'show.news',
		'uses' => 'IndexController@showNews',
	]);

	Route::get('/page/{slug}', [
		'as'   => 'show.page',
		'uses' => 'IndexController@showPage',
	]);

	# Favourites
	Route::get('/favourites', [
		'as'   => 'favs',
		'uses' => 'IndexController@favs',
	]);

	# Contact
	Route::get('/contact', [
		'as'   => 'contact',
		'uses' => 'IndexController@contact',
	]);

	Route::post('/contact', [
		'as'   => 'contact.send',
		'uses' => 'IndexController@contactSend',
	]);

	# Search
	Route::get('/search', [
		'as'   => 'search',
		'uses' => 'IndexController@search',
	]);

	# Vote
	Route::post('/vote', [
		'as'   => 'vote',
		'uses' => 'IndexController@vote',
	]);

	# Vote
	Route::post('/like', [
		'as'   => 'like',
		'uses' => 'IndexController@like',
	]);
});

Route::group(['middleware' => 'web'], function () {
	Route::get('admin/login', 'Admin\LoginController@getLogin');
	Route::post('admin/login', [
		'as'   => 'admin.login.post',
		'uses' => 'Admin\LoginController@postLogin',
	]);

	Route::post('/login', [
		'as'   => 'login.post',
		'uses' => 'Auth\AuthController@postLogin',
	]);

	Route::get('/logout', [
		'as'   => 'logout',
		'uses' => 'Auth\AuthController@logout',
	]);

	Route::get('/social/{provider}',[
	    'uses' => 'Auth\AuthController@redirectToProvider',
	    'as'   => 'auth.social'
	]);

	Route::get('/social/callback/{provider}',[
	    'uses' => 'Auth\AuthController@handleProviderCallback',
	    'as'   => 'auth.socialCallback'
	]);

	Route::get('/register',[
	    'uses' => 'Auth\AuthController@getRegister',
	    'as'   => 'auth.register'
	]);

	Route::post('/register',[
	    'uses' => 'Auth\AuthController@postRegister',
	    'as'   => 'auth.post.register'
	]);

	Route::get('/password/email',[
	    'uses' => 'Auth\PasswordController@getEmail',
	    'as'   => 'auth.reset.email'
	]);

	Route::post('/password/email',[
	    'uses' => 'Auth\PasswordController@postEmail',
	    'as'   => 'auth.reset.post.email'
	]);

	Route::get('/password/reset/{token}',[
	    'uses' => 'Auth\PasswordController@getReset',
	    'as'   => 'auth.reset'
	]);

	Route::post('/password/reset',[
	    'uses' => 'Auth\PasswordController@postReset',
	    'as'   => 'auth.reset.post'
	]);
});

Route::group([
	'middleware' => ['web', 'admin'], 
	'namespace'  => 'Admin', 
	'prefix'  => 'admin'
], function () {
	# Admin
	Route::get('/', [
        'as'   => 'admin',
        'uses' => 'AdminController@index',
    ]);

    # Post
	Route::get('/movies-data', function () {
	    $tvShow = tmdb()->getTVShow(46896)->get();

	    return $tvShow;
	});

    # Post Movies Data
	Route::post('/movies-data/{provider}/{id}', [
        'as'   => 'movies.getData',
        'uses' => 'MoviesController@getData',
    ]);

    # Post Tv Data
	Route::post('/tv-data/{provider}/{id}', [
        'as'   => 'tv.getData',
        'uses' => 'TvController@getData',
    ]);

    # Post Person Data
	Route::post('/person-data/{provider}/{id}', [
        'as'   => 'person.getData',
        'uses' => 'PersonsController@getData',
    ]);

    Route::resource('movies', 'MoviesController');
    Route::resource('tv', 'TvController');
    Route::resource('persons', 'PersonsController');
    Route::resource('news', 'NewsController');
    Route::resource('users', 'UsersController');
    Route::resource('slider', 'SliderController');
    Route::resource('nav', 'NavController');
    Route::resource('pages', 'PagesController');
    Route::resource('ads', 'AdsController');
    Route::resource('settings', 'SettingsController');
});