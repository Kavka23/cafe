<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenis extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_jenis'
    ];

    public function product()
    {
        return $this->hasMany(Product::class, 'jenis_id', 'id');
    }
}
