var elixir = require('laravel-elixir');
require('laravel-elixir-vueify');

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

		// mix.copy('node_modules/motion-ui/dist/motion-ui.js', 'resources/assets/js/foundation');
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

					mix.browserify('calview.js', 'public/js/calview.js');
					mix.version(['css/public-styles.css','js/public-scripts.js']);

	});
