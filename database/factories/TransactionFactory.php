<?php

namespace Database\Factories;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return  [
            'currency_id' => $this->faker->numberBetween(1, 10),
            'user_id' => $this->faker->numberBetween(1, 10),
            'quantity' => $this->faker->randomFloat(6, 0.001, 3),
            'purchase_price' => $this->faker->randomFloat(6, 0.05, 5000),
            'purchase_date' => $this->faker->dateTimeBetween('-1 year'),
            'sold' => $this->faker->boolean,
            'selling_price' => $this->faker->randomFloat(6, 0.05, 5000),
            'selling_date' => $this->faker->dateTimeBetween('now', '+1 year')
        ];
    }
}
