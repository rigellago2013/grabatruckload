<?php

namespace Database\Seeders\Users;

use App\Enums\LoadStatusEnum;
use App\Models\Address;
use App\Models\Load;
use App\Models\User;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\Concerns\InteractsWithTime;

class UserFiveSeeder extends Seeder
{
    use InteractsWithTime;

    public function run(): void
    {
        unset(LoadStatusEnum::labels()['published']);
        $this->travelBack();
        $start = now()->subMonths(6);

        // https://linear.app/grabatruckloadph/issue/GRA-65/user-4-ukay-ukay-dealer-in-pampanga
        $this->travelTo($start);

        $customer = User::factory()
            ->withRole('customer')
            ->create([
                'name' => 'Globe Branch Manager',
            ]);

        $pickup = Address::factory()->create([
            'street_address' => 'Fisher Mall, Quezon Ave',
            'barangay' => '',
            'city' => 'Quezon City',
            'province' => 'Metro Manila',
        ]);
        $delivery = Address::factory()->create([
            'street_address' => 'Unit A, Gonzales Bldg, Quezon St',
            'barangay' => 'Poblacion',
            'city' => 'Baler',
            'province' => 'Aurora',
            'postcode' => '2009',
        ]);

        // https://linear.app/grabatruckloadph/issue/GRA-86/load-1-from-quezon-city-warehouse-bi-monthly

        foreach (range(1, 12) as $week) {
            $this->command->info("Creating load {$week} for globe branch manager");
            $load = Load::factory()->create([
                'weight' => 300,
                'volume' => 1.4,

                'pickup_start' => now()->isMonday() ?
                now()->hour(16) :
                now()->next('Monday')->hour(16),
                'pickup_end' => now()->isMonday() ?
                now()->hour(18) :
                now()->next('Monday')->hour(18),
                'pickup_location' => new Point(14.633317689138359, 121.0188656069415),
                'pickup_address_id' => $pickup->id,

                'delivery_start' => now()->isMonday() ?
                now()->hour(8) :
                now()->next('Monday')->hour(8),
                'delivery_end' => now()->isMonday() ?
                now()->hour(9) :
                now()->next('Monday')->hour(9),
                'delivery_location' => new Point(15.12856334381691, 120.59788736325552),
                'delivery_address_id' => $delivery->id,

                'customer_max_amount' => 9486,
                'customer_max_currency_code' => 'PHP',
                'user_id' => $customer->id,
                'company' => 'User five Company',
                'contact_name' => 'User five',
                'email_to_notify' => 'userfive@gmail.com',
                'pickup_equipments' => json_encode(['forklifts', 'boomtruck']),
                'delivery_equipments' => json_encode(['boomtruck', 'forklifts']),
                'state' => array_rand(LoadStatusEnum::labels(), 1),
            ]);

            $this->travelTo($start->addWeeks(2));
        }
    }
}
