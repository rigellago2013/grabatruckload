<?php

namespace Database\Factories;

use App\Models\Movement;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Illuminate\Database\Eloquent\Factories\Factory;

class MovementFactory extends Factory
{
    protected $model = Movement::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // Davao
            'pickup' => new Point(
                $this->faker->latitude(7.0427506146738414, 7.1826422913570225),
                $this->faker->longitude(125.49253252373401, 125.66316858716137)
            ),
            // Cagayan de Oro
            'destination' => new Point(
                $this->faker->latitude(8.44332610945727, 8.504766597048393),
                $this->faker->longitude(124.59459706072722, 124.67166176119038),
            ),
        ];
    }

    public function completed()
    {
        return $this->state(function (array $attributes) {
            return [
                'state' => Complete::$name,
            ];
        });
    }
}
