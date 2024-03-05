<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('produk_titipans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_produk');
            $table->string('nama_supplier');
            $table->unsignedDecimal('harga_beli', 10, 2);
            $table->unsignedDecimal('harga_jual', 10, 2);
            $table->integer('stok')->unsigned();
            $table->text('keterangan')->nullable();
            $table->timestamps(); // akan membuat created_at dan updated_at
    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk_titipans');
    }
};
