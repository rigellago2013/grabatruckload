<?php

namespace Database\Factories;

use App\Enums\VehicleCategoryEnum;
use App\Enums\VehicleTypeEnum;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleGroup;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class VehicleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vehicle::class;

    public function configure()
    {
        return $this->afterCreating(function (Vehicle $load): void {
            $load->addMedia(Storage::path('samples' . DIRECTORY_SEPARATOR . 'or.jpeg'))
            // $load->addMedia(Storage::path('samples/or.jpeg'))
                ->preservingOriginal()
                ->toMediaCollection('files');
            $load->addMedia(Storage::path('samples/cr.jpeg'))
                ->preservingOriginal()
                ->toMediaCollection('files');
        });
    }

    public function definition(): array
    {
        return [
            'plate_number' => Str::upper($this->faker->randomLetter
                . $this->faker->randomLetter
                . $this->faker->randomLetter
                . ' '
                . (string) random_int(1000, 9999)),
            'type' => VehicleTypeEnum::wing(),
            'category' => VehicleCategoryEnum::general(),
            'or_cr_copy' => json_encode(['cr/VSrTxVoBazYEpEyHV8Rz4ribQzngnvYhyIw6wcdU.png']),
            'insurance_docs' => json_encode(['samples/cr.jpeg']),
            'truck_picture' => json_encode(['samples/cr.jpeg']),
            'weight_capacity' => 10000,
            'volume_capacity' => 10,
            'truck_category' => 'large',
            'notes' => 'Lorem ipsum',
            'deck_length' => rand(1, 1000),
            'maximum_capacity' => rand(100, 10000),
        ];
    }

    public function ownedBy(User $owner)
    {
        return $this->state(function (array $attributes) use ($owner) {
            return [
                'vehicle_group_id' => VehicleGroup::factory()->create([
                    'user_id' => $owner->id,
                ])->id,
            ];
        });
    }
}
