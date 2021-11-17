<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
//Route::get('/', 'FrontendController@index')->name('home');
// Route::get('/', function () {
//     return view('test');
// });

// Route::resource('player', 'PlayersController', ['only' => [
//     'create', 'store', 'edit'
// ]]);

Route::group([
    'namespace' => 'Frontend',
], function () {
    Route::get('/', 'HomeController@index');

    //blog
    Route::get('/blog-list', 'BlogController@index');
    Route::get('/blog-single/{id}', 'BlogController@show');
    Route::post('/insert-rating', 'BlogController@insert_rating');
    Route::post('/post-comment/{id}', 'BlogController@post_comment');
    // Route::post('/vote/{id}', 'BlogController@vote');
    //    Route::get('/blog-single/{id}/vote', 'BlogController@vote')->middleware('auth');
    //    Route::get('/blog-single/{id}', 'BlogController@showvote');


    //member
    Route::get('/member/login', 'MemberController@vlogin');
    Route::get('/member/register', 'MemberController@vregister');
    Route::post('/member/login', 'MemberController@login');
    Route::get('/logout', 'MemberController@logout');
    Route::post('/member/register', 'MemberController@register');
    Route::get('/account', 'MemberController@create');
    Route::post('/account/save-profile', 'MemberController@store');

    //product
    Route::get('/account/product', 'ProductController@create');
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/', 'DashboardController@index');
// Route::prefix('admin')->group(function () {
//     Route::get('/', 'DashboardController@index');
// });
Route::group([
    'namespace' => 'Admin',
], function () {
    //profile
    Route::get('/profile-admin', 'UserController@profile');
    Route::get('/dashboard', 'DashboardController@index');
    Route::post('/admin-dashboard', 'UserController@dashboard');
    Route::post('/save-profile', 'UserController@save_profile');

    //country
    Route::get('/country', 'CountryController@index');
    Route::get('/country/add', 'CountryController@create');
    Route::post('/country/add', 'CountryController@store');
    Route::get('/country/delete/{id}', 'CountryController@destroy');

    //blog
    Route::get('/blog', 'BlogController@index');
    Route::get('/blog/add', 'BlogController@create');
    Route::post('/blog/add', 'BlogController@store');
    Route::post('/blog/edit/{id}', 'BlogController@update');
    Route::get('/blog/edit/{id}', 'BlogController@edit');
    Route::get('/blog/delete/{id}', 'BlogController@destroy');
});



Route::get('/logout', 'Auth\LoginController@logout');
