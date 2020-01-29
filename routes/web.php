<?php

Auth::routes();

//Welcome page
Route::get('/', 'HomeController@welcome');

//Laravel routes
  Route::get('/laravel', 'HomeController@laravel');
  Route::get('/home', 'HomeController@index')->name('home');
  Route::post('/laravel/status', 'PostController@create')->name('post.status');
  Route::post('/laravel/timeline/update', 'PostController@timelineUpdate')->name('timeline.update');
  Route::post('/laravel/update/link', 'PostController@updateLink')->name('update.link');
  Route::post('/laravel/doot', 'PostController@doot')->name('post.doot');
  Route::post('/laravel/comment', 'PostController@addComment')->name('post.comment');
  Route::get('/laravel/profile', 'LaravelNavigationController@profile')->name('profile');
  Route::get('/laravel/profile/{id}', 'LaravelNavigationController@otherProfile')->name('other.profile');
  Route::post('/laravel/profile/pic/update', 'ProfileController@updateProfilePic')->name('update.profile.pic');
  Route::get('/laravel/about', 'LaravelNavigationController@about')->name('about');
  Route::post('/laravel/video/convert/mp4', 'VideoController@convertMP4')->name('video.convert.mp4');
  Route::post('/laravel/video/convert/ogg', 'VideoController@convertOgg')->name('video.convert.ogg');
  Route::post('/laravel/video/convert/webm', 'VideoController@convertWebm')->name('video.convert.webm');
  Route::post('/laravel/video/convert/progress', 'VideoController@areWeNearlyThereYet')->name('video.convert.progress');
  Route::get('image/upload','ImageUploadController@fileCreate');
  Route::post('image/upload/store','ImageUploadController@fileStore');
  Route::post('image/delete','ImageUploadController@fileDestroy');
