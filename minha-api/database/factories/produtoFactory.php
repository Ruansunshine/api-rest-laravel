<?php
namespace Database\Factories;

use App\Models\produto;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\produto>
 */
class produtoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = produto::class;
    public function definition(): array
    {
        return [
            //
        ];
    }
}
