<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class Veritabaniislemleri extends Controller
{
    public function ekle()
    {
      DB::table('bilgiler')->insert([
        'metin'=>'bu örnek 2 için oluşturulan bir metin belgesidir'
      ]);
    }

    public function guncelle()
    {
      DB::table('bilgiler')->where('id',1)->update([
        'metin'=>'bu metin alanı güncellenmiştir'
      ]);
    }

    public function sil()
    {
      DB::table('bilgiler')->where('id',1)->delete();
    }

    public function bilgiler()
    {
      /* $veriler = DB::table('bilgiler')->get();

      foreach ($veriler as $key => $bilgi) {
        echo $bilgi->id.' '.$bilgi->metin;
        echo "<br>";
      }
      */

      $veri = DB::table('bilgiler')->where('id',2)->first();
      echo $veri->metin;
    }
}
