<?php

namespace Database\Factories;

use App\Models\Operation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Operation>
 */
class OperationFactory extends Factory
{
    protected $model = Operation::class;

    public function definition(): array
    {
        // Örnek sahte plakalar
        $plates = ['33NCR80', '01ABC123', '34XYZ99', '06TR01', '33AA111', '35DEF456', '42KLM789'];

        // Örnek tedarikçi isimleri (küçük harf)
        $suppliers = ['akdeniz lojistik', 'özdemır taşımacılık', 'toros nakliyat', 'güven kargo', 'yıldız lojistik'];

        // Örnek dükkan kodları
        $stores = ['A-10', 'A-12', 'B-05', 'C-20', 'D-01', 'D-15'];

        return [
            'date' => fake()->dateTimeBetween('-6 months', 'now')->format('Y-m-d'),
            'plate_number' => fake()->randomElement($plates),
            'supplier_name' => fake()->randomElement($suppliers),
            'quantity' => fake()->numberBetween(1, 20),
            'freight_price' => fake()->numberBetween(2000, 25000),
            'store_code' => fake()->randomElement($stores),
            'has_vat' => fake()->boolean(60), // %60 ihtimalle KDV'li
        ];
    }
}
