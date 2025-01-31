<?php

namespace Database\Seeders;

use App\Models\Bidang;
use App\Models\Post;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\JenisPengaduan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin 1',
            'email'=> 'admin1@gmail.com',
            'password' => Hash::make('12345'),
            'username' => 'admin1',
            'is_admin' => true
        ]);
        User::create([
            'name' => 'Admin 2',
            'email'=> 'admin2@gmail.com',
            'password' => Hash::make('12345'),
            'username' => 'admin2',
            'is_admin' => true
        ]);

        User::factory(3)->create();

        Category::create([
            'name' =>'Berita Utama',
            'slug' =>'berita-utama',
        ]);
        Category::create([
            'name' =>'Berita Kunjungan',
            'slug' =>'berita-kunjungan',
        ]);
        Category::create([
            'name' =>'Informasi',
            'slug' =>'informasi',
        ]);

        Bidang::create([
            'name' =>'Sekretariat',
        ]);
        Bidang::create([
            'name' =>'Pengembangan Komunikasi Publik',
        ]);
        Bidang::create([
            'name' =>'Sistem Pemerintahan Berbasis Elektronik',
        ]);
        Bidang::create([
            'name' =>'Pengelolaan Informasi dan Saluran Komunikasi Publik',
        ]);
        Bidang::create([
            'name' =>'Pengelolaan Infrastruktur',
        ]);
        Bidang::create([
            'name' =>'Statistik',
        ]);

        JenisPengaduan::create([
            'nama' => 'Sub Domain, Hosting, & VPS (Virtual Private Server)'
        ]);
        JenisPengaduan::create([
            'nama' => 'Pembuatan & Pengembangan Aplikasi'
        ]);
        JenisPengaduan::create([
            'nama' => 'Pengajuan TTE'
        ]);
        JenisPengaduan::create([
            'nama' => 'Pembuatan Email Dinas'
        ]);
        JenisPengaduan::create([
            'nama' => 'Pembuatan Email Dinas'
        ]);
        JenisPengaduan::create([
            'nama' => 'Reset Password Email Dinas'
        ]);
        JenisPengaduan::create([
            'nama' => 'Reset Passphrase TTE'
        ]);
        JenisPengaduan::create([
            'nama' => 'Reset/Permintaan Akun CPANEL'
        ]);
        JenisPengaduan::create([
            'nama' => 'Lupa Password Website OPD'
        ]);
        JenisPengaduan::create([
            'nama' => 'Permohonan Video Conference'
        ]);

        Post::factory(10)->create();
    }
}
