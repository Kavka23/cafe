<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'jenis_id'
    ];

    public function jenis(){
        return $this->belongsTo(Jenis::class);
    }

}
