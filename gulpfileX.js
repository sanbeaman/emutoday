var elixir = require('laravel-elixir');

// npm install laravel-elixir-browserify-official --save-dev
// require('laravel-elixir-browserify-official');
 require('laravel-elixir-vueify');
//
// var  browserify = elixir.config.js.browserify;
//
//
// browserify .transformers.push({
//     name: "vueify",
//     options : {}
// });
// Enable full sourcemaps with browserify. Disable in production.
elixir.config.js.browserify.options.debug = true;
/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
  */


// elixir.config.js.browserify.watchify.options.poll = true;


var paths = {
	'bootstrapsass': 'node_modules/bootstrap-sass/assets/',
	'adminlte': '/node_modules/adminlte/build/'
}
/*
 |--------------------------------------------------------------------------
 | Public Asset Management
 |--------------------------------------------------------------------------
 |
  */
elixir(function(mix) {
	// COPY Vendor Font Files to Resource Folder
	//
	mix.copy('resources/assets/fonts/foundation-icons.*', 'public/fonts');
	mix.copy('resources/assets/fonts/foundation-icons.*', 'public/build/fonts');

	// COPY Vendor Style Files to Resource Folder
	//
	mix.copy('node_modules/foundation-datepicker/css/foundation-datepicker.css','resources/assets/css/foundation-datepicker.css')

	// COPY Vendor Script Files to Resource Folder
	//
	mix.copy('node_modules/foundation-sites/js/*.js', 'resources/assets/js/foundation');

	mix.copy('node_modules/motion-ui/dist/motion-ui.js', 'resources/assets/js/foundation');
	mix.copy('node_modules/foundation-datepicker/js/foundation-datepicker.js','resources/assets/js/plugins');

	// FOUNDATION SASS
	//
	mix.sass('public-app.scss',
					'resources/assets/css/zfoundation.css',
					{
						includePaths: [
							'node_modules/motion-ui/src',
							'node_modules/foundation-sites/scss/'
						],
						outputStyles: 'expanded'
					}
				);

	/*
	|---------------------------
	| Public StyleSheet mix
	|---------------------------
	 */
		mix.styles([
				'zfoundation.css',
				'resources/assets/css/foundation-datepicker.css',
				'main-styles.css',
				'story-styles.css',
				'magazine-styles.css',
				'tweeks.css',
				'media-queries.css'
			], 'public/css/public-styles.css');


			mix.scripts(
		    [
		      'vendor/jquery.min.js',
		      'vendor/what-input.min.js',
		      'foundation/motion-ui.js',
		      'foundation/foundation.core.js',
		      'foundation/foundation.abide.js',
		      'foundation/foundation.accordion.js',
		      'foundation/foundation.accordionMenu.js',
		      'foundation/foundation.drilldown.js',
		      'foundation/foundation.dropdown.js',
		      'foundation/foundation.dropdownMenu.js',
		      'foundation/foundation.equalizer.js',
		      'foundation/foundation.interchange.js',
		      'foundation/foundation.magellan.js',
		      'foundation/foundation.offcanvas.js',
		      'foundation/foundation.orbit.js',
		      'foundation/foundation.responsiveMenu.js',
		      'foundation/foundation.responsiveToggle.js',
		      'foundation/foundation.reveal.js',
		      'foundation/foundation.slider.js',
		      'foundation/foundation.sticky.js',
		      'foundation/foundation.tabs.js',
		      'foundation/foundation.toggler.js',
		      'foundation/foundation.tooltip.js',
		      'foundation/foundation.util.box.js',
		      'foundation/foundation.util.keyboard.js',
		      'foundation/foundation.util.mediaQuery.js',
		      'foundation/foundation.util.motion.js',
		      'foundation/foundation.util.nest.js',
		      'foundation/foundation.util.timerAndImageLoader.js',
		      'foundation/foundation.util.touch.js',
		      'foundation/foundation.util.triggers.js',
		      'resources/assets/js/plugins/foundation-datepicker.js',
		      'app.js'
		    ],
		    'resources/assets/js/foundation-all.js'
		  );

			/*
			|---------------------------
			| Public Script Concat Mix
			|---------------------------
			 */
				mix.scripts([
					'resources/assets/js/foundation-all.js'
				], 'public/js/public-scripts.js' );

				// mix.browserify('main.js', 'public/js/main.js');
});
/*
 |--------------------------------------------------------------------------
 | Admin Asset Management
 |--------------------------------------------------------------------------
 |
  */
elixir(function(mix) {
	// COPY Vendor Font Files to Resource Folder
	//
	mix.copy('node_modules/adminlte/build/bootstrap-less', 'resources/assets/less/adminlte/bootstrap-less/');
	mix.copy('node_modules/adminlte/build/less/*', 'resources/assets/less/adminlte/less/');

	// mix.copy('node_modules/bootstrap-sass/assets/fonts/bootstrap/glyphicons-halflings-regular.*', 'resources/assets/fonts/bootstrap');
	// mix.copy('resources/assets/fonts/bootstrap/glyphicons-halflings-regular.*', 'public/fonts');
	// mix.copy('resources/assets/fonts/bootstrap/glyphicons-halflings-regular.*', 'public/build/fonts/bootstrap');

	// COPY Vendor Style Files to Resource Folder
	//
	//

		// COPY Vendor Script Files to Resource Folder
		//
	mix.copy('node_modules/moment/moment.js', 'resources/assets/js/moment.js');
	mix.copy('node_modules/vue-datetime-picker/src/vue-datetime-picker.js', 'resources/assets/js/vue-vendor/vue-datetime-picker.js');

	mix.copy('bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js', 'resources/assets/js/lib/bootstrap-datetimepicker.min.js');
	mix.copy('bower_components/eonasdan-bootstrap-datetimepicker/build/*', 'public/themes/plugins/eonasdan-bootstrap-datetimepicker');

	// ADMIN LESS
	//
	mix.less('admin.less',
					'resources/assets/css/admin-less.css',
					{
						includePaths: [
							'node_modules/adminlte/build/less',
							'node_modules/adminlte/build/bootstrap-less'
						],
						outputStyles: 'expanded'
					}
				);
	// ADMIN SASS
	// mix.sass('admin.scss',
	// 					'resources/assets/css/admin-sass.css',
	// 					{
	// 						includePaths: [
	// 							paths.bootstrapsass + 'stylesheets/'
	// 						]
	// 					}
	// 				);

/*
|---------------------------
| Admin StyleSheet mix
|---------------------------
 */
	mix.styles([
				 'admin-less.css',
				'jquery.datetimepicker.css',
				'admin.css'
			], 'public/css/admin-styles.css');

	/*
	|---------------------------
	| Vendor Script Concat Mix
	|---------------------------
	 */

	mix.scripts([
		'resources/assets/js/vendor-admin/jquery.min.js',
		'resources/assets/js/vendor-admin/bootstrap.js',
		'resources/assets/js/moment.js',
	], 'public/js/vendor-scripts.js');


	// mix.browserify('vue-admin.js', 'public/js/vue-admin.js');
	// mix.browserify('admintools.js', 'public/js/admintools.js');
	// mix.browserify('main-form.js', 'public/js/main-form.js');

});
/*
 |--------------------------------------------------------------------------
 | Version Asset Management
 |--------------------------------------------------------------------------
 |
  */
// elixir(function(mix) {
// 	mix.version(['css/public-styles.css','js/public-scripts.js','css/admin-styles.css', 'js/vendor-scripts.js','js/admin-scripts.js']);
// });
