<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualans';
    protected $guarded = ['id'];
    protected $fillable = ['TglNota', 'KdPelanggan', 'Diskon'];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'KdPelanggan');
    }

    public function detail()
    {
        return $this->hasMany(PenjualanDetail::class, 'Nota');
    }
}
