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
        Schema::create('kuota', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penerima_id')->constrained(
                table: 'penerima',
                indexName: 'kuota_penerima_id'
            );
            $table->foreignId('produk_id')->constrained(
                table: 'produk',
                indexName: 'kuota_produk_id'
            );
            $table->integer('jumlah');
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kuota');
    }
};
