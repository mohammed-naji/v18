
<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\FormController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ProductController;

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
// Route::get('/', function() {
//     $link = route('about');
//     return "<a href='$link'>About Us</a>";
// });

// Route::get('/about-us', function() {
//     return 'About Us';
// })->name('about');

// Route::get('/contact', function() {
//     return 'Contact Us';
// });

// Route::post('/contact', function() {
//     return 'Contact Us Data';
// });

// Route::get('/services', function() {
//     return 'Our Services';
// });

// Route::get('/our-team', function() {
//     return 'Our Team';
// });

// Route::get('/blog', function() {
//     return 'Our Blog';
// });

// Route::get('/sessions/{name}/{type?}', function($name, $type = 'online') {

//     return "Course: $name & type: $type";
//     // if($hours == 0) {
//     //     return "Course Name Is : $name" ;
//     // }else {
//     //     return "Course Name Is : $name & Course Hours = $hours" ;
//     // }
// })->name('course.single');

// https://bakkah.com/sessions/ecba/self-study
// https://bakkah.com/sessions/ecba/class-room
// https://bakkah.com/sessions/ecba

// Route::get('subject/{name}', function($name) {
//     return "Subject $name";
// });
// ->whereAlpha('name')
// ->whereNumber('name');
// ->whereAlphaNumeric('name');
// ->where('name', '[A-Ta-t]+');

// Route::view('test', 'welcome');
// Route::get('test', function() {
//     return view('welcome');
// });

// Route::match(['put', 'patch', 'post'], '/update', function() {
//     return 'Updated';
// });

// Route::get('/', 'MainController@index');
// Route::get('/', [MainController::class, 'index']);

// ''

// index, about, team, services , blog, articles

Route::get('/', [PagesController::class, 'index'])->name('index');
Route::get('/about', [PagesController::class, 'about'])->name('about');
Route::get('/team', [PagesController::class, 'team'])->name('team');
Route::get('/services', [PagesController::class, 'services'])->name('services');
Route::get('/blog', [PagesController::class, 'blog'])->name('blog');
Route::get('/articles', [PagesController::class, 'articles'])->name('articles');

// Controller Type
// Empty Controller
// Resource Controller
// Resource Api Controller
// Invoke Controller

// Route::resource('products', ProductController::class);
//

Route::get('/user/{name}/{age}', [PagesController::class, 'user'])->name('user.profile');



Route::prefix('/blog')->name('blog.')->group(function() {
    Route::get('/', [BlogController::class, 'index'])->name('index');
    Route::get('/about', [BlogController::class, 'about'])->name('about');
    Route::get('/post', [BlogController::class, 'post'])->name('post');
    Route::get('/contact', [BlogController::class, 'contact'])->name('contact');
});




Route::get('form1', [FormController::class, 'form1'])->name('form1');
Route::post('form1', [FormController::class, 'form1_data'])->name('form1_data');


//
