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
  Route::get('berita', 'BeritaController@semuaBerita');
  Route::get('berita/{slug}', 'BeritaController@bacaBerita');
  Route::get('kejuaraan', 'KejuaraanController@indexKejuaraan');
  Route::get('kejuaraan/{id}', 'KejuaraanController@detailKejuaraan');
  Route::get('gallery', 'GalleryController@getGallery');
  Route::get('gallery/detail/{id}', 'GalleryController@detailGallery');
  Route::get('pemain', 'PemainController@getPemain');
  Route::get('rangking', 'RangkingController@index');
  Route::get('rangking/cari', 'RangkingController@cari');
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

  // Route untuk Klub
  Route::get('klub/data-klub', 'ClubController@getClub');
  Route::post('klub/tambah-klub', 'ClubController@simpanClub');
  Route::put('klub/{id_klub}', 'ClubController@updateClub');
  Route::delete('klub/{id_klub}', 'ClubController@deleteClub');

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
  Route::post('rangking/tambah-rangking', 'RangkingController@simpanRangking');
  Route::get('rangking/daftar-rangking','RangkingController@indexRanking');
  Route::put('rangking/{id_rangking}', 'RangkingController@updateRanking');
  Route::delete('rangking/{id_rangking}', 'RangkingController@deleteRanking');

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

  // Route Gallery
  Route::get('gallery/tambah-gallery', 'GalleryController@tambahGallery');
  Route::post('gallery/tambah-gallery', 'GalleryController@simpanGallery');
  Route::get('gallery/daftar-gallery', 'GalleryController@indexGallery');
  Route::put('gallery/{id_gallery}', 'GalleryController@updateGallery');
  Route::delete('gallery/{id_gallery}', 'GalleryController@deleteGallery');

  // Route Gallery Photo
  Route::get('gallery/tambah-foto/{id_gallery}', 'GalleryController@getPhoto');
  Route::post('gallery/tambah-foto', 'GalleryController@tambahPhoto');
  Route::put('gallery/tambah-foto/{id_foto}', 'GalleryController@updatePhoto');
  Route::delete('gallery/tambah-foto/{id_foto}', 'GalleryController@deletePhoto');
  // Other Routing can create here
});
