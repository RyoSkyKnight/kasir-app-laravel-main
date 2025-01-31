<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        // Daftar produk yang logis
        $productNames = [
            'Laptop', 'Mouse', 'Keyboard', 'Monitor', 'Webcam', 'Speaker',
            'Headphone', 'Smartphone', 'Tablet', 'Printer', 'External Hard Drive',
            'USB Flash Drive', 'Router', 'Power Bank', 'Projector', 'Desk Lamp',
            'Mechanical Keyboard', 'Gaming Chair', 'Graphics Card', 'Motherboard',
            'CPU Cooler', 'SSD', 'HDD', 'Wireless Charger', 'Gaming Mouse',
            'Gaming Monitor', 'Bluetooth Speaker', 'Smartwatch', 'Tripod', 'Microphone'
        ];

        return [
            'name' => $this->faker->randomElement($productNames) . ' - ' . strtoupper($this->faker->unique()->bothify('??###')), // Nama unik
            'price' => $this->faker->numberBetween(50000, 5000000), // Harga antara Rp50.000 - Rp5.000.000
            'stock' => $this->faker->numberBetween(10, 100), // Stok antara 10 - 100
            'status' => $this->faker->randomElement(['Draft', 'Active', 'Inactive']),
        ];
    }
}
