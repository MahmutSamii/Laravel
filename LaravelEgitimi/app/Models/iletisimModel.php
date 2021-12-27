<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class iletisimModel extends Model
{
    use HasFactory;

    protected $table="iletisim";
    protected $fillable=['adsoyad','mail','telefon','metin','crated_at','updated_at'];
}
