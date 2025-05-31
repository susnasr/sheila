<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\BlogCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogPostSeeder extends Seeder
{
    public function run()
    {
        $category = BlogCategory::firstOrCreate(
            ['name' => 'Fashion Tips'],
            ['slug' => Str::slug('Fashion Tips')]
        );
        BlogPost::create([
            'title' => 'Top 10 Outfit Ideas for 2025',
            'slug' => Str::slug('Top 10 Outfit Ideas for 2025'),
            'category_id' => $category->id,
            'content' => 'Here are the top 10 outfit ideas to rock in 2025, featuring the latest fashion trends...',
            'featured_image' => 'product_images/ccc.jpg',
            'published_at' => now(),
            'user_id' => 1,
            'is_published' => true,
        ]);
    }
}
