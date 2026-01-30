<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producto>
 */
class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'codigo' => $this->faker->unique()->bothify('PROD-####'),
            'nombre' => $this->faker->word(),
            'stock' => $this->faker->numberBetween(10, 100),
            'stock_minimo' => $this->faker->numberBetween(1, 10),
            'stock_maximo' => $this->faker->numberBetween(100, 200),
            'precio_compra' => $this->faker->randomFloat(2, 5, 50),
            'precio_venta' => $this->faker->randomFloat(2, 10, 100),
            'fecha_ingreso' => $this->faker->date(),
            'categoria_id' => 1,
            'descripcion' => $this->faker->sentence(),
            'empresa_id' => 4,
        ];
    }
}
