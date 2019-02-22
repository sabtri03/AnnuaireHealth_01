/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)
require('../css/app.scss');
require('../scss/superlist.css');
require('../css/global.scss');
//require('../css/superlist.scss');
//require('../css/scss/superlist.scss');

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
var $ = require('jquery');
require('bootstrap');
//require('owl.carousel');
//require('font-awesome');
// import the function from greet.js (the .js extension is optional)
// ./ (or ../) means to look for a local file
var greet = require('./greet');


$('document').ready(function(){
    console.log('Hello Webpack Encore! Edit me in assets/js/app.js ! or not');
    $('body').prepend('<h1>'+greet('jill')+'</h1>');
});
