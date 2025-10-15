<?php

namespace Database\Factories;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
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
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Define common types and statuses for transactions
        // NOTE: Corrected the double space in 'Banks Funding'
        $transactionTypes = ['Vocher Puchased', 'Banks Funding', 'Manual Funding'];
        $transactionStatuses = ['completed', 'pending', 'failed'];

        return [
            // This links the transaction to a random existing user ID.
            'user_id' => User::factory(),

            // Random amount between 5.00 and 5000.00
            'amount' => $this->faker->randomFloat(2, 5, 5000),

            // Randomly select a transaction type
            'type' => $this->faker->randomElement($transactionTypes),

            // Randomly select a status
            'status' => $this->faker->randomElement($transactionStatuses),

            // Generates a reference like TXN123AB, all uppercase
            'reference' => strtoupper($this->faker->bothify('TXN###??')),

            // A short, descriptive line for the transaction
            'description' => $this->faker->sentence(4),

            // Optional: Faker can generate dates in the past
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-6 months', 'now'),
        ];
    }
}
