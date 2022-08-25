<?php

namespace Database\Factories;

use App\Actions\Loads\UpdateLoadCode;
use App\Enums\LoadingEquipmentsEnum;
use App\Enums\LoadTypeEnum;
use App\Models\Load;
use App\Models\User;
use App\States\Load\Complete;
use App\States\Load\Draft;
use App\States\Load\Pending;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LoadFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Load::class;

    public function completed()
    {
        return $this->state(function (array $attributes) {
            return [
                'state' => Complete::$name,
            ];
        });
    }

    public function draft()
    {
        return $this->state(function (array $attributes) {
            return [
                'state' => Draft::$name,
            ];
        });
    }

    public function configure()
    {
        return $this->afterMaking(function (Load $load): void {
            //
        })->afterCreating(function (Load $load): void {
            app(UpdateLoadCode::class)->execute($load);

            $load->addMedia(Storage::path('samples/coconuts.jpeg'))
                ->preservingOriginal()
                ->toMediaCollection('images');

            $load->addMedia(Storage::path('samples/dummy.pdf'))
                ->preservingOriginal()
                ->toMediaCollection('files');
        });
    }

    public function definition(): array
    {
        $days = random_int(4, 30);
        $user = User::factory()->create();

        return [
            'user_id' => $user->id,
            'code' => '',
            'internal_code' => Str::random(10),
            'load_type' => $this->faker->randomElement(LoadTypeEnum::toValues()),
            'state' => Pending::$name,
            'weight' => null,
            'volume' => 0.6,
            'vehicle_id' => null,
            'pickup_start' => now()->addDays($days)->startOfDay()->addHours(9),
            'pickup_end' => now()->addDays($days)->startOfDay()->addHours(12),
            'pickup_location' => new Point(140.7484404, -73.9878441),
            'pickup_address_id' => null,
            'delivery_start' => now()->addDays($days + 2)->startOfDay()->addHours(9),
            'delivery_end' => now()->addDays($days + 2)->startOfDay()->addHours(12),
            'delivery_location' => new Point(140.7484404, -73.9878441),
            'delivery_address_id' => null,
            'expiry' => now()->addDays($days + 7),
            'customer_max_currency_code' => 'PHP',
            'customer_max_amount' => 15000,
            'company' => "User $user->name Company",
            'contact_name' => $user->name,
            'email_to_notify' => $user->email,
            'delivery_equipments' => json_encode(array_rand(LoadingEquipmentsEnum::labels(), 2)),
            'pickup_equipments' => json_encode(array_rand(LoadingEquipmentsEnum::labels(), 2)),
        ];
    }

    public function pending()
    {
        return $this->state(function (array $attributes) {
            return [
                'state' => Pending::$name,
            ];
        });
    }
}
