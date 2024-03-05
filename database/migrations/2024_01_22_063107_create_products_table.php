<?php
 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
 
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('nama_produk');
            $table->string('img');
            $table->double('harga');
            $table->string('deskripsi');
            $table->unsignedBigInteger('jenis_id');
            $table->foreign("jenis_id")->references('id')->on('jenis');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};