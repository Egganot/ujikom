<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $table = 'pelanggans';
    protected $guarded = ['id'];
    protected $fillable = ['NmPelanggan', 'Alamat', 'Kota', 'Telpon', 'id_user'];

    public function penjualan()
    {
        return $this->hasMany(Penjualan::class, 'KdPelanggan');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
