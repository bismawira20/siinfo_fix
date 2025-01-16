<?php

namespace Database\Seeders;

use App\Models\Bidang;
use App\Models\Post;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
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
            'name' =>'Pengembangan Komunikasi Publik',
        ]);
        Bidang::create([
            'name' =>'Pengelolaan Informasi dan Saluran Komunikasi Publik',
        ]);
        Bidang::create([
            'name' =>'Pengelolaan Infrastruktur',
        ]);

        Post::factory(10)->create();
    }
}
