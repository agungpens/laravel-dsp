<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesananModel extends Model
{
    use HasFactory;

    protected $table = 'pesanan_masuks';

    protected $guarded = ['id'];

    public function dataPelanggan()
    {
        return $this->belongsTo(DataPelanggan::class, 'pelanggan_id', 'id');
    }
    public function Produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id', 'id');
    }
    public function Status()
    {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }
    public function PesananUser()
    {
        return $this->belongsTo(PesananUserModel::class, 'kode_pesanan', 'kode_pesanan');
    }
}
