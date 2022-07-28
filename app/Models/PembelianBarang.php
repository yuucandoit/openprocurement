<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class PembelianBarang extends Model
{
    use HasFactory;
    protected $table = 'pembelian_barang';
    protected $fillable = [
        'id',
        'pb_id',
        // 'no_doc',
        // 'revisi',
        // 'tanggal',
        'rev',
        'subject',
        'nama',
        'lokasi',
        'jangka_waktu',
        'jam_approve',
        'dana_diperlukan',
        'no_rek',
        'item',
        'quantity',
        'jumlah_quantity',
        'harga_satuan',
        'total',
        'created_at',
        'updated_at'
    ];

    protected $hidden;
}
