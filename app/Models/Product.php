<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne; // Import Hubungan HasOne
 
class Product extends Model
{
    use HasFactory;
 
    protected $fillable = [
        'nama_produk',
        'deskripsi',
        'harga',
        'img',
        'jenis_id',
      
    ];


    public function jenis(){
        return $this->belongsTo(Jenis::class,'jenis_id');
    }
    public function stok(){
        return $this->HasOne(stok::class);
    }
}