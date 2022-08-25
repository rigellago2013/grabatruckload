<?php

namespace Database\Factories;

use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Address::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $this->faker->addProvider(new \Faker\Provider\en_PH\Address($this->faker));

        return [
            'street_address' => $this->faker->streetAddress,
            'barangay' => $this->faker->barangay(),
            'city' => $this->faker->city(),
            'province' => $this->faker->province(),
            'postcode' => $this->faker->postcode,
        ];
    }
}
