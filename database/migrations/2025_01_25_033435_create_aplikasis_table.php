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
        Schema::create('aplikasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('userid');
            $table->string('nip');
            $table->string('nama_pic');
            $table->string('jabatan');
            $table->string('opd');
            $table->string('email');
            $table->string('no_telp');
            $table->string('nama_app');
            $table->text('deskripsi');
            $table->enum('tipe', ['Android', 'Berbasis Web', 'Desktop']);
            $table->year('tahun_pembuatan');
            $table->string('bahasa_pemograman');
            $table->string('framework');
            $table->string('database');
            $table->string('sistem_operasi');
            $table->enum('instalasi', ['Data Center Diskominfo Kota Semarang', 'Server OPD', 'Server Pihak Ketiga']);
            $table->string('dokumen');
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
        Schema::dropIfExists('aplikasis');
    }
};
