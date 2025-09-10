<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Expense>
 */
class ExpenseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $expenseNames = [
            'Máquina José',
            'Pix Fulano',
            'Supermercado ABC',
            'Uber João',
            'Conta de Luz',
            'Assinatura Netflix',
            'Café no Café do Zé',
            'Manutenção do Carro',
            'Livro do Curso',
            'Shein'
        ];

        return [
            'name' => fake()->unique()->randomElement($expenseNames),
            'value' => fake()->randomFloat(2,10,1000),
            'user_id' => User::factory(),
            'category_id' => Category::factory(),
        ];
    }
}
