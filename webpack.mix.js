const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')
   .version()
   .copyDirectory('resources/editor/js', 'public/js')
   .copyDirectory('resources/editor/css', 'public/css');
// Laravel Mix 给出的方案是为每一次的文件修改做哈希处理。只要文件修改，
// 哈希值就会变，提醒客户端需要重新加载文件，很巧妙地解决了我们的问题。
// 我们只需要对 webpack.mix.js 稍作修改，即可使用此功能：
// 以上可看出，我们只是增加了 version() 函数的调用，其他未做修改。
