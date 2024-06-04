<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPelanggan extends Model
{
    use HasFactory;

    protected $table = 'data_pelanggans';
    protected $guarded = 'id';

    public function ListPesanan()
    {
        // hash many
        return $this->hasMany(PesananModel::class, 'pelanggan_id', 'id');
    }
    public function PesananUserPelanggan()
    {
        // hash many
        return $this->belongsTo(PesananUserModel::class, 'id', 'pelanggan_id');
    }
}
