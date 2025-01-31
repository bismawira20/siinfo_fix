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
        Schema::create('buku_tamus', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->foreignId('user_id');
            $table->foreignId('bidang_id');
            $table->string('no_telp')->nullable();;
            $table->string('instansi')->nullable();;
            $table->text('tujuan');
            $table->date('tanggal');
            $table->enum('waktu', ['08:00', '10:00', '13:00']);
            $table->enum('status', ['pending', 'disetujui', 'ditolak'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buku_tamus');
    }
};
