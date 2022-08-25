<?php

namespace Database\Seeders\Users;

use App\Enums\LoadStatusEnum;
use App\Models\Address;
use App\Models\Load;
use App\Models\User;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\Concerns\InteractsWithTime;

class UserSixteenSeeder extends Seeder
{
    use InteractsWithTime;

    public function run(): void
    {
        unset(LoadStatusEnum::labels()['published']);
        $this->travelBack();
        $start = now()->subMonths(6);
        $this->travelTo($start);

        $customer = User::factory()
            ->withRole('customer')
            ->create([
                'name' => 'Liquid products Vendor (vegetable oil and vinegar)',
            ]);

        $pickup = Address::factory()->create([
            'street_address' => 'San Fernando By-Pass Rd',
            'barangay' => 'Brgy. 1',
            'city' => 'San Fernando',
            'province' => 'La Union',
            'postcode' => '91340',
        ]);

        $delivery = Address::factory()->create([
            'street_address' => 'Ambasing Street',
            'barangay' => 'Ambiong',
            'city' => 'Baguio',
            'province' => 'Benguet',
            'postcode' => '2600',
        ]);

        $date = $start->startOfDay();

        $this->command->info('Creating load 1 for Liquid products Vendor');
        $load_one = Load::factory()->create([
            'weight' => 210,
            'volume' => 1,
            'pickup_start' => $date->addHour(8)->format('Y-m-d H:i:s'),
            'pickup_end' => $date->addHour(6)->format('Y-m-d H:i:s'),
            'pickup_location' => new Point(16.632827, 120.328166),
            'pickup_address_id' => $pickup->id,
            'delivery_start' => $date->addHour()->format('Y-m-d H:i:s'),
            'delivery_end' => $date->addHour(4)->format('Y-m-d H:i:s'),
            'delivery_location' => new Point(16.433571, 120.606078),
            'delivery_address_id' => $delivery->id,
            'customer_max_amount' => 55500,
            'customer_max_currency_code' => 'PHP',
            'user_id' => $customer->id,
            'state' => array_rand(LoadStatusEnum::labels(), 1),
        ]);

        $this->command->info('Creating load 2 for Liquid products Vendor');
        $this->travelTo($date->addMonths(3)->startOfDay());
        $load_two = Load::factory()->create([
            'weight' => 210,
            'volume' => 1,
            'pickup_start' => $date->addHour(8)->format('Y-m-d H:i:s'),
            'pickup_end' => $date->addHour(5)->format('Y-m-d H:i:s'),
            'pickup_location' => new Point(16.632827, 120.328166),
            'pickup_address_id' => $pickup->id,
            'delivery_start' => $date->addHour()->format('Y-m-d H:i:s'),
            'delivery_end' => $date->addHour(5)->format('Y-m-d H:i:s'),
            'delivery_location' => new Point(16.433571, 120.606078),
            'delivery_address_id' => $delivery->id,
            'customer_max_amount' => 55500,
            'customer_max_currency_code' => 'PHP',
            'user_id' => $customer->id,
            'company' => 'User sixteen Company',
            'contact_name' => 'User sixteen',
            'email_to_notify' => 'usersixteen@gmail.com',
            'pickup_equipments' => json_encode(['forklifts', 'boomtruck']),
            'delivery_equipments' => json_encode(['boomtruck', 'forklifts']),
            'state' => array_rand(LoadStatusEnum::labels(), 1),
        ]);
    }
}
