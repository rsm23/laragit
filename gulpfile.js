const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application as well as publishing vendor resources.
 |
 */

elixir((mix) => {
    mix.sass(['../../../node_modules/codemirror/lib/codemirror.css', '../../../node_modules/codemirror/theme/material.css', 'app.scss']);
    mix.sass('custom.scss')
        .webpack('app.js');
    mix.copy('node_modules/font-awesome/fonts', 'public/fonts');
    mix.copy('node_modules/codemirror/', 'public/codemirror/');
    mix.scripts(['../../../node_modules/codemirror/lib/codemirror.js', '../../../node_modules/codemirror/addon/mode/loadmode.js'], 'public/js/libs.js');
    mix.scripts('libS/highlight.js', 'public/js/hljs.js');
});
