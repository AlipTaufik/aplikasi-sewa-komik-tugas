<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenyewaandetailModel extends Model
{
    use HasFactory;
    protected $table = 'penyewaandetail';
    public $timestamps = false;
    protected $fillable = ['penyewaan_id','kode_komik','tanggal_sewa','tanggal_dikembalikan','harga','qty','subtotal'];

    public function komik()
    {
        return $this->belongsTo(KomikModel::class, 'kode_komik','kode_komik');
    }
    public function penyewaan()
    {
        return $this->belongsTo(PenyewaanModel::class, 'penyewaan_id','id');
    }
}
