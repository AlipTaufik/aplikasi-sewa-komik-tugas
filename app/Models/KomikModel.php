<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KomikModel extends Model
{
    use HasFactory;
    protected $table = 'komik';
    public $timestamps = false;
    protected $fillable = ['kode_komik','nama_komik','harga','genre','image'];
}
