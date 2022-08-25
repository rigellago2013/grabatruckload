<?php

namespace Database\Seeders\Users;

use App\Actions\Loads\PublishLoad;
use App\Enums\LoadTypeEnum;
use App\Enums\VehicleCategoryEnum;
use App\Enums\VehicleTypeEnum;
use App\Models\Address;
use App\Models\Link;
use App\Models\Load;
use App\Models\Movement;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleGroup;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\Concerns\InteractsWithTime;

class OwnerOneSeeder extends Seeder
{
    use InteractsWithTime;

    public function run(): void
    {
        $this->travelBack();
        $start = now()->subMonths(6);
        $x = 1;
        foreach (range(1, 25) as $numberOfItems) {
            $x + 1;
            $user = User::factory()->withRole('Owner')->create([
                'name' => 'Truck Owner' . $x . '',
            ]);
            $this->command->info('Creating links for Truck ' . $x . ' Owner.');
            $pickup = Address::factory()->create();
            $delivery = Address::factory()->create();
            $this->travelTo($start->addWeek());

            $vehicleGroup = VehicleGroup::factory()->create([
                'user_id' => $user->id,
            ]);

            $vehicle = Vehicle::factory()->create([
                'plate_number' => 'TRK000' . $x++,
                'type' => VehicleTypeEnum::labels()['truck'],
                'category' => VehicleCategoryEnum::general(),
                'or_cr_copy' => json_encode(['cr/VSrTxVoBazYEpEyHV8Rz4ribQzngnvYhyIw6wcdU.png']),
                'insurance_docs' => json_encode(['samples/or .jpeg']),
                'truck_picture' => json_encode(['samples/cr.jpeg']),
                'weight_capacity' => 10000,
                'volume_capacity' => 10,
                'truck_category' => 'large',
                'notes' => 'Lorem ipsum',
                'deck_length' => rand(1, 1000),
                'maximum_capacity' => rand(100, 10000),
                'vehicle_group_id' => $vehicleGroup->id,
            ]);

            $load = Load::factory()->create([
                'weight' => rand(1, 5000),
                'volume' => rand(1, 1000),
                'load_type' => LoadTypeEnum::general(),
                'pickup_start' => now()->isWednesday() ? now()->addDay(3)->hour(10) : now()->addDay(3)->hour(10),
                'pickup_end' => now()->isWednesday() ? now()->addDay(3)->hour(15) : now()->addDay(3)->hour(15),
                'pickup_location' => new Point(6.640434672033844, 125.32341788821032),
                'pickup_address_id' => $pickup->id,
                'delivery_start' => now()->isMonday() ? now()->hour(4) : now()->next('Monday')->hour(4),
                'delivery_end' => now()->isMonday() ? now()->hour(4) : now()->next('Monday')->hour(4),
                'delivery_location' => new Point(7.077722013924448, 125.62552310985049),
                'delivery_address_id' => $delivery->id,
                'customer_max_amount' => 5000,
                'customer_max_currency_code' => 'PHP',
                'user_id' => $user->id,
                'company' => 'User one Company',
                'contact_name' => 'User one',
                'email_to_notify' => 'userone@gmail.com',
                'pickup_equipments' => json_encode(['forklifts', 'boomtruck']),
                'pickup_equipments' => json_encode(['boomtruck', 'forklifts']),
                'vehicle_id' => $vehicle->id,
            ]);

            $movement = Movement::factory()->create([
                'pickup_start' => now()->isWednesday() ? now()->addDay(3)->hour(10) : now()->addDay(3)->hour(10),
                'pickup_end' => now()->isWednesday() ? now()->addDay(3)->hour(15) : now()->addDay(3)->hour(15),
                'destination_start' => now()->isMonday() ? now()->hour(4) : now()->next('Monday')->hour(4),
                'destination_end' => now()->isMonday() ? now()->hour(4) : now()->next('Monday')->hour(4),
                'pickup_address_id' => $pickup->id,
                'destination_address_id' => $delivery->id,
            ]);

            app(PublishLoad::class)->execute($load);

            Link::factory()->create([
                'load_id' => $load->id,
                'movement_id' => $movement->id,
            ]);
        }
    }
}
