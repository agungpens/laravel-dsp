<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesananUserModel extends Model
{
    use HasFactory;

    protected $table = 'pesanan_user';
    protected $guarded = 'id';

    public function User()
    {
        return $this->belongsTo(DataPelanggan::class, 'pelanggan_id', 'id');
    }

    public function ListPesananUser() // corrected method name
    {
        return $this->hasMany(PesananModel::class, 'kode_pesanan', 'kode_pesanan'); // corrected method name
    }
}
