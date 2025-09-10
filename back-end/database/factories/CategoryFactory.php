<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $categories = [
            'Alimentação',
            'Transporte',
            'Saúde',
            'Educação',
            'Lazer',
            'Moradia',
            'Entretenimento',
            'Finanças',
            'Tecnologia',
            'Esporte',
        ];

        $title = \array_shift($categories);

        return [
            'title' => $title,
            'is_global' => true,
        ];
    }
}
