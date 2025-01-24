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
        Schema::create('email_dinas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('nama_opd');
            $table->string('nama_pic');
            $table->string('no_telp_pic');
            $table->string('surat_rekomendasi');
            $table->string('form_pengajuan');
            $table->string('nama_pemohon');
            $table->string('nip_pemohon');
            $table->string('no_telp_pemohon');
            $table->string('nama_2')->nullable();
            $table->string('nip_2')->nullable();
            $table->string('no_telp_2')->nullable();
            $table->string('nama_3')->nullable();
            $table->string('nip_3')->nullable();
            $table->string('no_telp_3')->nullable();
            $table->string('nama_4')->nullable();
            $table->string('nip_4')->nullable();
            $table->string('no_telp_4')->nullable();
            $table->string('nama_5')->nullable();
            $table->string('nip_5')->nullable();
            $table->string('no_telp_5')->nullable();
            $table->enum('status', ['diproses', 'selesai'])->default('diproses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('email_dinas');
    }
};
