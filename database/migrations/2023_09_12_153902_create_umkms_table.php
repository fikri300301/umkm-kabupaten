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
        Schema::create('umkms', function (Blueprint $table) {
            
            $table->id();
            $table->text('nama');
            $table->string('slug_umkm');
            $table->unsignedBigInteger('bidang_id');
            $table->foreign('bidang_id')->references('id')->on('bidangs');
            $table->string('produk');
            $table->string('pemilik');
            $table->string('telepon');
            $table->string('nik');
            $table->string('alamat');
            $table->string('rt');
            $table->string('rw');
            $table->unsignedBigInteger('kecamatan_id');
            $table->foreign('kecamatan_id')->references('id')->on('kecamatans');
            $table->unsignedBigInteger('desa_id');
            $table->foreign('desa_id')->references('id')->on('desas');
            $table->string('kapasitas_produk');
            $table->string('omset');
            $table->string('tenaga_kerja');
            $table->string('daerah_pemasaran');
            $table->string('modal_usaha');
            $table->unsignedBigInteger('categories_id');
            $table->foreign('categories_id')->references('id')->on('categories');
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('umkms');
    }
};