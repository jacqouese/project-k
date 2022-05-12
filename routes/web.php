<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Results;

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


//redirects to pl if no language given
Route::redirect('/', '/pl');

//routes for all pages
Route::get('{lang}/', function () {
    return view('home');
})->name('home');

Route::get('{lang}/search',[Results::class, 'getResults'])->name('search');

Route::get('{lang}/search/{id}',[Results::class, 'singleResult'])->name('searchID');

Route::get('{lang}/searchquery',[Results::class, 'searchquery'])->name('searchquery');

Route::get('{lang}/about', function () {
    return view('about');
})->name('about');

Route::get('{lang}/cookies', function () {
    return view('cookies');
})->name('cookies');

Route::get('{lang}/privacy', function () {
    return view('privacy');
})->name('privacy');

Route::get('{lang}/maps', function () {
    return view('maps');
})->name('maps');

Route::get('{lang}/{url}', function () {
    return view('404');
})->name('404');

Route::get('{lang}/500', function () {
    return view('500');
})->name('500');
