<?php

namespace Database\Factories;

use App\Models\Product;
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
            'amount' => rand(100, 10000),
            'description' => $this->faker->realText($maxNbChars = 200, $indexSize = 2),
            'user_id' => 2,
            'category_id' => 2,
            'address' => 'Hà Nội',
            'price' => rand(10000, 1000000)
        ];
    }
}
