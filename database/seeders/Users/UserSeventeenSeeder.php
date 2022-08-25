<?php

namespace Database\Seeders\Users;

use App\Enums\LoadStatusEnum;
use App\Models\Address;
use App\Models\Load;
use App\Models\User;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\Concerns\InteractsWithTime;

class UserSevenTeenSeeder extends Seeder
{
    use InteractsWithTime;

    public function run(): void
    {
        $this->travelBack();
        $start = now()->subMonths(2);
        $this->travelTo($start);

        $customer = User::factory()
            ->withRole('customer')
            ->create([
                'name' => 'Poultry Owner (Chicken Farmer) from Mandaue Cebu',
            ]);

        $pickup = Address::factory()->create([
            'street_address' => 'ML Quezon Ave',
            'barangay' => 'Cabancalan',
            'city' => 'Cebu',
            'province' => 'Cebu',
            'postcode' => '1565',
        ]);

        $delivery = Address::factory()->create([
            'street_address' => 'Catbalogan Diversion Rd',
            'barangay' => 'Burak',
            'city' => 'Catbalogan',
            'province' => 'Samar',
            'postcode' => '6700',
        ]);

        $this->command->info('Creating load for Poultry Owner (Chicken Farmer) from Mandaue Cebu');

        Load::factory()->create([
            'weight' => 6000,
            'volume' => 1,
            'pickup_start' => now()->isWednesday() ?
            now()->hour(4) :
            now()->next('Wednesday')->hour(4),
            'pickup_end' => now()->isWednesday() ?
            now()->hour(6) :
            now()->next('Wednesday')->hour(6),
            'pickup_location' => new Point(10.352183, 123.923292),
            'pickup_address_id' => $pickup->id,
            'delivery_start' => now()->isWednesday() ?
            now()->hour(16) :
            now()->next('Wednesday')->hour(16),
            'delivery_end' => now()->isWednesday() ?
            now()->hour(18) :
            now()->next('Wednesday')->hour(18),
            'delivery_location' => new Point(11.782694, 124.880096),
            'delivery_address_id' => $delivery->id,
            'customer_max_amount' => 90000,
            'customer_max_currency_code' => 'PHP',
            'user_id' => $customer->id,
            'company' => 'User seventeen Company',
            'contact_name' => 'User seventeen',
            'email_to_notify' => 'userseventeen@gmail.com',
            'pickup_equipments' => json_encode(['forklifts', 'boomtruck']),
            'delivery_equipments' => json_encode(['boomtruck', 'forklifts']),
            'state' => array_rand(LoadStatusEnum::labels(), 1),
        ]);
    }
}
