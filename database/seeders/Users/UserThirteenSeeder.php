<?php

namespace Database\Seeders\Users;

use App\Enums\LoadStatusEnum;
use App\Models\Address;
use App\Models\Load;
use App\Models\User;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\Concerns\InteractsWithTime;

class UserThirteenSeeder extends Seeder
{
    use InteractsWithTime;

    public function run(): void
    {
        unset(LoadStatusEnum::labels()['published']);
        $this->travelBack();
        $start = now()->subMonths(1);
        $this->travelTo($start);

        $user = User::factory()
            ->withRole('customer')
            ->create([
                'name' => 'Owner of a gasoline station Cagayan',
            ]);

        $pickup = Address::factory()->create([
            'street_address' => 'Pan-Philippine Hwy',
            'barangay' => 'Caggay',
            'city' => 'Tuguegarao',
            'province' => 'Cagayan',
            'postcode' => '3500',
        ]);

        $delivery = Address::factory()->create([
            'street_address' => 'Domingo Samonte',
            'barangay' => 'Brgy. 11',
            'city' => 'Laoag',
            'province' => 'Ilocos Norte',
            'postcode' => '2900',
        ]);

        $start->startOfDay();

        $this->command->info('Creating load for Owner of a gasoline station La Union');

        Load::factory()->create([
            'weight' => 10000,
            'volume' => 1,
            'pickup_start' => $start->addHour(8)->format('Y-m-d H:i:s'),
            'pickup_end' => $start->addHour(12)->format('Y-m-d H:i:s'),
            'pickup_location' => new Point(17.637776, 121.745330),
            'pickup_address_id' => $pickup->id,
            'delivery_start' => $start->addHour(2)->format('Y-m-d H:i:s'),
            'delivery_end' => $start->addHour(3)->format('Y-m-d H:i:s'),
            'delivery_location' => new Point(18.199444, 120.593795),
            'delivery_address_id' => $delivery->id,
            'customer_max_amount' => 13000,
            'customer_max_currency_code' => 'PHP',
            'user_id' => $user->id,
            'company' => 'User thirteen Company',
            'contact_name' => 'User thirteen',
            'email_to_notify' => 'userthirteen@gmail.com',
            'pickup_equipments' => json_encode(['forklifts', 'boomtruck']),
            'delivery_equipments' => json_encode(['boomtruck', 'forklifts']),
            'state' => array_rand(LoadStatusEnum::labels(), 1),
        ]);
    }
}
