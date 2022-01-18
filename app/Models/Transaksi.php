<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'deskripsi', 'gambar', 'harga', 'stock'];

    protected $table = 'transaksis';

    public function transaksiuser()
    {
        return $this->hasMany(TransaksiUser::class, 'id_transaksi');
    }

}
