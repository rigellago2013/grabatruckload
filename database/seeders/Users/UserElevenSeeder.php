<?php

namespace Database\Seeders\Users;

use App\Enums\LoadStatusEnum;
use App\Models\Address;
use App\Models\Load;
use App\Models\User;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\Concerns\InteractsWithTime;

class UserElevenSeeder extends Seeder
{
    use InteractsWithTime;

    public function run(): void
    {
        unset(LoadStatusEnum::labels()['published']);
        $this->travelBack();
        $start = now()->subMonths(5);
        $this->travelTo($start);

        $customer = User::factory()
            ->withRole('customer')
            ->create([
                'name' => 'Yamaha Motorbike Dealer',
            ]);

        $pickup = Address::factory()->create([
            'street_address' => 'Lazaro Commercial Building, km. 50 San Cristobal Bridge.',
            'barangay' => 'San Cristobal',
            'city' => 'Calamba',
            'province' => 'Laguna',
            'postcode' => '4027',
        ]);

        $delivery = Address::factory()->create([
            'street_address' => ' 904 Aurora Blvd',
            'barangay' => '',
            'city' => 'Quezon City',
            'province' => 'Manila',
            'postcode' => '1109',
        ]);

        $this->command->info('Creating load for Yamaha Motorbike Dealer');
        Load::factory()->create([
            'weight' => 7500,
            'volume' => 55,
            'pickup_start' => now()->hour(9),
            'pickup_end' => now()->hour(10),
            'pickup_location' => new Point(14.21705659735306, 121.14521569689825),
            'pickup_address_id' => $pickup->id,
            'delivery_start' => now()->addDay()->hour(8),
            'delivery_end' => now()->addDay()->hour(9),
            'delivery_location' => new Point(14.624781839267714, 121.0568146545757),
            'delivery_address_id' => $delivery->id,
            'customer_max_amount' => 10725,
            'customer_max_currency_code' => 'PHP',
            'user_id' => $customer->id,
            'company' => 'User Eleven Company',
            'contact_name' => 'User Eleven',
            'email_to_notify' => 'usereleven@gmail.com',
            'pickup_equipments' => json_encode(['forklifts', 'boomtruck']),
            'delivery_equipments' => json_encode(['boomtruck', 'forklifts']),
            'state' => array_rand(LoadStatusEnum::labels(), 1),
        ]);
    }
}
