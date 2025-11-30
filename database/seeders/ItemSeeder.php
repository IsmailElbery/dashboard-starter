<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Item 1: Electronics - Laptop
        Item::create([
            'name' => 'Dell XPS 15 Laptop',
            'email' => 'electronics@example.com',
            'description' => 'High-performance laptop with 15.6" display, Intel Core i7, 16GB RAM, and 512GB SSD. Perfect for professional work and creative tasks.',
            'price' => 1299.99,
            'quantity' => 25,
            'manufacturing_date' => '2024-01-15',
            'expiry_date' => '2027-01-15 23:59:59',
            'status' => 'active',
            'category' => 'electronics',
            'type' => 'type_a',
            'is_featured' => true,
            'is_available' => true,
            'features' => ['warranty', 'shipping', 'returns'],
            'color' => '#0053BA',
            'url' => 'https://www.dell.com/xps-15',
            'notes' => 'Popular model with excellent reviews. Limited stock available.',
        ]);

        // Item 2: Book
        Item::create([
            'name' => 'Laravel 10 Complete Guide',
            'email' => 'books@example.com',
            'description' => 'Comprehensive guide to building modern web applications with Laravel 10. Covers everything from basics to advanced topics including API development, testing, and deployment.',
            'price' => 49.99,
            'quantity' => 150,
            'manufacturing_date' => '2023-11-20',
            'expiry_date' => null,
            'status' => 'active',
            'category' => 'books',
            'type' => 'type_b',
            'is_featured' => false,
            'is_available' => true,
            'features' => ['shipping', 'returns', 'gift_wrap'],
            'color' => '#AF0818',
            'url' => 'https://example.com/laravel-guide',
            'notes' => 'Best-selling programming book of 2024. Suitable for beginners and intermediate developers.',
        ]);
    }
}
