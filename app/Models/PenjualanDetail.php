<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjualanDetail extends Model
{
    use HasFactory;

    protected $table = 'penjualan_details';
    protected $guarded = ['id'];
    protected $fillable = ['Nota', 'KdObat', 'Jumlah'];

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'Nota');
    }

    public function obat()
    {
        return $this->belongsTo(Obat::class, 'KdObat');
    }
}
