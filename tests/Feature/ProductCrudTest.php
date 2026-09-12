<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_view_product_dashboard_and_list(): void
    {
        Product::factory()->create([
            'name' => 'Sample Wireless Earbuds',
            'category' => 'Electronics',
            'price' => 99.99,
            'quantity' => 15,
        ]);

        $response = $this->get('/products');

        $response->assertStatus(200);
        $response->assertSee('Sample Wireless Earbuds');
        $response->assertSee('Electronics');
        $response->assertSee('99.99');
    }

    public function test_can_render_add_product_page(): void
    {
        $response = $this->get('/products/create');

        $response->assertStatus(200);
        $response->assertSee('Create New Product');
    }

    public function test_can_store_new_product(): void
    {
        $payload = [
            'name' => 'Smart Home Hub',
            'description' => 'Voice assistant enabled central hub for smart home automation.',
            'price' => 149.50,
            'quantity' => 20,
            'category' => 'Smart Home',
        ];

        $response = $this->post('/products', $payload);

        $response->assertRedirect('/products');
        $this->assertDatabaseHas('products', [
            'name' => 'Smart Home Hub',
            'category' => 'Smart Home',
            'price' => 149.50,
            'quantity' => 20,
        ]);
    }

    public function test_validates_required_fields_when_storing_product(): void
    {
        $response = $this->post('/products', []);

        $response->assertSessionHasErrors(['name', 'price', 'quantity', 'category']);
    }

    public function test_can_view_product_details(): void
    {
        $product = Product::factory()->create([
            'name' => '4K Ultra Monitor',
            'category' => 'Displays',
            'price' => 450.00,
            'quantity' => 8,
        ]);

        $response = $this->get("/products/{$product->id}");

        $response->assertStatus(200);
        $response->assertSee('4K Ultra Monitor');
        $response->assertSee('Displays');
    }

    public function test_can_update_product(): void
    {
        $product = Product::factory()->create([
            'name' => 'Old Smartphone Name',
            'price' => 299.00,
            'quantity' => 5,
            'category' => 'Mobiles',
        ]);

        $updatePayload = [
            'name' => 'New Smartphone Pro Max',
            'description' => 'Updated flagship smartphone model with triple lens camera setup.',
            'price' => 899.00,
            'quantity' => 12,
            'category' => 'Mobiles',
        ];

        $response = $this->put("/products/{$product->id}", $updatePayload);

        $response->assertRedirect("/products/{$product->id}");
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => 'New Smartphone Pro Max',
            'price' => 899.00,
            'quantity' => 12,
        ]);
    }

    public function test_can_delete_product(): void
    {
        $product = Product::factory()->create([
            'name' => 'Item To Delete',
            'category' => 'General',
            'price' => 10.00,
            'quantity' => 1,
        ]);

        $response = $this->delete("/products/{$product->id}");

        $response->assertRedirect('/products');
        $this->assertDatabaseMissing('products', [
            'id' => $product->id,
        ]);
    }

    public function test_can_filter_products_by_search(): void
    {
        Product::factory()->create(['name' => 'Apple MacBook Pro', 'category' => 'Computers']);
        Product::factory()->create(['name' => 'Sony Noise Canceling Headphones', 'category' => 'Audio']);

        $response = $this->get('/products?search=MacBook');

        $response->assertStatus(200);
        $response->assertSee('Apple MacBook Pro');
        $response->assertDontSee('Sony Noise Canceling Headphones');
    }
}
