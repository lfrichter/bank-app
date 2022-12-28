<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Balance>
 */
class BalanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $amount = fake()->randomFloat($nbMaxDecimals = 2, $min = 80, $max = 700);
        $balance = number_format($amount + 1000 * 3, 2, '. ', '' );
        return [
            'current_balance' => $balance,
            'description' => fake()->name(),
            'amount' => $amount,
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
