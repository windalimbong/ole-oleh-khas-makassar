<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiUser extends Model
{
    use HasFactory;

    protected $fillable = ['id_transaksi', 'jumlah', 'total_harga'];

    protected $table = 'transaksi_users';

    public function transaksiuser()
    {
        return $this->belongsTo(Transaksi::class, 'id_transaksi');
    }

}
