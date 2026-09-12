<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Pro Wireless Noise-Canceling Headphones',
                'description' => 'Premium over-ear wireless headphones featuring active noise cancellation, 40-hour battery life, and crystal-clear acoustic sound driver setup.',
                'price' => 299.99,
                'quantity' => 45,
                'category' => 'Electronics',
                'image' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=800&auto=format&fit=crop&q=80',
            ],
            [
                'name' => 'Ultra HD Smart Fitness Watch',
                'description' => 'Sleek smart watch with heart rate monitoring, GPS tracking, sleep analytics, 50m water resistance, and AMOLED touch display.',
                'price' => 189.50,
                'quantity' => 3, // Low stock indicator
                'category' => 'Wearables',
                'image' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=800&auto=format&fit=crop&q=80',
            ],
            [
                'name' => 'Ergonomic Executive Desk Chair',
                'description' => 'High-back mesh ergonomic office chair with adjustable lumbar support, 3D armrests, dynamic recline mechanism, and heavy-duty base.',
                'price' => 349.00,
                'quantity' => 12,
                'category' => 'Furniture',
                'image' => 'https://images.unsplash.com/photo-1580481072645-022f9a6d8310?w=800&auto=format&fit=crop&q=80',
            ],
            [
                'name' => 'Mechanical Gaming Keyboard RGB',
                'description' => 'Tactile mechanical switches, customizable RGB per-key backlighting, aluminum top plate, and detachable Type-C braided cable.',
                'price' => 129.99,
                'quantity' => 28,
                'category' => 'Electronics',
                'image' => 'https://images.unsplash.com/photo-1587829741301-dc798b83add3?w=800&auto=format&fit=crop&q=80',
            ],
            [
                'name' => 'Compact Pour-Over Coffee Maker',
                'description' => 'Precision drip stainless steel pour-over coffee brewer with heat-resistant borosilicate glass carafe and reusable filter mesh.',
                'price' => 49.95,
                'quantity' => 0, // Out of stock indicator
                'category' => 'Home Appliances',
                'image' => 'https://images.unsplash.com/photo-1517668808822-9ebe02f2a698?w=800&auto=format&fit=crop&q=80',
            ],
            [
                'name' => 'Minimalist Leather Backpack',
                'description' => 'Full-grain genuine leather daypack featuring a 15-inch padded laptop compartment, water-resistant interior lining, and magnetic clasps.',
                'price' => 159.00,
                'quantity' => 18,
                'category' => 'Accessories',
                'image' => 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=800&auto=format&fit=crop&q=80',
            ],
            [
                'name' => '4K Ultra Short Throw Laser Projector',
                'description' => 'Immersive 4K UHD home theater projector delivering 2500 ANSI lumens, built-in Dolby Atmos speaker system, and HDR10 support.',
                'price' => 1299.00,
                'quantity' => 5, // Low stock indicator
                'category' => 'Electronics',
                'image' => 'https://images.unsplash.com/photo-1517705008128-361805f42e86?w=800&auto=format&fit=crop&q=80',
            ],
            [
                'name' => 'Solid Oak Minimalist Dining Table',
                'description' => 'Crafted from sustainably sourced solid European white oak with natural matte finish and Scandinavian tapered leg design.',
                'price' => 849.50,
                'quantity' => 7,
                'category' => 'Furniture',
                'image' => 'https://images.unsplash.com/photo-1530018607912-eff2daa1bac4?w=800&auto=format&fit=crop&q=80',
            ],
            [
                'name' => 'Studio Wireless Bluetooth Speaker',
                'description' => 'Portable 360-degree surround sound speaker with 24-hour battery playback, IPX7 waterproof rating, and deep bass radiator.',
                'price' => 89.99,
                'quantity' => 32,
                'category' => 'Electronics',
                'image' => 'https://images.unsplash.com/photo-1608043152269-423dbba4e7e1?w=800&auto=format&fit=crop&q=80',
            ],
            [
                'name' => 'Smart Air Purifier with HEPA Filter',
                'description' => 'App-controlled true HEPA H13 filtration system capturing 99.97% of airborne particles, dust, pollen, and real-time air quality indicator.',
                'price' => 219.00,
                'quantity' => 14,
                'category' => 'Home Appliances',
                'image' => 'https://images.unsplash.com/photo-1585771724684-38269d6639fd?w=800&auto=format&fit=crop&q=80',
            ],
            [
                'name' => 'Stainless Steel Insulated Water Bottle',
                'description' => 'Double-wall vacuum insulated flask keeping beverages ice cold for 24 hours or piping hot for 12 hours. BPA-free lid included.',
                'price' => 34.99,
                'quantity' => 60,
                'category' => 'Accessories',
                'image' => 'https://images.unsplash.com/photo-1602143407151-7111542de6e8?w=800&auto=format&fit=crop&q=80',
            ],
            [
                'name' => 'Wireless Ergonomic Vertical Mouse',
                'description' => 'Reduces wrist strain with natural handshake posture, 2.4G & dual Bluetooth multi-device connection, and rechargeable battery.',
                'price' => 45.00,
                'quantity' => 2, // Low stock
                'category' => 'Electronics',
                'image' => 'https://images.unsplash.com/photo-1615663245857-ac93bb7c39e7?w=800&auto=format&fit=crop&q=80',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
