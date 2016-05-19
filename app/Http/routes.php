<?php
/*
*************
The ORDER of ROUTES is critical
*/
use emutoday\Building;
use emutoday\Event;

use Illuminate\Support\Facades\Input;

Route::group(['prefix' => 'api'], function() {

  Route::get('active-categories/{currentdate?}','Api\CategoriesController@activeCategories');
  Route::get('calendar/month/{year?}/{month?}','Api\EventsController@eventsInMonth');
  Route::get('calendar/events/{year?}/{month?}/{day?}','Api\EventsController@eventsByDay');
  //events api
  Route::get('eventview', function() {
    return view('public.event.home');
  });
  Route::get('eventfoam', function() {
    return view('public.event.form');
  });
  // Route::get('calendar/events', 'Api\EventsController@byDate');
  Route::get('events/{id}/categories', 'Api\CategoriesController@index');
   Route::resource('events', 'Api\EventsController');
   Route::resource('categories', 'Api\CategoriesController', ['only'=>['index', 'show']] );
    Route::resource('minicalendars', 'Api\MiniCalendarsController', ['only'=>['index', 'show']] );
   Route::get('buildings', function() {
     $text = Input::get('q');
     return Building::likeSearch('name', $text)->get();
     //return Building::ofMapType('illustrated')->get();
   });
   Route::get('story', ['as' => 'api.story', 'uses' => 'Api\StoryController@index']);
   Route::resource('story', 'Api\StoryController');

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
    Route::get('/', ['as' => '/', 'uses' => 'MainController@index']);

    Route::group(['prefix' => 'emu-today'], function() {
      Route::get('story/{id?}', 'EmuToday\StoryController@index');
      Route::get('news/{id?}', 'EmuToday\StoryController@index');
      Route::get('student/{id?}', 'EmuToday\StudentController@index');
      Route::get('calendar', 'EmuToday\CalendarController@index');
      // Route::get('magazine/index', 'EmuToday\MagazineController@index');
      Route::get('magazine/article/{id?}', 'EmuToday\MagazineController@article');
      Route::get('magazine/{year?}/{season?}', 'EmuToday\MagazineController@index');

      Route::get('announcement/{id?}', 'EmuToday\AnnouncementController@index');

      Route::get('hub', 'MainController@index');


      Route::get('events', function() {
          return view('public.event.index');
        });
    });

    //watch out for match anything ROUTES

    Route::group(['prefix' => 'admin'], function()
    {
      Route::get('magazine/{magazine}/confirm', ['as' => 'admin.magazine.confirm', 'uses' => 'Admin\MagazineController@confirm']);

      Route::resource('magazine', 'Admin\MagazineController');

      Route::get('users/{users}/confirm', ['as' => 'admin.users.confirm', 'uses' => 'Admin\UsersController@confirm']);
      Route::resource('users', 'Admin\UsersController', ['except' => ['show'] ]);


      Route::get('story/setup/{stype}/', ['as' => 'admin_story_setup', 'uses' => 'Admin\StoryController@setup']);

      // Route::get('admin/story/create/{stype}/', ['as' => 'admin_story_create', 'uses' => 'Admin\StoryController@create']);
      Route::get('story/{story}/confirm', ['as' => 'admin.story.confirm', 'uses' => 'Admin\StoryController@confirm']);
      // Route::get('admin/storyType/{storyType?}', ['as' => 'admin.storyType', 'uses' => 'Admin\StoryController@build']);
      // Route::get('admin/storyType/story/{story}', ['as' => 'admin.storyType.story', 'uses' => 'Admin\StoryController@build']);
      Route::post('story/{id}/addimage', 'Admin\StoryController@addImage');

      Route::resource('story', 'Admin\StoryController');

      Route::get('announcement/{announcement}/confirm', ['as' => 'admin.announcement.confirm', 'uses' => 'Admin\AnnouncementController@confirm']);
      Route::resource('announcement', 'Admin\AnnouncementController');

      Route::get('storyimages/{storyimages}/confirm', ['as' => 'admin.storyimages.confirm', 'uses' => 'Admin\StoryImageController@confirm']);
      Route::resource('storyimages', 'Admin\StoryImageController');

      Route::get('page/{page}/confirm', ['as' => 'admin.page.confirm', 'uses' => 'Admin\PageController@confirm']);
      Route::resource('page', 'Admin\PageController');

      Route::get('dashboard', ['as' => 'admin.dashboard', 'uses' => 'Admin\DashboardController@index']);

      Route::get('event/{event}/confirm', ['as' => 'admin.event.confirm', 'uses' => 'Admin\EventController@confirm']);
      Route::resource('event', 'Admin\EventController');

    });


});
