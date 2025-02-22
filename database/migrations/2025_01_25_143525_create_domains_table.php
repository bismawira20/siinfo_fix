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
        Schema::create('domains', function (Blueprint $table) {
            $table->id();
            $table->foreignId('userid');
            $table->string('nip');
            $table->string('nama_pic');
            $table->string('jabatan');
            $table->string('opd');
            $table->string('email');
            $table->string('no_telp');
            $table->enum('paket', ['Hanya Domain', 'Domain & Hosting', 'VPS (Virtual Private Server)']);
            $table->string('nama_domain');
            $table->text('fungsi_app');
            $table->string('bahasa_pemograman');
            $table->string('dokumen');
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
        Schema::dropIfExists('domains');
    }
};
