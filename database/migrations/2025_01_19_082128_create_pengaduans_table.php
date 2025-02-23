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
        Schema::create('pengaduans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('jenis_id');
            $table->string('nama');
            $table->string('no_telp');
            $table->text('deskripsi');
            $table->string('file')->nullable();
            $table->text('tanggapan')->nullable();
            $table->enum('status', ['diproses', 'disetujui', 'ditolak'])->default('diproses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaduans');
    }
};