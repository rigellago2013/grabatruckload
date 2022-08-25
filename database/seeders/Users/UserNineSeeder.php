<?php

namespace Database\Seeders\Users;

use App\Enums\LoadStatusEnum;
use App\Models\Address;
use App\Models\Load;
use App\Models\User;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\Concerns\InteractsWithTime;

class UserNineSeeder extends Seeder
{
    use InteractsWithTime;

    public function run(): void
    {
        unset(LoadStatusEnum::labels()['published']);
        $this->travelBack();
        $start = now()->subMonths(2);

        $this->travelTo($start);

        $customer = User::factory()
            ->withRole('customer')
            ->create([
                'name' => 'Holcim Cement',
            ]);

        $pickup = Address::factory()->create([
            'street_address' => 'Holcim, Circumferencial Road',
            'barangay' => 'Antipolo',
            'city' => 'Rizal',
            'province' => 'Metro Manila',
            'postcode' => '1870',
        ]);
        $delivery = Address::factory()->create([
            'street_address' => '442 Salcedo St',
            'barangay' => 'Noveleta',
            'city' => 'Cavite',
            'province' => 'Metro Manila',
            'postcode' => '4105',
        ]);

        $this->command->info('Creating load for Holcinm');
        $load = Load::factory()->create([
            'weight' => 25000,
            'volume' => 20,

            'pickup_start' => now()->isWednesday() ?
            now()->hour(3) :
            now()->next('Monday')->hour(3),
            'pickup_end' => now()->isWednesday() ?
            now()->hour(4) :
            now()->next('Monday')->hour(4),
            'pickup_location' => new Point(14.581914595117258, 121.17711314372627),
            'pickup_address_id' => $pickup->id,

            'delivery_start' => now()->isWednesday() ?
            now()->hour(16) :
            now()->next('Monday')->hour(16),
            'delivery_end' => now()->isWednesday() ?
            now()->hour(18) :
            now()->next('Monday')->hour(18),
            'delivery_location' => new Point(14.428119849861218, 120.87404741206055),
            'delivery_address_id' => $delivery->id,

            'customer_max_amount' => 16500,
            'customer_max_currency_code' => 'PHP',
            'user_id' => $customer->id,
            'company' => 'User nine Company',
            'contact_name' => 'User nine',
            'email_to_notify' => 'usernine@gmail.com',
            'pickup_equipments' => json_encode(['forklifts', 'boomtruck']),
            'delivery_equipments' => json_encode(['boomtruck', 'forklifts']),
            'state' => array_rand(LoadStatusEnum::labels(), 1),
        ]);
    }
}
