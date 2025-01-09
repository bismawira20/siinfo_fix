<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(3)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // User::create([
        //     'name' => 'Abisat',
        //     'email' => 'abisat@gmail.com',
        //     'password' => bcrypt('1234')
        // ]);

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

        Post::factory(10)->create();
        // Post::create([
        //     'title' => 'Judul Pertama',
        //     'slug' => 'judul-pertama',
        //     'excerpt' => 'Lorem ipsum odor amet, consectetuer adipiscing elit. Et sodales eros
        //     tristique ligula mi nisl maecenas eleifend. Nullam gravida mattis, rhoncus natoque eu id. Per 
        //     a sapien rhoncus ornare sapien primis at. Vel vehicula mattis tincidunt nulla consequat eros
        //     himenaeos.',
        //     'body' => 'Lorem ipsum odor amet, consectetuer adipiscing elit. 
        //     Et sodales eros tristique ligula mi nisl 
        //     maecenas eleifend. Nullam gravida mattis, rhoncus natoque eu id. 
        //     Per a sapien rhoncus ornare sapien primis at. 
        //     Vel vehicula mattis tincidunt nulla consequat eros himenaeos. 
        //     Lorem ipsum odor amet, consectetuer adipiscing elit. Et sodales eros tristique 
        //     ligula mi nisl maecenas eleifend. Nullam gravida mattis, rhoncus natoque eu id. Per a sapien 
        //     rhoncus ornare sapien primis at. Vel vehicula mattis tincidunt nulla consequat eros himenaeos.
        //     Lorem ipsum odor amet, consectetuer adipiscing elit. Et sodales eros tristique ligula mi nisl maecenas eleifend.
        //     Nullam gravida mattis, rhoncus natoque eu id. Per a sapien rhoncus ornare sapien primis at. Vel vehicula mattis tincidunt nulla consequat eros himenaeos.',
        //     "category_id" => 1,
        //     "user_id" => 1,
        // ]);
        // Post::create([
        //     'title' => 'Judul Kedua',
        //     'slug' => 'judul-kedua',
        //     'excerpt' => 'Lorem ipsum odor amet, consectetuer adipiscing elit. Et sodales eros
        //     tristique ligula mi nisl maecenas eleifend. Nullam gravida mattis, rhoncus natoque eu id.
        //     Per a sapien rhoncus ornare sapien primis at. Vel vehicula mattis tincidunt nulla consequat 
        //     eros himenaeos.',
        //     'body' => 'Lorem ipsum odor amet, consectetuer adipiscing elit. 
        //     Et sodales eros tristique ligula mi nisl 
        //     maecenas eleifend. Nullam gravida mattis, rhoncus natoque eu id. 
        //     Per a sapien rhoncus ornare sapien primis at. 
        //     Vel vehicula mattis tincidunt nulla consequat eros himenaeos. 
        //     Lorem ipsum odor amet, consectetuer adipiscing elit. Et sodales eros tristique 
        //     ligula mi nisl maecenas eleifend. Nullam gravida mattis, rhoncus natoque eu id. Per a sapien 
        //     rhoncus ornare sapien primis at. Vel vehicula mattis tincidunt nulla consequat eros himenaeos.
        //     Lorem ipsum odor amet, consectetuer adipiscing elit. Et sodales eros tristique ligula mi nisl maecenas eleifend.
        //     Nullam gravida mattis, rhoncus natoque eu id. Per a sapien rhoncus ornare sapien primis at. Vel vehicula mattis tincidunt nulla consequat eros himenaeos.',
        //     "category_id" => 2,
        //     "user_id" => 1,
        // ]);
        // Post::create([
        //     'title' => 'Judul Ketiga',
        //     'slug' => 'judul-ketiga',
        //     'excerpt' => 'Lorem ipsum odor amet, consectetuer adipiscing elit. Et sodales eros
        //     tristique ligula mi nisl maecenas eleifend. Nullam gravida mattis, rhoncus natoque eu id. Per 
        //     a sapien rhoncus ornare sapien primis at. Vel vehicula mattis tincidunt nulla consequat eros
        //     himenaeos.',
        //     'body' => 'Lorem ipsum odor amet, consectetuer adipiscing elit. 
        //     Et sodales eros tristique ligula mi nisl 
        //     maecenas eleifend. Nullam gravida mattis, rhoncus natoque eu id. 
        //     Per a sapien rhoncus ornare sapien primis at. 
        //     Vel vehicula mattis tincidunt nulla consequat eros himenaeos. 
        //     Lorem ipsum odor amet, consectetuer adipiscing elit. Et sodales eros tristique 
        //     ligula mi nisl maecenas eleifend. Nullam gravida mattis, rhoncus natoque eu id. Per a sapien 
        //     rhoncus ornare sapien primis at. Vel vehicula mattis tincidunt nulla consequat eros himenaeos.
        //     Lorem ipsum odor amet, consectetuer adipiscing elit. Et sodales eros tristique ligula mi nisl maecenas eleifend.
        //     Nullam gravida mattis, rhoncus natoque eu id. Per a sapien rhoncus ornare sapien primis at. Vel vehicula mattis tincidunt nulla consequat eros himenaeos.',
        //     "category_id" => 3,
        //     "user_id" => 1,
        // ]);
    }
}
