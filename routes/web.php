
<?php

use Illuminate\Support\Facades\Route;

// use , namespace

// Route::post('/', function() {
//     return 'homepage';
// });

// Route::put('/', function() {
//     return 'homepage';
// });

// Route::get('/', function() {
//     return 'homepage - get';
// });

// Route::get('/contact-us', function() {
//     return 'contact us';
// });


// Route::method('url', 'action');

// Route::get('url', 'action');
// Route::post('url', 'action');
// Route::put('url', 'action');
// Route::patch('url', 'action');
// Route::delete('url', 'action');
// Route::options('url', 'action');

// index, about, contact, services, our team, blog

// http://127.0.0.1:8000/
Route::get('/', function() {
    $link = route('about');
    return "<a href='$link'>About Us</a>";
});

Route::get('/about-us', function() {
    return 'About Us';
})->name('about');

Route::get('/contact', function() {
    return 'Contact Us';
});

Route::post('/contact', function() {
    return 'Contact Us Data';
});

Route::get('/services', function() {
    return 'Our Services';
});

Route::get('/our-team', function() {
    return 'Our Team';
});

Route::get('/blog', function() {
    return 'Our Blog';
});

Route::get('/sessions/{name}/{type?}', function($name, $type = 'online') {

    return "Course: $name & type: $type";
    // if($hours == 0) {
    //     return "Course Name Is : $name" ;
    // }else {
    //     return "Course Name Is : $name & Course Hours = $hours" ;
    // }
})->name('course.single');

// https://bakkah.com/sessions/ecba/self-study
// https://bakkah.com/sessions/ecba/class-room
// https://bakkah.com/sessions/ecba

Route::get('subject/{name}', function($name) {
    return "Subject $name";
});
// ->whereAlpha('name')
// ->whereNumber('name');
// ->whereAlphaNumeric('name');
// ->where('name', '[A-Ta-t]+');
