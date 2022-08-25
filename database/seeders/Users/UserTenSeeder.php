<?php

namespace Database\Seeders\Users;

use App\Enums\LoadStatusEnum;
use App\Models\Address;
use App\Models\Load;
use App\Models\User;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\Concerns\InteractsWithTime;

class UserTenSeeder extends Seeder
{
    use InteractsWithTime;

    public function run(): void
    {
        unset(LoadStatusEnum::labels()['published']);
        $this->travelBack();
        $start = now()->subMonths(3)->startOfDay();
        $this->travelTo($start);

        $customer = User::factory()
            ->withRole('customer')
            ->create([
                'name' => 'Farmer',
            ]);

        $pickup = Address::factory()->create([
            'street_address' => 'Burgos Street',
            'barangay' => 'Barangay I',
            'city' => 'Baler',
            'province' => '	Aurora',
            'postcode' => '3200',
        ]);

        $delivery = Address::factory()->create([
            'street_address' => '303-269 M. Valte Road',
            'barangay' => 'Banaban',
            'city' => 'Bulacan',
            'province' => 'Bulacan',
            'postcode' => '3017',
        ]);

        $this->command->info('Creating load for Farmer');

        Load::factory()->create([
            'weight' => 6000,
            'volume' => 1,
            'pickup_start' => $start->addHour(8)->format('Y-m-d H:i:s'),
            'pickup_end' => $start->addHour(7)->format('Y-m-d H:i:s'),
            'pickup_location' => new Point(15.756622, 121.557307),
            'pickup_address_id' => $pickup->id,
            'delivery_start' => $start->format('Y-m-d H:i:s'),
            'delivery_end' => $start->addHour(4)->format('Y-m-d H:i:s'),
            'delivery_location' => new Point(14.948905, 121.047632),
            'delivery_address_id' => $delivery->id,
            'customer_max_amount' => 10000,
            'customer_max_currency_code' => 'PHP',
            'user_id' => $customer->id,
            'company' => 'User ten Company',
            'contact_name' => 'User ten',
            'email_to_notify' => 'userten@gmail.com',
            'pickup_equipments' => json_encode(['forklifts', 'boomtruck']),
            'delivery_equipments' => json_encode(['boomtruck', 'forklifts']),
            'state' => array_rand(LoadStatusEnum::labels(), 1),
        ]);
    }
}
