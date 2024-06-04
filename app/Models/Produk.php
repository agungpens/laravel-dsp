<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produks';
    // guarded
    protected $guarded = ['id'];

    public function JenisProduk()
    {
        return $this->belongsTo(JenisProduk::class, 'jenis_produk_id', 'id');
    }
}
