var elixir = require('laravel-elixir');
require('laravel-elixir-vueify');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |

 elixir.config.assetsPath = 'public/themes/default/assets';

 elixir.config.publicPath = elixir.config.assetsPath;


elixir.config.publicPath = 'public/themes/default/assets';
  */
elixir.config.js.browserify.watchify.options.poll = true;

/*
elixir.config.css.sass.pluginOptions.includePaths = [
  'node_modules/foundation-sites/scss',
  'node_modules/font-awesome/scss'
];
*/

// elixir.config.css.sass.pluginOptions.includePaths = [
//   'node_modules/foundation-sites/scss',
// ];
var paths = {
	'bootstrapsass': 'node_modules/bootstrap-sass/assets/'
}

elixir(function(mix) {
  var rootPath = "../../../";
  var nodePath = rootPath + "node_modules/";

  var options = {
    includePaths: [
      'node_modules/foundation-sites/scss/',
      'node_modules/motion-ui/src'
    ],
    outputStyles: 'expanded'
  };
	// Copy Vendor Files, Fonts, ETC...
	//
	mix.copy('node_modules/bootstrap-sass/assets/fonts/bootstrap/glyphicons-halflings-regular.*', 'resources/assets/fonts/bootstrap');
	// mix.copy('node_modules/bootstrap/dist/css/bootstrap.min.css', 'resources/assets/css/bootstrap.min.css');
	mix.copy('node_modules/foundation-datepicker/css/foundation-datepicker.css','resources/assets/css/foundation-datepicker.css')


	mix.copy('node_modules/motion-ui/dist/motion-ui.js', 'resources/assets/js/foundation');
  mix.copy('node_modules/foundation-sites/js/*.js', 'resources/assets/js/foundation');
  mix.copy('node_modules/foundation-datepicker/js/foundation-datepicker.js','resources/assets/js/plugins');
	mix.copy('resources/assets/fonts/foundation-icons.*', 'public/fonts');
  mix.copy('resources/assets/fonts/foundation-icons.*', 'public/build/fonts');


  mix.copy('resources/assets/fonts/bootstrap/glyphicons-halflings-regular.*', 'public/fonts');
  mix.copy('resources/assets/fonts/bootstrap/glyphicons-halflings-regular.*', 'public/build/fonts/bootstrap');

	// mix.copy('bower_components/eonasdan-bootstrap-datetimepicker','resources/assets/vendor/eonasdan-bootstrap-datetimepicker');



	// FOUNDATION SASS
	//
  mix.sass('app.scss',
          'resources/assets/css/zfoundation.css',
          {
            includePaths: [
              'node_modules/motion-ui/src',
              'node_modules/foundation-sites/scss/'
            ],
            outputStyles: 'expanded'
          }
        );

	// ADMIN SASS
	mix.sass('admin.scss',
						'resources/assets/css/admin-sass.css',
						{
							includePaths: [
								paths.bootstrapsass + 'stylesheets/'
							]
						}
					);

// mix.copy('node_modules/bootstrap-datetimepicker-build/build/css/bootstrap-datetimepicker.min.css', 'resources/assets/css/bootstrap-datetimepicker.min.css')

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
          /*
          |---------------------------
          | Admin StyleSheet mix
          |---------------------------
           */
            mix.styles([
									'admin-sass.css',
									'admin.css'
                ], 'public/css/admin-styles.css');





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

		  /*
		  |---------------------------
		  | Vendor Script Concat Mix
		  |---------------------------
		   */

		  mix.scripts([
		    'resources/assets/js/vendor-admin/jquery.min.js',
				'resources/assets/js/vendor-admin/bootstrap.js',
		  ], 'public/js/vendor-scripts.js');


  mix.browserify('main.js', 'public/js/main.js');
  // mix.browserify('main9.js', 'public/js/main9.js');
	mix.browserify('admin-scripts.js', 'public/js/admin-scripts.js');
	mix.version(['css/public-styles.css','js/public-scripts.js','css/admin-styles.css', 'js/vendor-scripts.js'])

	});
  /*
  |---------------------------
  | Public Script Concat Mix
  |---------------------------
   */
    // mix.scripts([
    //     'vendor/jquery.min.js',
    //     'vendor/what-input.min.js',
    //     nodePath + 'foundation-sites/dist/foundation.js',
    //     'app.js'
    // ], 'public/themes/default/assets/js/public-scripts.js' );

    /*
    |---------------------------
    | Admin Script Concat Mix
    |---------------------------
     */

    // mix.scripts([
    //   'vendor/jquery.min.js',
    //   'vendor/what-input.min.js',
    //   nodePath + 'foundation-sites/dist/foundation.js',
    //   nodePath + 'foundation-datepicker/js/foundation-datepicker.js',
    //   'app.js'
    // ], 'js/admin-scripts.js' );

    //mix.copy('node_modules/bootstrap-sass/assets/fonts', elixir.config.publicPath+'/fonts');
  //  mix.copy(elixir.config.assetsPath + '/foundation-icons', elixir.config.publicPath+'/fonts/foundation-icons');
    // mix.copy(nodePath + 'font-awesome/fonts', elixir.config.publicPath+'/fonts');
  //  mix.copy(elixir.config.assetsPath + '/foundation-icons', elixir.config.publicPath+'/fonts/foundation-icons');
  //  mix.copy('node_modules/bootstrap-sass/assets/javascripts/bootstrap.min.js', elixir.config.assetsPath+'/js/bootstrap.js');
    //mix.copy('node_modules/jquery/dist/jquery.min.js', elixir.config.assetsPath+'/js/jquery.js');
    //mix.copy('node_modules/foundation-sites/scss/settings/_settings.scss', elixir.config.assetsPath+'/sass/settings.scss');
    //mix.copy('node_modules/foundation-sites/dist/foundation.js', elixir.config.assetsPath+'/js/foundation.js');
    //mix.copy('node_modules/moment/min/moment.min.js', elixir.config.assetsPath+'/js/moment.js');
