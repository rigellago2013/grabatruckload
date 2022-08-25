<?php

namespace Database\Seeders\Users;

use App\Enums\LoadStatusEnum;
use App\Models\Address;
use App\Models\Load;
use App\Models\User;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\Concerns\InteractsWithTime;

class UserFifteenSeeder extends Seeder
{
    use InteractsWithTime;

    public function run(): void
    {
        unset(LoadStatusEnum::labels()['published']);
        $this->travelBack();
        $start = now()->subMonths(4);

        $customer = User::factory()
            ->withRole('customer')
            ->create([
                'name' => 'Gravel and sand supplier',
            ]);

        $pickup = Address::factory()->create([
            'street_address' => 'Aurora Rd.',
            'barangay' => 'Suclayin',
            'city' => 'Baler',
            'province' => 'Aurora',
            'postcode' => '3100',
        ]);
        $delivery = Address::factory()->create([
            'street_address' => 'Don Ramon Avenue',
            'barangay' => 'San Agustin',
            'city' => 'San Luis',
            'province' => 'Pampanga',
            'postcode' => '2014',
        ]);

        foreach (range(1, 8) as $week) {
            $this->travelTo($start->addWeek());
            $this->command->info("Creating load for Gravel and sand supplier. Week {$week}");
            Load::factory()->create([
                'weight' => 6000,
                'volume' => 8,
                'pickup_start' => now()->isSaturday() ?
                now()->hour(9) :
                now()->next('Saturday')->hour(9),
                'pickup_end' => now()->isSaturday() ?
                now()->hour(10) :
                now()->next('Saturday')->hour(10),
                'pickup_location' => new Point(15.483943, 120.978512),
                'pickup_address_id' => $pickup->id,
                'delivery_start' => now()->isSaturday() ?
                now()->hour(10) :
                now()->next('Saturday')->hour(10),
                'delivery_end' => now()->isSaturday() ?
                now()->hour(12) :
                now()->next('Saturday')->hour(12),
                'delivery_location' => new Point(15.047149, 120.669736),
                'delivery_address_id' => $delivery->id,
                'customer_max_amount' => 10000,
                'customer_max_currency_code' => 'PHP',
                'user_id' => $customer->id,
                'company' => 'User Fifteen Company',
                'contact_name' => 'User Fifteen',
                'email_to_notify' => 'userfifteen@gmail.com',
                'pickup_equipments' => json_encode(['forklifts', 'boomtruck']),
                'delivery_equipments' => json_encode(['boomtruck', 'forklifts']),
                'state' => array_rand(LoadStatusEnum::labels(), 1),
            ]);
        }
    }
}
