<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bilgiler;

class Modelislemleri extends Controller
{
    public function liste()
    {
      // $bilgi = Bilgiler::whereId(2)->first();
         $bilgi = Bilgiler::find(3);
      echo $bilgi->metin;
    }

    public function ekle()
    {
      Bilgiler::create([
        'metin'=>'model dosyasından eklendiiiiiiiiiiiiiii',
      ]);
    }


    public function guncelle()
    {
      Bilgiler::whereId(5)->update([
            'metin'=>'model dosyasından güncellendi',
      ]);
    }


    public function sil()
    {
      Bilgiler::whereId(3)->delete();
    }
}