/*
    mix.copy('node_modules/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js', elixir.config.assetsPath+'/js/datepicker.js');
    mix.copy('node_modules/eonasdan-bootstrap-datetimepicker/src/sass/_bootstrap-datetimepicker.scss', elixir.config.assetsPath+'/sass/datepicker.scss');
    mix.copy('node_modules/simplemde/dist/simplemde.min.css', elixir.config.publicPath+'/css/simplemde.css');
    mix.copy('node_modules/simplemde/dist/simplemde.min.js', elixir.config.assetsPath+'/js/simplemde.js');
*/
    //mix.copy('node_modules/ckeditor', elixir.config.publicPath+'/js/ckeditor');
    //mix.sass('foundation_backend.scss');



    // Combine Styles for the public facing site pages
    /*
    |--***--***--***--***--***--
    |
    | Direct Copy Some Files to Public Folders
    | mix.copy('node_modules/ckeditor', elixir.config.publicPath+'/js/ckeditor');
    | redips (for dragDrop testing)
    |
    |--***--***--***--***--***--
     */

  /*
  |---------------------------
  | Public StyleSheet mix
  |---------------------------
   */

    // mix.styles([
    //
    //     nodePath + 'foundation-sites/dist/foundation.css',
    //     'app.css',
    //     'tweeks.css'
    //   ], 'public/themes/default/assets/css/public-styles.css');
  /*
  |---------------------------
  | Admin StyleSheet mix
  |---------------------------
   */
    // mix.styles([
    //       nodePath + 'foundation-sites/dist/foundation.css',
    //       nodePath + 'foundation-datepicker/css/foundation-datepicker.css',
    //       'admin.css',
    //       'site-mediaqueries.css'
    //     ], 'public/themes/default/assets/css/admin-styles.css');
  /*
  |---------------------------
  | Public Script Concat Mix
  |---------------------------
   */
    // mix.scripts([
    //     'vendor/jquery.min.js',
    //     'vendor/what-input.min.js',
    //     nodePath + 'foundation-sites/dist/foundation.js',
    //     'app.js'
    // ], 'public/themes/default/assets/js/public-scripts.js' );

    /*
    |---------------------------
    | Admin Script Concat Mix
    |---------------------------
     */

    // mix.scripts([
    //   'vendor/jquery.min.js',
    //   'vendor/what-input.min.js',
    //   nodePath + 'foundation-sites/dist/foundation.js',
    //   nodePath + 'foundation-datepicker/js/foundation-datepicker.js',
    //   'app.js'
    // ], 'public/themes/default/assets/js/admin-scripts.js' );
  //  mix.sass('app.scss');
