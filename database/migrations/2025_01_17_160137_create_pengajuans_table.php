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
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('nama');
            $table->string('nip');
            $table->string('nik');
            $table->string('nama_opd')->nullable();
            $table->string('no_telp')->nullable();
            $table->string('email_domain');
            $table->string('jabatan');
            $table->enum('status', ['diproses', 'selesai', 'ditolak'])->default('diproses');
            $table->string('tanggapan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuans');
    }
};
