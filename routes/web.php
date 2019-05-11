<?php

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
    return view('welcome');
});
Auth::routes();

Route::get('login', function(){
  return view('login');
});

// Routing Admin
Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function(){
  Route::get('dashboard', 'DashboardController@index');

  // Routing untuk berita
  Route::get('berita/tambah-berita', 'BeritaController@tambahBerita');
  Route::post('berita/tambah-berita', 'BeritaController@simpanBerita');
  Route::get('berita/data-berita', 'BeritaController@indexBerita');
  Route::get('berita/{id_berita}/edit-berita', 'BeritaController@editBerita');
  Route::put('berita/{id_berita/edit-berita}', 'BeritaController@updateBerita');

  // Other Routing can create here
});

// Routing Pengunjung/User
Route::group(['namespace' => 'User'], function(){
  Route::get('/', 'HomeController@index');

  // Other Routing can create here
});
