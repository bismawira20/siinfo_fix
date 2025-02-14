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
        Schema::create('passphrases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('nama');
            $table->string('nip_pemohon');
            $table->string('no_telp')->nullable();
            $table->string('nama_user');
            $table->string('nik_user');
            $table->string('nip_user');
            $table->string('email_domain');
            $table->text('alasan')->nullable();
            $table->text('tanggapan')->nullable();
            $table->enum('status', ['diproses', 'disetujui','ditolak'])->default('diproses');
            $table->timestamps();
        });
    }

    // 'user_id',
    //     'nama',
    //     'nip_pemohon',
    //     'no_telp',
    //     'nama_user',
    //     'nik_user',
    //     'nip_user',
    //     'email_domain',
    //     'alasan',
    //     'status'
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('passphrases');
    }
};
