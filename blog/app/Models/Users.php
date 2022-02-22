<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table = 'admins';
    protected $fillable = ['name','email','password'];
    public $timestamps = false;
    use HasFactory;
}
