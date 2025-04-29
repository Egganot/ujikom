<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apoteker extends Model
{
    use HasFactory;
    protected $table = 'apoteker';
    protected $guarded = ['id'];
    protected $fillable = ['NmApoteker', 'Alamat', 'Kota', 'Telpon', 'id_user'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
