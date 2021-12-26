<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Ornek;
use App\Http\Controllers\Yonet;
use App\Http\Controllers\Formislemleri;
use App\Http\Controllers\Veritabaniislemleri;

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
