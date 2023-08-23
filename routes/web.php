<?php

use App\Http\Controllers\adminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\footballController;
use App\Http\Controllers\basketballController;
use App\Http\Controllers\tennisController;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\NewsUploadController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ForgotPassword;
use App\Models\newsUpload;

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

Route::get('/', function () {
    //return view('welcome');
    $bannerLong = DB::table('banner_uploads')->where('bannertype', 'long')->first();
    $bannerShort = DB::table('banner_uploads')->where('bannertype', 'wide')->first();
    $bannerHome = DB::table('banner_uploads')->where('bannertype', 'Home')->first();
    $news = DB::table('news_uploads')->orderBy('id', 'desc')->take(4)->get();
    return view("home", ['bannerLong' => $bannerLong, 'bannerShort' => $bannerShort, "newses" => $news, 'bannerHome' => $bannerHome]);
})->name('home');
Route::get('/fixture/{fixtureId}/{leagueId}', function () {
    $bannerLong = DB::table('banner_uploads')->where('bannertype', 'long')->first();
    $bannerShort = DB::table('banner_uploads')->where('bannertype', 'wide')->first();
    return view('fixture', ['bannerLongFix' => $bannerLong, 'bannerShortFix' => $bannerShort]);
})->middleware('auth');
Route::get('/basketfix/{fixtureId}/{leagueId}', function () {
    $bannerLong = DB::table('banner_uploads')->where('bannertype', 'long')->first();
    return view('basketfix', ['bannerLong' => $bannerLong]);
})->middleware('auth');
Route::get('/basketballfixture', function () {
    return view('basketballfixture');
})->middleware('auth');
Route::get('/tennisfixture', function () {
    return view('tennisfixture');
})->middleware('auth');
Route::get('livescores', function () {
    $bannerLong = DB::table('banner_uploads')->where('bannertype', 'long')->first();
    $bannerShort = DB::table('banner_uploads')->where('bannertype', 'wide')->first();
    return view("livescores", ['bannerLong' => $bannerLong, 'bannerShort' => $bannerShort]);
});
Route::get('/subscription', function () {
    return view('subscribe');
});
Route::get('/news', function () {
    $bannerLong = DB::table('banner_uploads')->where('bannertype', 'long')->first();
    $news = DB::table('news_uploads')->orderBy('id', 'desc')->paginate(6);
    return view('news', ['bannerLong' => $bannerLong, 'newses' => $news]);
});
Route::get('/news/{postId}', [footballController::class, 'newsData']);
Route::get('football', function () {
    $bannerLong = DB::table('banner_uploads')->where('bannertype', 'long')->first();
    $bannerShort = DB::table('banner_uploads')->where('bannertype', 'wide')->first();
    return view("football", ['bannerLong' => $bannerLong, 'bannerShort' => $bannerShort]);
})->middleware('auth');
Route::get('basketball', function () {
    $bannerLong = DB::table('banner_uploads')->where('bannertype', 'long')->first();
    $bannerShort = DB::table('banner_uploads')->where('bannertype', 'wide')->first();
    return view("basketball", ['bannerLong' => $bannerLong, 'bannerShort' => $bannerShort]);
})->middleware('auth');
Route::get('tennis', function () {
    $bannerLong = DB::table('banner_uploads')->where('bannertype', 'long')->first();
    $bannerShort = DB::table('banner_uploads')->where('bannertype', 'wide')->first();
    return view("tennis", ['bannerLong' => $bannerLong, 'bannerShort' => $bannerShort]);
})->middleware('auth');

/* -------------------------------- Football Routes -------------------------------- */
Route::get('/adminarea', [adminController::class, 'index']);
Route::get('/adminlogin', [adminController::class, 'loginPage']);
Route::get('forgotpassword', [ForgotPassword::class, 'index']);
Route::get('recovery', function () {
    return view('reset');
});
Route::post('forgotpassword', [ForgotPassword::class, 'store'])->name('forgot.store');
Route::post('subscription', [ForgotPassword::class, 'store'])->name('subscribe.store');
Route::post('recovery', [ForgotPassword::class, 'rest'])->name('reset.store');
Route::get('contact', [ContactController::class, 'index']);
Route::post('contact', [ContactController::class, 'store'])->name('contact.us.store');
Route::get('/dashboard', [adminController::class, 'dashboardAdmin'])->name('dashboard.indexs');
Route::get('logoutAdmin', [adminController::class, "logout"])->name('logoutAdmin');
Route::get('/newsUpload', [NewsUploadController::class, 'dashboardAdmin'])->name('dashboard.index');
Route::get('/loadFixture/{fixtureId}/{leagueId}', [footballController::class, 'loadFixtureData'])->middleware('auth');
Route::delete('/dashboard/{id}', [adminController::class, 'destroy'])->name('banner.destroy');
Route::delete('/newsUpload/{id}', [NewsUploadController::class, 'destroy'])->name('news.destroy');
Route::get('/loadHomeGames', [footballController::class, 'loadGames']);
Route::get('/loadEuropeGames', [footballController::class, 'loadEuropeGames']);
Route::get('/loadAmericaGames', [footballController::class, 'loadAmericaGames']);
Route::get('/loadSpainGames', [footballController::class, 'loadSpainGames']);
Route::post('/uploadFile', [adminController::class, 'fileUploadToServer'])->name('uploadFile');
Route::post('/uploadFileNews', [NewsUploadController::class, 'fileUploadToServer'])->name('uploadFileNews');
Route::get('/loadItalyGames', [footballController::class, 'loadItalyGames']);
Route::get('/loadLeagueGames/{leagueId}', [footballController::class, 'loadLeagueGames']);
Route::get('/loadCountries', [footballController::class, 'countries']);
Route::get('/loadLeagues/{countryCode}', [footballController::class, 'leagues']);
Route::get('/loadBasketballGames', [basketballController::class, 'loadGames']);
Route::get('/loadTennisGames', [tennisController::class, 'loadGames']);
Route::get('/countries', [tennisController::class, 'countries']);
Route::get('post-registration', [AuthController::class, 'index']);
Route::post('post-login', [AuthController::class, "postLogin"])->name('login.post');
Route::post('post-registration', [AuthController::class, "postRegistration"])->name('registration.post');
Route::post('post-registration-admin', [adminController::class, "postRegistration"])->name('adminRegistration.post');
Route::post('post-login-admin', [adminController::class, "logine"])->name('loginAdmin.post');
Route::get('logout', [AuthController::class, "logout"])->name('logout');
/* -------------------------------- Basketball Routes -------------------------------- */
Route::get('/loadCountriesBasket', [basketballController::class, 'countries']);
Route::get('/loadLeaguesBasket/{countryId}', [basketballController::class, 'leagues']);
Route::get('/loadLeagueGamesBasket/{leagueId}', [basketballController::class, 'loadLeagueGames']);
Route::get('/loadSpainLeague', [basketballController::class, 'loadSpainLeague']);
Route::get('/loadNbaLeague', [basketballController::class, 'loadNbaGames']);
Route::get('/loadChinaLeague', [basketballController::class, 'loadChinaGames']);
Route::get('/loadUkraineLeague', [basketballController::class, 'loadUkraineGames']);
Route::get('/loadFixtureBasketball/{fixtureId}/{leagueId}', [basketballController::class, 'fixturesGames'])->middleware('auth');
Route::get('/loadFixtureBaske/{fixtureId}/{leagueId}', [basketballController::class, 'showStandings'])->middleware('auth');
Route::get('/loadbasketheadtwohead/{homeId}/{awayId}', [basketballController::class, 'headTwohead'])->middleware('auth');
