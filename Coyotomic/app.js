/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
const $ = require('jquery');

import './levels/app.scss';

require('@fortawesome/fontawesome-free/css/all.min.css');
require('@fortawesome/fontawesome-free/js/all.js');

window.bootstrap = require('bootstrap');

$(document).ready(function() {
    $('body').prepend('<h1 class="caprisimo">Hola Mundo with Jquery, fonts y $pesitos<i class="fa-brands fa-bootstrap"></i></h1><button type="button" class="btn btn-lg btn-danger" data-bs-toggle="popover" title="Popover title" data-bs-content="And here\'s some amazing content. It\'s very engaging. Right?">Click to toggle popover</button>');
    
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl)
    });
});
