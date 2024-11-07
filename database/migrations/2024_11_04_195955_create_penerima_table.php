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
        Schema::create('penerima', function (Blueprint $table) {
            $table->id();
            $table->string('nip', 14)->unique();
            $table->string('nik', 16)->unique();
            $table->string('nama', 255);
            $table->foreignId('departemen_id')->constrained(
                table: 'departemen',
                indexName: 'penerima_departemen_id'
            );
            $table->foreignId('bagian_id')->nullable()->constrained(
                table: 'bagian',
                indexName: 'penerima_bagian_id'
            );
            $table->foreignId('status_id')->constrained(
                table: 'status',
                indexName: 'penerima_status_id'
            );
            $table->string('nomor_telepon', 15)->nullable();
            $table->text('alamat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penerima');
    }
};
