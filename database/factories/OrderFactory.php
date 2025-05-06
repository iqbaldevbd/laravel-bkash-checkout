<?php

namespace Database\Factories;
use App\Models\Order;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Order::class;

    public function definition()
    {

        $products = ['Mobile','Laptop','Watch','Mac Book'];
        static $invoice = 20;
        return [
            'product_name' => $products[rand(0,3)],
            'currency' => 'BDT',
            'amount' => rand(1500,2000),
            'invoice' => $invoice++,
            'status' => 'Pending',
        ];

    }
}
