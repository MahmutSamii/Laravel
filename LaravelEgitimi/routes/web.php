<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Ornek;
use App\Http\Controllers\Yonet;
use App\Http\Controllers\Formislemleri;
use App\Http\Controllers\Veritabaniislemleri;
use App\Http\Controllers\Modelislemleri;
use App\Http\Controllers\iletisim;
use App\Http\Controllers\ResimYukle;
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

Route::get('/upload', function () {
    return view('upload');
});
Route::post('/resim-ilet',[ResimYukle::class,'resimYukleme'])->name('yukle');
/*Route::get('/ornek',function (){
   return view('ornek');
});*/

Route::get('/phpturkiye/{isim}',[Ornek::class,'test']);
Route::get('/web',[Yonet::class,'site'])->name('web');
Route::get('/form',[Formislemleri::class,'gorunum']);
Route::middleware('arakontrol')->post('/form-sonuc',[Formislemleri::class,'sonuc'])->name('sonuc');
Route::get('/ekle',[Veritabaniislemleri::class,'ekle']);
Route::get('/guncelle',[Veritabaniislemleri::class,'guncelle']);
Route::get('/sil',[Veritabaniislemleri::class,'sil']);
Route::get('/getir',[Veritabaniislemleri::class,'bilgiler']);

Route::get('/modelliste',[Modelislemleri::class,'liste']);
Route::get('/modelekle',[Modelislemleri::class,'ekle']);
Route::get('/modelguncelle',[Modelislemleri::class,'guncelle']);
Route::get('/modelsil',[Modelislemleri::class,'sil']);

Route::get('/iletisim',[iletisim::class,'index']);
Route::post('/iletisim-sonuc',[iletisim::class,'ekleme'])->name('iletisim-sonuc');
Route::get('/uye', function () {
    return view('uyelik');
});
Route::post('/uye-kayit',[App\Http\Controllers\uyelikislemleri::class,'uyekayit'])->name('uyekayit');
Route::get('/tema', function () {
    return view('sayfalar.anasayfa');
});
Route::get('/galeri', function () {
    return view('sayfalar.galeri');
});
Route::get('/hizmetler', function () {
    return view('sayfalar.hizmetler');
});

Route::get('/resim',function (){
  /*$img = Image::make('photo1.png')->resize(300,300);
  $img->save('manzara.jpg');
  return $img->response('jpg');*/

  return view('resim');
});

Route::post('/yukle',function(){
Image::make(request()->file('resim'))->resize(300, 200)->save('yeniresim.jpg');
})->name('yukle');
