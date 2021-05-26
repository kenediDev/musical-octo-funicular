<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'image' => $this->faker->imageUrl(),
            'price' => $this->faker->randomFloat(100000,10000,20000),
            'stock' => $this->faker->randomDigitNot(30),
            'category_id' => Category::first()->id,
            'user_id' => User::first()->id
        ];
    }
}
