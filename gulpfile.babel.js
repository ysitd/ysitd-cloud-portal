import elixir, {config} from 'laravel-elixir';
config.json = {
  folder: 'json',
  outputFolder: 'json'
};

config.images = {
  folder: 'images',
  outputFolder: 'images'
};

import './resources/gulp';

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

elixir(function(mix) {
  mix.css('portal.css');
  mix.js();
  mix.image();
  mix.copy(config.get('assets.json.folder'), config.get('assets.json.outputFolder'));
  mix.monitor();
});
