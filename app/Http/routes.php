<?php
/*
*************
The ORDER of ROUTES is critical
*/
use emutoday\Building;
use emutoday\Event;

use Illuminate\Support\Facades\Input;

Route::group(['prefix' => 'api'], function() {
  //events api
    Route::get('events/{id}/categories', 'Api\CategoriesController@index');
   Route::resource('events', 'Api\EventsController');
   Route::resource('categories', 'Api\CategoriesController', ['only'=>['index', 'show']] );
    Route::resource('minicalendars', 'Api\MiniCalendarsController', ['only'=>['index', 'show']] );
   Route::get('buildings', function() {
     $text = Input::get('q');
     return Building::likeSearch('name', $text)->get();
     //return Building::ofMapType('illustrated')->get();
   });
});

Route::group(['middleware' => ['web']], function() {

    Route::controller('auth/password', 'Auth\PasswordController', [
        'getEmail' => 'auth.password.email',
        'getReset' => 'auth.password.reset'
    ]);

    Route::controller('auth', 'Auth\AuthController', [
      'getLogin' => 'auth.login',
      'getLogout' => 'auth.logout'
    ]);
    //watch out for match anything ROUTES
    // Route::get('page/{id}', ['as' => 'story_page', function($id) {
    //         return ' id=' . $id;
    //
    // }]);
    Route::get('admin/users/{users}/confirm', ['as' => 'admin.users.confirm', 'uses' => 'Admin\UsersController@confirm']);
    Route::resource('admin/users', 'Admin\UsersController', ['except' => ['show'] ]);

    // Route::get('backend/pages/{pages}/confirm', ['as' => 'backend.pages.confirm', 'uses' => 'backend\PagesController@confirm']);
    // Route::resource('backend/pages', 'Backend\PagesController', ['except' => ['show'] ]);
    //
    // Route::get('backend/blog/{blog}/confirm', ['as' => 'backend.blog.confirm', 'uses' => 'Backend\BlogController@confirm']);
    // Route::resource('backend/blog', 'Backend\BlogController');
    //
    Route::get('admin/story/setup/{stype}/', ['as' => 'admin_story_setup', 'uses' => 'Admin\StoryController@setup']);

    // Route::get('admin/story/create/{stype}/', ['as' => 'admin_story_create', 'uses' => 'Admin\StoryController@create']);
    Route::get('admin/story/{story}/confirm', ['as' => 'admin.story.confirm', 'uses' => 'Admin\StoryController@confirm']);
    // Route::get('admin/storyType/{storyType?}', ['as' => 'admin.storyType', 'uses' => 'Admin\StoryController@build']);
    // Route::get('admin/storyType/story/{story}', ['as' => 'admin.storyType.story', 'uses' => 'Admin\StoryController@build']);
    Route::post('admin/story/{id}/addimage', 'Admin\StoryController@addImage');

    Route::resource('admin/story', 'Admin\StoryController');

    Route::get('admin/announcement/{announcement}/confirm', ['as' => 'admin.announcement.confirm', 'uses' => 'Admin\AnnouncementController@confirm']);
    Route::resource('admin/announcement', 'Admin\AnnouncementController');
    // Route::get('admin/storyType/{storyType?}', function ($storyType = null ) {
    //     return 'storyType='. $storyType;
    // });

    Route::get('admin/storyimages/{storyimages}/confirm', ['as' => 'admin.storyimages.confirm', 'uses' => 'Admin\StoryImageController@confirm']);
    Route::resource('admin/storyimages', 'Admin\StoryImageController');

    Route::get('admin/pages/{page}/confirm', ['as' => 'admin.pages.confirm', 'uses' => 'Admin\PagesController@confirm']);
    Route::resource('admin/pages', 'Admin\PagesController');

    Route::get('admin/dashboard', ['as' => 'admin.dashboard', 'uses' => 'Admin\DashboardController@index']);

    Route::get('api/story', ['as' => 'api.story', 'uses' => 'Api\StoryController@index']);
    Route::resource('api/story', 'Api\StoryController');

    // Route::resource('api/events', 'Api\EventsController');

    // Route::get('api/events', function() {
    //   return emutoday\Event::latest()->get();
    // });

    Route::get('admin/event/{event}/confirm', ['as' => 'admin.event.confirm', 'uses' => 'Admin\EventController@confirm']);
    Route::resource('admin/event', 'Admin\EventController');

    // Route::get('fetch/buildings', function() {
    //   $text = Input::get('q');
    //   return Building::likeSearch('name', $text)->get();
    //   //return Building::ofMapType('illustrated')->get();
    // });




    Route::get('storytype/{story_type}/{id}', 'MainController@main');

      Route::get('/', ['as' => '/', 'uses' => 'MainController@index']);
    // Route::resource('/', 'MainController');

    // Route::get('main', function ()    {
    // return view('layouts.main');
    // });

});
