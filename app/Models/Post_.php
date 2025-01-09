<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;

class Post //extends Model
{
    private static $blog_posts = [
        [
            "title" => "Post Pertama",
            "slug" => "post-pertama",
            "author" => "Abisat",
            "body" =>"Lorem ipsum dolor sit amet consectetur adipisicing elit. 
            Obcaecati accusamus qui temporibus necessitatibus quaerat maxime 
            quo corrupti ut aspernatur, atque perferendis quidem magnam ipsa voluptate? 
            Praesentium tempore libero similique reprehenderit.",
        ],
        [
            "title" => "Post Kedua",
            "slug" => "post-kedua",
            "author" => "Abisat 2",
            "body" =>"Lorem ipsum coba sit amet consectetur 
            adipisicing elit. Obcaecati accusamus qui temporibus 
            necessitatibus quaerat maxime quo corrupti ut aspernatur, 
            atque perferendis quidem magnam ipsa voluptate? Praesentium tempore libero 
            similique reprehenderit.",
        ]];

    public static function all()
    {
        return collect(self::$blog_posts);
    }

    public static function find($slug)
    {
        $posts = static::all();
        return $posts->firstWhere('slug',$slug);
    }
}
