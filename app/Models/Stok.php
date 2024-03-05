<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
;

class Stok extends Model
{
    use HasFactory;
    protected $table = 'stoks';
    protected $guarded = [''];
    public function products(){
        return $this->belongsTo(Product::class,'products_id','id',);
    }
}
