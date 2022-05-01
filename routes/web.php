<?php

use App\Models\Room;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/test', 'HomeController@test')->name('test');

Route::group(['as' => 'cinema.'], function () {
    // Home
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/about', 'HomeController@showAbout')->name('about');
    Route::get('/contact', 'HomeController@showContact')->name('contact');

    //Category
    Route::get('/category/{slug}', 'HomeController@productByCategory')->name('movie.list.category');

    // Movie
    Route::get('/movie', 'HomeController@showListMovie')->name('movie.list');
    Route::get('/search', 'HomeController@searchMovie')->name('movie.search');
    Route::get('/movie/{slug}', 'HomeController@showMovieDetail')->name('movie.detail');

    // Auth
    Route::get('/user/login', 'HomeController@showLogin')->name('auth.login');
    Route::get('/user/register', 'HomeController@showRegister')->name('auth.register');


    Route::group(['middleware' => ['auth']], function () {
        // Profile
        Route::get('/profile', 'HomeController@profile')->name('profile');
        Route::get('/profile/change-password', 'HomeController@changePassword')->name('profile.change-password');
        Route::post('/profile/update', 'HomeController@updateProfile')->name('profile.update.handle');
        Route::post('/profile/update-password', 'HomeController@updatePassword')->name('profile.change-password.handle');
        Route::post('/profile/update-avatar', 'HomeController@updateAvatar')->name('profile.update-avatar.handle');

        // Booking
        Route::get('/booking/{movieId}/choose-show', 'HomeController@chooseShow')->name('booking.choose-show');
        Route::post('/booking/{movieId}/choose-show', 'HomeController@chooseShow')->name('booking.choose-show.handle');
        Route::get('/booking/{movieId}/{showId}/choose-seat', 'HomeController@chooseSeat')->name('booking.choose-seat');
        Route::post('/booking/{movieId}/{showId}/get-seat-ids', 'HomeController@getSeatIds')->name('booking.get-seat-ids');
        Route::get('/booking/payment', 'HomeController@showPayment')->name('booking.payment');
        Route::post('/booking/payment', 'HomeController@payment')->name('booking.payment.handle');
        Route::get('/booking/success', 'HomeController@showBookingSuccess')->name('booking.success');
        Route::get('/booking/failed', 'HomeController@showBookingFailed')->name('booking.failed');
        Route::get('/booking/list', 'HomeController@getBookingList')->name('booking.list');
        Route::get('/booking/{id}', 'HomeController@getDetailBooking')->name('booking.detail');
    });
});

Route::get('/dashboard/login', 'LoginDashboardController@showLoginForm')->name('dashboard.login');
Route::post('/dashboard/login', 'LoginDashboardController@login')->name('dashboard.handle.login');

Route::group(['prefix' => '/dashboard', 'middleware' => ['auth', 'dashboard.access']], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard.index');
    Route::get('/profile', 'DashboardController@showProfile')->name('dashboard.profile');
    Route::post('/profile', 'DashboardController@updateProfile')->name('dashboard.profile.update');
    Route::get('/profile/password', 'DashboardController@showUpdatePassword')->name('dashboard.profile.show-update-password');
    Route::post('/profile/password', 'DashboardController@updatePassword')->name('dashboard.profile.update-password');
    Route::post('/profile/avatar', 'DashboardController@updateAvatar')->name('dashboard.profile.update-avatar');
    Route::get('/file-manager', 'DashboardController@fileManager')->name('dashboard.file-manager');
    Route::get('/income', 'OrderController@incomeChart')->name('product.order.income');

    Route::get('/show/choose-movie', 'ShowController@chooseMovie')->name('show.choose.movie');
    Route::get('/show/{id}/create', 'ShowController@createShow')->name('show.create.movie');

    Route::resources([
        'category' => 'CategoryController',
        'booking' => 'BookingController',
        'movie' => 'MovieController',
        'show' => 'ShowController',
        'language' => 'LanguageController',
        'actor' => 'ActorController',
        'seat' => 'SeatController',
        'type-seat' => 'TypeSeatController',
        'room' => 'RoomController',
        'show' => 'ShowController',
        'time-slot' => 'TimeSlotController',
        'user' => 'UserController',
    ]);
});

Auth::routes();

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth', 'dashboard.access']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
