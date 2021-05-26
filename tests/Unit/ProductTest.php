<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Tests\TestCase;
use Faker\Factory  as Faker;

class ProductTest extends TestCase
{
    public function test_category_create()
    {
        $auth = User::first();
        $faker = Faker::create();
        if ($auth) {
            $response = $this->actingAs($auth, 'api')->post('api/v1/product/category', [
                'name' => $faker->name(),
                'icon' => $faker->imageUrl()
            ]);
            $response->assertStatus(201);
            $this->assertEquals($response['message'], 'Category telah dibuat');
            $this->assertNotEquals($response['message'], null);
        } else $this->markTestSkipped("User not have data");
    }
    public function test_category_destroy()
    {
        $auth = User::first();
        $category = Category::first();
        if ($auth) {
            if ($category) {
                $response = $this->actingAs($auth, 'api')->delete('/api/v1/product/category/' . $category->id);
                $response->assertStatus(200);
                $this->assertNotEquals($response['message'], null);
                $this->assertEquals($response['message'], 'Category telah dihapus');
            } else $this->markTestSkipped("Category not have data");
        } else $this->markTestSkipped("User not have data");
    }
    public function test_category_update()
    {
        $auth = User::first();
        $faker = Faker::create();
        $category = Category::first();
        if ($auth) {
            if ($category) {
                $response = $this->actingAs($auth, 'api')->post('/api/v1/product/category/' . $category->id, [
                    'name' => $faker->name(),
                    'icon' => $faker->imageUrl()
                ]);
                $response->assertStatus(200);
                $this->assertEquals($response['message'], 'Category telah diperbarui');
                $this->assertNotEquals($response['message'], null);
            } else $this->markTestSkipped("Category not have data");
        } else $this->markTestSkipped("User not have data");
    }
    public function test_category_list()
    {
        $response = $this->get("/api/v1/product/category");
        $response->assertStatus(200);
    }

    public function test_product_create()
    {
        $auth = User::first();
        $category = Category::first();
        $faker = Faker::create();
        if ($auth) {
            if ($category) {
                $response = $this->actingAs($auth, 'api')->post('/api/v1/product', [
                    'name' => $faker->name(),
                    'description' => $faker->text(200),
                    'image' => $faker->imageUrl(),
                    'price' => $faker->randomFloat(10000, 15000, 400000),
                    'stock' => $faker->randomDigitNot(5),
                    'category_id' => $category->id,
                ]);

                $response->assertStatus(201);
                $this->assertEquals($response['message'], 'Product telah dibuat');
                $this->assertNotEquals($response['message'], null);
            } else $this->markTestSkipped("Category not have data");
        } else $this->markTestSkipped("User not have data");
    }
    public function test_product_update()
    {
        $auth = User::first();
        $category = Category::first();
        $faker = Faker::create();
        $product = Product::first();
        if ($auth) {
            if ($category) {
                if ($product) {
                    $response = $this->actingAs($auth, 'api')->post('/api/v1/product/' . $product->id, [
                        'name' => $faker->name(),
                        'description' => $faker->text(200),
                        'image' => $faker->imageUrl(),
                        'price' => $faker->randomFloat(10000, 15000, 400000),
                        'sold' => $faker->boolean(),
                        'stock' => $faker->randomDigitNot(5),
                        'category_id' => $category->id
                    ]);
                    $response->assertStatus(200);
                    $this->assertNotEquals($response['message'], null);
                    $this->assertEquals($response['message'], 'Product telah diperbarui');
                } else $this->markTestSkipped("Product not have data");
            } else $this->markTestSkipped("Category not have data");
        } else $this->markTestSkipped("User not have data");
    }
    public function test_product_destroy()
    {
        $auth = User::first();
        $product = Product::first();
        if ($auth) {
            if ($product) {
                $response = $this->actingAs($auth, 'api')->delete('/api/v1/product/' . $product->id);
                $response->assertStatus(200);
                $this->assertEquals($response['message'], 'Product telah dihapus');
                $this->assertNotEquals($response['message'], null);
            } else $this->markTestSkipped("Product not have data");
        } else $this->markTestSkipped("User not have data");
    }
    public function test_product_list()
    {
        $response = $this->get("/api/v1/product");
        $response->assertStatus(200);
    }
}
