<?php

namespace emutoday\Providers;

use emutoday\View\Composers;
// use emutoday\View\ThemeViewFinder;
use Illuminate\Support\ServiceProvider;
use Phirehose;
use emutoday\TwitterStream;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app['view']->composer(['layouts.auth', 'layouts.backend', 'admin.layouts.master'], Composers\AddStatusMessage::class);
        $this->app['view']->composer(['*'], Composers\AddCurrentUser::class);
        $this->app['view']->composer(['layouts.backend', 'admin.layouts.master','admin.layouts.global', 'admin.layouts.adminlte'], Composers\AddAdminUser::class);
        // $this->app['view']->composer('layouts.frontend', Composers\InjectPages::class);

        // $this->app['view']->setFinder($this->app['theme.finder']);
        //
        // Validator::extend('date_more_format', function($attribute, $value, $formats)
                // {
                // 	//iterate thru all formats
                // 	foreach($formats as $format) {
                // 		//pare date thru curretn format
                // 		$parsed = date_parse_from_format($format, \Carbon::parse($value));
                // 		// if value matches given format return true=validation succeeded
            //     if ($parsed['error_count'] === 0 && $parsed['warning_count'] === 0) {
            //       return true;
            //     }
                // 	}
                // 	//value didn't match
                // 	return false;
                // }
                //
                //
                // )
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
      $this->app->bind('emutoday\TwitterStream', function ($app) {
            $twitter_access_token = env('TWITTER_ACCESS_TOKEN', null);
            $twitter_access_token_secret = env('TWITTER_ACCESS_TOKEN_SECRET', null);
            return new TwitterStream($twitter_access_token, $twitter_access_token_secret, Phirehose::METHOD_FILTER);
        });
        // $this->app->singleton('theme.finder', function($app) {
        //   $finder = new ThemeViewFinder($app['files'], $app['config']['view.paths']);
        //   $config = $app['config']['cms.theme'];
        //   $finder->setBasePath($app['path.public'].'/'.$config['folder']);
        //   $finder->setActiveTheme($config['active']);
        //   return $finder;
        // });
    }
}
