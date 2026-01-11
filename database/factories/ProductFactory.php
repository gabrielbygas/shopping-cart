<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $productImages = [
            'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=500&h=500&fit=crop',
            'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=500&h=500&fit=crop',
            'https://images.unsplash.com/photo-1572635196237-14b3f281503f?w=500&h=500&fit=crop',
            'https://images.unsplash.com/photo-1505250967868-ba292fb63325?w=500&h=500&fit=crop',
            'https://images.unsplash.com/photo-1491553895911-0055eca6402d?w=500&h=500&fit=crop',
            'https://images.unsplash.com/photo-1509631179647-0177331693ae?w=500&h=500&fit=crop',
            'https://images.unsplash.com/photo-1572595585016-eac5ee27ae39?w=500&h=500&fit=crop',
            'https://images.unsplash.com/photo-1508615039623-a25605d2938d?w=500&h=500&fit=crop',
            'https://images.unsplash.com/photo-1509090134519-620a5541d577?w=500&h=500&fit=crop',
            'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=500&h=500&fit=crop',
            'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=500&h=500&fit=crop',
            'https://images.unsplash.com/photo-1523293182086-7651a899d37f?w=500&h=500&fit=crop',
            'https://images.unsplash.com/photo-1506159773649-a8e2a3e3db17?w=500&h=500&fit=crop',
            'https://images.unsplash.com/photo-1491553895911-0055eca6402d?w=500&h=500&fit=crop',
            'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=500&h=500&fit=crop',
            'https://images.unsplash.com/photo-1572635196237-14b3f281503f?w=500&h=500&fit=crop',
            'https://images.unsplash.com/photo-1547651965-195265e63fbf?w=500&h=500&fit=crop',
            'https://images.unsplash.com/photo-1572635196237-14b3f281503f?w=500&h=500&fit=crop',
            'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=500&h=500&fit=crop',
            'https://images.unsplash.com/photo-1527864550417-7fd91fc51a46?w=500&h=500&fit=crop',
            'https://images.unsplash.com/photo-1552664730-d307ca884978?w=500&h=500&fit=crop',
            'https://images.unsplash.com/photo-1535632066927-ab7c9ab60908?w=500&h=500&fit=crop',
            'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=500&h=500&fit=crop',
            'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=500&h=500&fit=crop',
            'https://images.unsplash.com/photo-1572635196237-14b3f281503f?w=500&h=500&fit=crop',
        ];

        return [
            'name' => fake()->words(3, true),
            'price' => fake()->randomFloat(2, 10, 500),
            'stock_quantity' => fake()->numberBetween(0, 50),
            'image_url' => fake()->randomElement($productImages),
        ];
    }
}