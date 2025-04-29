<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;

    protected $table = 'pembelians';
    protected $guarded = ['id'];
    protected $fillable = ['TglNota', 'KdSupplier', 'Diskon'];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'KdSupplier');
    }

    public function detail()
    {
        return $this->hasMany(PembelianDetail::class, 'Nota');
    }
}
