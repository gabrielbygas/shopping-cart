<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'gabrielkalala@protonmail.com',
        ]);
        
        // Create 30 products with specific names and images
        $products = [
            ['name' => 'Wireless Headphones', 'price' => 79.99, 'image' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=500&h=500&fit=crop'],
            ['name' => 'Smart Watch', 'price' => 299.99, 'image' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=500&h=500&fit=crop'],
            ['name' => 'Designer Sunglasses', 'price' => 159.99, 'image' => 'https://images.unsplash.com/photo-1572635196237-14b3f281503f?w=500&h=500&fit=crop'],
            ['name' => 'Laptop Backpack', 'price' => 49.99, 'image' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=500&h=500&fit=crop'],
            ['name' => 'USB-C Cable', 'price' => 12.99, 'image' => 'https://images.unsplash.com/photo-1491553895911-0055eca6402d?w=500&h=500&fit=crop'],
            ['name' => 'Phone Stand', 'price' => 19.99, 'image' => 'https://images.unsplash.com/photo-1509631179647-0177331693ae?w=500&h=500&fit=crop'],
            ['name' => 'Mechanical Keyboard', 'price' => 129.99, 'image' => 'https://images.unsplash.com/photo-1587829191301-2adcaacd2e83?w=500&h=500&fit=crop'],
            ['name' => 'Wireless Mouse', 'price' => 39.99, 'image' => 'https://images.unsplash.com/photo-1527864550417-7fd91fc51a46?w=500&h=500&fit=crop'],
            ['name' => '4K Webcam', 'price' => 89.99, 'image' => 'https://images.unsplash.com/photo-1598327105666-5b89351aff97?w=500&h=500&fit=crop'],
            ['name' => 'Monitor Light Bar', 'price' => 69.99, 'image' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?w=500&h=500&fit=crop'],
            ['name' => 'Desk Lamp', 'price' => 44.99, 'image' => 'https://images.unsplash.com/photo-1534085976235-9ab2b3b2b7fe?w=500&h=500&fit=crop'],
            ['name' => 'Phone Case', 'price' => 24.99, 'image' => 'https://images.unsplash.com/photo-161153273660-7866dc08fa00?w=500&h=500&fit=crop'],
            ['name' => 'Screen Protector', 'price' => 9.99, 'image' => 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=500&h=500&fit=crop'],
            ['name' => 'Portable Charger', 'price' => 34.99, 'image' => 'https://images.unsplash.com/photo-1609269585889-d60b9f2903a8?w=500&h=500&fit=crop'],
            ['name' => 'USB Hub', 'price' => 29.99, 'image' => 'https://images.unsplash.com/photo-1504384308090-c894fdcc538d?w=500&h=500&fit=crop'],
            ['name' => 'Laptop Stand', 'price' => 59.99, 'image' => 'https://images.unsplash.com/photo-1527864550417-7fd91fc51a46?w=500&h=500&fit=crop'],
            ['name' => 'Desk Organizer', 'price' => 22.99, 'image' => 'https://images.unsplash.com/photo-1595521624179-0c0e0b56f8e6?w=500&h=500&fit=crop'],
            ['name' => 'Cable Management', 'price' => 14.99, 'image' => 'https://images.unsplash.com/photo-1598327105666-5b89351aff97?w=500&h=500&fit=crop'],
            ['name' => 'Monitor Mount', 'price' => 99.99, 'image' => 'https://images.unsplash.com/photo-1535632066927-ab7c9ab60908?w=500&h=500&fit=crop'],
            ['name' => 'Wireless Charging Pad', 'price' => 32.99, 'image' => 'https://images.unsplash.com/photo-1618519226300-6e88b2b05fb8?w=500&h=500&fit=crop'],
            ['name' => 'Bluetooth Speaker', 'price' => 54.99, 'image' => 'https://images.unsplash.com/photo-1589003077984-894e133814c9?w=500&h=500&fit=crop'],
            ['name' => 'Ring Light', 'price' => 39.99, 'image' => 'https://images.unsplash.com/photo-1574375927938-d5a98e8ffe85?w=500&h=500&fit=crop'],
            ['name' => 'Microphone Stand', 'price' => 24.99, 'image' => 'https://images.unsplash.com/photo-1608043152269-423dbba4e7e1?w=500&h=500&fit=crop'],
            ['name' => 'Pop Filter', 'price' => 14.99, 'image' => 'https://images.unsplash.com/photo-1608043152269-423dbba4e7e1?w=500&h=500&fit=crop'],
            ['name' => 'XLR Cable', 'price' => 19.99, 'image' => 'https://images.unsplash.com/photo-1487180144351-b8472da7d491?w=500&h=500&fit=crop'],
            ['name' => 'Webcam Mount', 'price' => 16.99, 'image' => 'https://images.unsplash.com/photo-1598327105666-5b89351aff97?w=500&h=500&fit=crop'],
            ['name' => 'Keyboard Wrist Rest', 'price' => 21.99, 'image' => 'https://images.unsplash.com/photo-1587829191301-2adcaacd2e83?w=500&h=500&fit=crop'],
            ['name' => 'Mouse Pad', 'price' => 15.99, 'image' => 'https://images.unsplash.com/photo-1527864550417-7fd91fc51a46?w=500&h=500&fit=crop'],
            ['name' => 'Phone Tripod', 'price' => 25.99, 'image' => 'https://images.unsplash.com/photo-1606986628025-35d57e735ae0?w=500&h=500&fit=crop'],
            ['name' => 'Laptop Sleeve', 'price' => 28.99, 'image' => 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=500&h=500&fit=crop'],
        ];

        foreach ($products as $product) {
            Product::create([
                'name' => $product['name'],
                'price' => $product['price'],
                'stock_quantity' => rand(10, 100),
                'image_url' => $product['image'],
            ]);
        }
    }
}