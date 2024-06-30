<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenyewaanModel extends Model
{
    use HasFactory;
    protected $table = 'penyewaan';
    public $timestamps = false;
    protected $fillable = ['nomor_sewa','customer','total_penyewaan','status_penyewaan'];
}
