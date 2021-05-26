<?php

namespace Database\Factories;

use App\Models\Accounts;
use App\Models\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AccountsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Accounts::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'avatar' => $this->faker->imageUrl(),
            'background' => $this->faker->imageUrl(),
            'is_superuser' => true,
            'user_id' => User::first()->id ? User::orderByDesc("id")->first()->id : User::first()->id
        ];
    }
}
