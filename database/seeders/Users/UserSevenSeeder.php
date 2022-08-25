<?php

namespace Database\Seeders\Users;

use App\Enums\LoadStatusEnum;
use App\Models\Address;
use App\Models\Load;
use App\Models\User;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\Concerns\InteractsWithTime;

class UserSevenSeeder extends Seeder
{
    use InteractsWithTime;

    public function run(): void
    {
        unset(LoadStatusEnum::labels()['published']);
        $this->travelBack();
        $start = now()->subMonths(5);
        $this->travelTo($start);
        $customer = User::factory()->withRole('customer')->create([
            'name' => 'Christian',
        ]);
        $pickup = Address::factory()->create([
            'street_address' => '',
            'barangay' => 'Talas',
            'city' => 'Sulop',
            'province' => 'Davao del Sur',
        ]);
        $delivery = Address::factory()->create([
            'street_address' => 'Purok 5',
            'barangay' => 'San Antonio',
            'city' => 'Davao',
            'province' => 'Samal (IGACOS)',
        ]);

        foreach (range(1, 2) as $week) {
            $this->command->info("Creating load {$week} for Christian");
            Load::factory()->create([
                'weight' => 6000,
                'volume' => 6,
                'pickup_start' => now()->isMonday() ? now()->hour(9) : now()->next('Monday')->hour(9),
                'pickup_end' => now()->isMonday() ? now()->hour(10) : now()->next('Monday')->hour(10),
                'pickup_location' => new Point(6.610860474698206, 125.3237456584259),
                'pickup_address_id' => $pickup->id,
                'delivery_start' => now()->isMonday() ? now()->hour(10) : now()->next('Monday')->hour(10),
                'delivery_end' => now()->isMonday() ? now()->hour(12) : now()->next('Monday')->hour(12),
                'delivery_location' => new Point(6.921250572287212, 125.71637471013027),
                'delivery_address_id' => $delivery->id,
                'customer_max_amount' => 10000,
                'customer_max_currency_code' => 'PHP',
                'user_id' => $customer->id,
                'company' => 'User seven Company',
                'contact_name' => 'User seven',
                'email_to_notify' => 'userseven@gmail.com',
                'pickup_equipments' => json_encode(['forklifts', 'boomtruck']),
                'delivery_equipments' => json_encode(['boomtruck', 'forklifts']),
                'state' => array_rand(LoadStatusEnum::labels(), 1),
            ]);
        }
    }
}
