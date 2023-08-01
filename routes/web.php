
<?php

use Illuminate\Support\Facades\Route;

// use , namespace

Route::get('/', function() {
    return 'homepage';
});

Route::get('/contact-us', function() {
    return 'contact us';
});
