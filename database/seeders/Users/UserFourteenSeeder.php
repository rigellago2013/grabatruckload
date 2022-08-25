<?php

namespace Database\Seeders\Users;

use App\Enums\LoadStatusEnum;
use App\Models\Address;
use App\Models\Load;
use App\Models\User;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\Concerns\InteractsWithTime;

class UserFourteenSeeder extends Seeder
{
    use InteractsWithTime;

    public function run(): void
    {
        unset(LoadStatusEnum::labels()['published']);
        $this->travelBack();
        $start = now()->subMonths(4);
        $this->travelTo($start);

        $user = User::factory()
            ->withRole('customer')
            ->create([
                'name' => 'Pet Supplies and Accessories Owner in Cabanatuan',
            ]);

        $pickup = Address::factory()->create([
            'street_address' => '245 Sampaguita St',
            'barangay' => 'Magsaysay North ',
            'city' => 'Cabanatuan',
            'province' => 'Nueva Ecija',
            'postcode' => '3100',
        ]);

        $delivery = Address::factory()->create([
            'street_address' => 'Nueva Ecija - Aurora Rd',
            'barangay' => 'Suclayin',
            'city' => 'Baler',
            'province' => 'Aurora',
            'postcode' => '3200',
        ]);

        $date = $start->startOfDay();

        $this->command->info('Creating load for Owner of a gasoline station La Union');
        Load::factory()->create([
            'weight' => 1000,
            'volume' => 1,
            'pickup_start' => $date->addHour(9)->format('Y-m-d H:i:s'),
            'pickup_end' => $date->addHour(7)->format('Y-m-d H:i:s'),
            'pickup_location' => new Point(15.483943, 120.978512),
            'pickup_address_id' => $pickup->id,
            'delivery_start' => $date->addHour()->format('Y-m-d H:i:s'),
            'delivery_end' => $date->addHour(4)->format('Y-m-d H:i:s'),
            'delivery_location' => new Point(15.753595, 121.542591),
            'delivery_address_id' => $delivery->id,
            'customer_max_amount' => 10000,
            'customer_max_currency_code' => 'PHP',
            'user_id' => $user->id,
            'company' => 'User fourteen Company',
            'contact_name' => 'User fourteen',
            'email_to_notify' => 'userfourteen@gmail.com',
            'pickup_equipments' => json_encode(['forklifts', 'boomtruck']),
            'delivery_equipments' => json_encode(['boomtruck', 'forklifts']),
            'state' => array_rand(LoadStatusEnum::labels(), 1),
        ]);
    }
}
