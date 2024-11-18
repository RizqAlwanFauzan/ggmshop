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
        Schema::create('produk', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 14)->unique();
            $table->string('nama', 255);
            $table->foreignId('kategori_id')->constrained(
                table: 'kategori',
                indexName: 'produk_kategori_id'
            );
            $table->foreignId('supplier_id')->constrained(
                table: 'supplier',
                indexName: 'produk_supplier_id'
            );
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};
