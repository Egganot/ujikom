<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $table = 'suppliers';
    protected $guarded = ['id'];
    protected $fillable = [
        'NmSupplier',
        'Alamat',
        'Kota',
        'Telpon'
    ];

    public function obat()
    {
        return $this->hasMany(Obat::class, 'KdSupplier');
    }

    public function pembelian()
    {
        return $this->hasMany(Pembelian::class, 'KdSupplier');
    }
}
