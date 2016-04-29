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
 */

elixir.config.publicPath = 'public/themes/default/assets';

elixir.config.js.browserify.watchify.options.poll = true;
/*
elixir.config.css.sass.pluginOptions.includePaths = [
  'node_modules/foundation-sites/scss',
  'node_modules/font-awesome/scss'
];
*/

elixir.config.css.sass.pluginOptions.includePaths = [
  'node_modules/foundation-sites/scss',
  'node_modules/font-awesome/scss'
];

elixir(function(mix) {

  var rootPath = "../../../";
  var nodePath = rootPath + "node_modules/";



    //mix.copy('node_modules/bootstrap-sass/assets/fonts', elixir.config.publicPath+'/fonts');
  //  mix.copy(elixir.config.assetsPath + '/foundation-icons', elixir.config.publicPath+'/fonts/foundation-icons');
    mix.copy(nodePath + 'font-awesome/fonts', elixir.config.publicPath+'/fonts');
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

    mix.browserify('main.js');
    
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
    mix.styles([
        nodePath + 'foundation-sites/dist/foundation.css',
        'site.css',
        'site-mediaqueries.css'
      ], 'public/themes/default/assets/css/public-styles.css');
  /*
  |---------------------------
  | Admin StyleSheet mix
  |---------------------------
   */
    mix.styles([
          nodePath + 'foundation-sites/dist/foundation.css',
          nodePath + 'foundation-datepicker/css/foundation-datepicker.css',
          'admin.css',
          'site-mediaqueries.css'
        ], 'public/themes/default/assets/css/admin-styles.css');
  /*
  |---------------------------
  | Public Script Concat Mix
  |---------------------------
   */
    mix.scripts([
        'vendor/jquery.min.js',
        'vendor/what-input.min.js',
        nodePath + 'foundation-sites/dist/foundation.js',
        'app.js'
    ], 'public/themes/default/assets/js/public-scripts.js' );

    /*
    |---------------------------
    | Admin Script Concat Mix
    |---------------------------
     */

    mix.scripts([
      'vendor/jquery.min.js',
      'vendor/what-input.min.js',
      nodePath + 'foundation-sites/dist/foundation.js',
      nodePath + 'foundation-datepicker/js/foundation-datepicker.js',
      'app.js'
    ], 'public/themes/default/assets/js/admin-scripts.js' );
  //  mix.sass('app.scss');





});
