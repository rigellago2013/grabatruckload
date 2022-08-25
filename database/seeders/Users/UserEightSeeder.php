<?php

namespace Database\Seeders\Users;

use App\Enums\LoadStatusEnum;
use App\Enums\VehicleCategoryEnum;
use App\Enums\VehicleTypeEnum;
use App\Models\Address;
use App\Models\Load;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleGroup;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\Concerns\InteractsWithTime;

class UserEightSeeder extends Seeder
{
    use InteractsWithTime;

    public function run(): void
    {
        unset(LoadStatusEnum::labels()['published']);
        $this->travelBack();
        $start = now()->subMonths(3);

        $this->travelTo($start);

        $user = User::factory()
            ->withRole('customer')
            ->create([
                'name' => 'Jollibee Corporation Inc',
            ]);

        $pickup = Address::factory()->create([
            'street_address' => 'J. G. Summit Industrial Complex',
            'barangay' => 'Barangay Simlong',
            'city' => 'Batangas City',
            'province' => 'Batangas',
        ]);
        $delivery = Address::factory()->create([
            'street_address' => 'Universal Robina Corporation',
            'barangay' => 'Pasig Boulevard',
            'city' => 'Pasig',
            'province' => 'Metro Manila',
        ]);

        $this->command->info('Creating load for Jollibee');
        Load::factory()->create([
            'weight' => 5000,
            'volume' => 10,
            'pickup_start' => now()->isMonday() ?
            now()->hour(4) :
            now()->next('Monday')->hour(4),
            'pickup_end' => now()->isMonday() ?
            now()->hour(6) :
            now()->next('Monday')->hour(6),
            'pickup_location' => new Point(13.679844085611954, 121.05734230159598),
            'pickup_address_id' => $pickup->id,
            'delivery_start' => now()->isMonday() ?
            now()->hour(16) :
            now()->next('Monday')->hour(16),
            'delivery_end' => now()->isMonday() ?
            now()->hour(18) :
            now()->next('Monday')->hour(18),
            'delivery_location' => new Point(14.563699943045359, 121.06870239207562),
            'delivery_address_id' => $delivery->id,
            'customer_max_amount' => 10000,
            'customer_max_currency_code' => 'PHP',
            'user_id' => $user->id,
            'company' => 'User Eight Company',
            'contact_name' => 'User Eight',
            'email_to_notify' => 'usereight@gmail.com',
            'pickup_equipments' => json_encode(['forklifts', 'boomtruck']),
            'delivery_equipments' => json_encode(['boomtruck', 'forklifts']),
            'state' => array_rand(LoadStatusEnum::labels(), 1),
        ]);

        $vehicleGroup = VehicleGroup::factory()->create([
            'user_id' => $user->id,
        ]);

        Vehicle::factory()->create([
            'plate_number' => 'TRK0008',
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
    }
}
