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


Auth::routes();

Route::group(['namespace' => 'Frontend'], function(){
  Route::get('/', 'HomeController@index');
});

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
  Route::put('berita/{id_berita}/edit-berita', 'BeritaController@updateBerita');
  Route::delete('berita/{id_berita}', 'BeritaController@deleteBerita');

  // Route untuk Atlet
  Route::get('atlet/tambah-atlet', 'AtletController@tambahAtlet');
  Route::post('atlet/tambah-atlet', 'AtletController@simpanAtlet');
  Route::get('atlet/data-atlet', 'AtletController@indexAtlet');
  Route::get('atlet/{id_atlet}/edit-atlet', 'AtletController@editAtlet');
  Route::put('atlet/{id_atlet}/edit-atlet', 'AtletController@updateAtlet');
  Route::delete('atlet/{id_atlet}', 'AtletController@deleteAtlet');

  // Route Kategori dan rangking
  Route::get('kategori', 'RangkingController@indexKategori');
  Route::post('kategori/tambah-kategori', 'RangkingController@simpanKategori');
  Route::put('kategori/{id_kategori}', 'RangkingController@updateKategori');
  Route::delete('kategori/{id_kategori}', 'RangkingController@deleteKategori');

  Route::get('rangking/tambah-rangking', 'RangkingController@tambahRangking');

  // Route Kejuaraan
  Route::get('kejuaraan/tambah-kejuaraan', 'KejuaraanController@tambahKejuaraan');
  Route::post('kejuaraan/tambah-kejuaraan', 'KejuaraanController@simpanKejuaraan');
  Route::get('kejuaraan/daftar-kejuaraan', 'KejuaraanController@indexKejuaraan');
  Route::put('kejuaraan/{id_kejuaraan}', 'KejuaraanController@updateKejuaraan');
  Route::delete('kejuaraan/{id_kejuaraan}', 'KejuaraanController@deleteKejuaraan');

  // Route Berkas Kejuaraan
  Route::post('kejuaraan/{id_kejuaraan}', 'KejuaraanController@simpanDocument');
  Route::get('kejuaraan/berkas/{id_kejuaraan}', 'KejuaraanController@getBerkas');
  Route::put('kejuaraan/berkas/{id_kejuaraan}', 'KejuaraanController@updateBerkas');
  Route::get('ketentuan/{get_ketentuan}/download', 'KejuaraanController@downloadKetentuan')->name('ketentuan.download');
  Route::get('tatacara/{get_tatacara}/download', 'KejuaraanController@downloadTatacara')->name('tatacara.download');
  Route::get('hasil/{get_hasil}/download', 'KejuaraanController@downloadHasil')->name('hasil.download');
  // Other Routing can create here
});
