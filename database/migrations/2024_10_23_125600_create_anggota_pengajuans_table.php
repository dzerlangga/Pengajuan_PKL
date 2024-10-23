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
        Schema::create('anggota_pengajuans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('surat_id')->constrained('surats')->onDelete('cascade');
            $table->string('nama');
            $table->string('nis');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggota_pengajuans');
    }
};
