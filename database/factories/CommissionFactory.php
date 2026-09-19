<?php

namespace Database\Factories;

use App\Models\Commission;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Commission>
 */
class CommissionFactory extends Factory
{
    protected $model = Commission::class;

    public function definition(): array
    {
        $plates = ['33NCR80', '01ABC123', '34XYZ99', '06TR01', '33AA111', '35DEF456', '42KLM789'];

        return [
            'date' => fake()->dateTimeBetween('-6 months', 'now')->format('Y-m-d'),
            'plate_number' => fake()->randomElement($plates),
            'commission_amount' => fake()->numberBetween(1000, 10000),
        ];
    }
}
