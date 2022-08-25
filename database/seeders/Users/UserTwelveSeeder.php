<?php

namespace Database\Seeders\Users;

use App\Enums\LoadStatusEnum;
use App\Models\Address;
use App\Models\Load;
use App\Models\User;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\Concerns\InteractsWithTime;

class UserTwelveSeeder extends Seeder
{
    use InteractsWithTime;

    public function run(): void
    {
        unset(LoadStatusEnum::labels()['published']);
        $this->travelBack();
        $start = now()->subMonths(2);
        $this->travelTo($start);

        $owner = User::factory()
            ->withRole('customer')
            ->create([
                'name' => 'Owner of a gasoline station La Union',
            ]);

        $pickup = Address::factory()->create([
            'street_address' => 'MacArthur Hwy',
            'barangay' => 'Pottot',
            'city' => 'Bauang',
            'province' => 'La Union',
            'postcode' => '2501',
        ]);

        $delivery = Address::factory()->create([
            'street_address' => 'Bangad - Fort Magsaysay Rd.',
            'barangay' => 'Brgy. Mapalad',
            'city' => 'Cabanatuan ',
            'province' => 'Nueva Ecija',
            'postcode' => '3100',
        ]);

        $date = $start->startOfDay();

        $this->command->info('Creating load for Owner of a gasoline station La Union');
        Load::factory()->create([
            'weight' => 7500,
            'volume' => 55,
            'pickup_start' => $date->addHour(8)->format('Y-m-d H:i:s'),
            'pickup_end' => $date->addHour(7)->format('Y-m-d H:i:s'),
            'pickup_location' => new Point(16.5577566, 120.322917),
            'pickup_address_id' => $pickup->id,
            'delivery_start' => $date->format('Y-m-d H:i:s'),
            'delivery_end' => $date->addHour(4)->format('Y-m-d H:i:s'),
            'delivery_location' => new Point(15.450570, 121.083756),
            'delivery_address_id' => $delivery->id,
            'customer_max_amount' => 13000,
            'customer_max_currency_code' => 'PHP',
            'user_id' => $owner->id,
            'company' => 'User twelve Company',
            'contact_name' => 'User twelve',
            'email_to_notify' => 'usertwelve@gmail.com',
            'pickup_equipments' => json_encode(['forklifts', 'boomtruck']),
            'delivery_equipments' => json_encode(['boomtruck', 'forklifts']),
            'state' => array_rand(LoadStatusEnum::labels(), 1),
        ]);
    }
}
