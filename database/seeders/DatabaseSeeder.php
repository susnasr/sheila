<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@sheila.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // Create sample products
        Product::create([
            'name' => 'Classic T-Shirt',
            'description' => 'A comfortable classic t-shirt for everyday wear.',
            'price' => 29.99,
            'stock' => 100,
        ]);

        Product::create([
            'name' => 'Denim Jeans',
            'description' => 'Stylish denim jeans perfect for any occasion.',
            'price' => 59.99,
            'stock' => 50,
        ]);
    }
}
