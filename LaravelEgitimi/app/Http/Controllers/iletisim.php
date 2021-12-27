<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\iletisimModel;

class iletisim extends Controller
{
    public function index()
    {
      return view('iletisim');
    }

    public function ekleme(Request $request)
    {
      $adsoyad = $request->adsoyad;
      $telefon = $request->telefon;
      $mail = $request->mail;
      $metin = $request->metin;
      iletisimModel::create([
        'adsoyad' => $adsoyad,
        'telefon' => $telefon,
        'mail' => $mail,
        'metin' => $metin,
      ]);
      echo "bilgileriniz veritabanına başarıyla kaydedilmiştir.";
    }
}
