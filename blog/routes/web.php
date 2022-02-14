<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\Homepage;
use App\Http\Controllers\Back\Dashboard;
use App\Http\Controllers\Back\AuthController;
use App\Http\Controllers\Back\ArticleController;
use App\Http\Controllers\Back\CategoryController;
use App\Http\Controllers\Back\PageController;
use App\Http\Controllers\Back\ConfigController;


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

Route::get('aktif-degil',function(){
   return view('front.offline');
});

/*
|--------------------------------------------------------------------------
| Backend Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware('isLogin')->group(function(){
   Route::post('giris',[AuthController::class,'loginPost'])->name('login.post');
   Route::get('giris',[AuthController::class,'login'])->name('login');
});
Route::prefix('admin')->name('admin.')->middleware('isAdmin')->group(function(){
    Route::get('panel',[Dashboard::class,'index'])->name('dashboard');

    //MAKALE ROUTES
    Route::get('makaleler/silinenler',[ArticleController::class,'trashed'])->name('trashed.article');
    Route::resource('makaleler',ArticleController::class);
    Route::get('/switch',[ArticleController::class,'switch'])->name('switch');
    Route::get('/deletearticle/{id}',[ArticleController::class,'delete'])->name('delete.article');
    Route::get('/harddeletearticle/{id}',[ArticleController::class,'harddelete'])->name('hard.delete.article');
    Route::get('/recoverarticle/{id}',[ArticleController::class,'recover'])->name('recover.article');
    //CATEGORY ROUTES
    Route::get('/kategoriler',[CategoryController::class,'index'])->name('category.index');
    Route::get('/kategori/status',[CategoryController::class,'switch'])->name('category.switch');
    Route::post('/kategori/create',[CategoryController::class,'create'])->name('category.create');
    Route::post('/kategori/update',[CategoryController::class,'update'])->name('category.update');
    Route::post('/kategori/delete',[CategoryController::class,'delete'])->name('category.delete');
    Route::get('/kategori/getData',[CategoryController::class,'getData'])->name('category.getdata');
    //PAGE'S ROUTE'S
    Route::get('/sayfalar',[PageController::class,'index'])->name('page.index');
    Route::get('/sayfalar/olustur',[PageController::class,'create'])->name('page.create');
    Route::post('/sayfalar/olustur',[PageController::class,'post'])->name('page.create.post');
    Route::get('/sayfalar/duzenle/{id}',[PageController::class,'update'])->name('page.edit');
    Route::post('/sayfalar/duzenle/{id}',[PageController::class,'updatePost'])->name('page.edit.post');
    Route::get('/sayfa/switch',[PageController::class,'switch'])->name('page.switch');
    Route::get('/sayfa/sil/{id}',[PageController::class,'delete'])->name('page.delete');
    Route::get('/sayfa/siralama',[PageController::class,'orders'])->name('page.orders');
    //Config's route
    Route::get('/ayarlar',[ConfigController::class,'index'])->name('config.index');
    Route::post('/ayarlar/update',[ConfigController::class,'update'])->name('config.update');
    //
    Route::get('cikis',[AuthController::class,'logout'])->name('logout');
});


/*
|--------------------------------------------------------------------------
| Front Routes
|--------------------------------------------------------------------------
*/

Route::get('/',[Homepage::class,'index'])->name('homepage');
Route::get('sayfa',[Homepage::class,'index']);
Route::get('/iletisim',[Homepage::class,'contact'])->name('contact');
Route::post('/iletisim',[Homepage::class,'contactpost'])->name('contact.post');
Route::get('/kategori/{category}',[Homepage::class,'category'])->name('category');
Route::get('/{category}/{slug}',[Homepage::class,'single'])->name('single');
Route::get('/{sayfa}',[Homepage::class,'page'])->name('page');


