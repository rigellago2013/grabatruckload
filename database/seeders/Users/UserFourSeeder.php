<?php

namespace Database\Seeders\Users;

use App\Enums\LoadStatusEnum;
use App\Models\Address;
use App\Models\Load;
use App\Models\User;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\Concerns\InteractsWithTime;

class UserFourSeeder extends Seeder
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
                'name' => 'Ukay Ukay',
            ]);

        $pickup = Address::factory()->create([
            'street_address' => '8th Street',
            'barangay' => 'Port Area',
            'city' => 'Manila',
            'province' => 'Metro Manila',
        ]);
        $delivery = Address::factory()->create([
            'street_address' => 'MacArthur Hwy',
            'barangay' => 'Pampanga',
            'city' => 'Angeles',
            'province' => 'Metro Manila',
            'postcode' => '2009',
        ]);

        // https://linear.app/grabatruckloadph/issue/GRA-88/load-1-400kgs-2-pallets-in-month-1
        $this->command->info('Creating first load for ukay ukay owner');
        $load = Load::factory()->create([
            'weight' => 400,
            'volume' => 4,

            'pickup_start' => now()->isMonday() ?
            now()->hour(5) :
            now()->next('Saturday')->hour(5),
            'pickup_end' => now()->isMonday() ?
            now()->hour(6) :
            now()->next('Saturday')->hour(6),
            'pickup_location' => new Point(14.589180856457421, 120.96434692953726),
            'pickup_address_id' => $pickup->id,

            'delivery_start' => now()->isMonday() ?
            now()->hour(2) :
            now()->next('Saturday')->hour(2),
            'delivery_end' => now()->isMonday() ?
            now()->hour(4) :
            now()->next('Saturday')->hour(4),
            'delivery_location' => new Point(15.12856334381691, 120.59788736325552),
            'delivery_address_id' => $delivery->id,

            'customer_max_amount' => 8000,
            'customer_max_currency_code' => 'PHP',
            'user_id' => $customer->id,
            'company' => 'User four Company',
            'contact_name' => 'User four',
            'email_to_notify' => 'userfour@gmail.com',
            'pickup_equipments' => json_encode(['forklifts', 'boomtruck']),
            'delivery_equipments' => json_encode(['boomtruck', 'forklifts']),
            'state' => array_rand(LoadStatusEnum::labels(), 1),
        ]);

        // https://linear.app/grabatruckloadph/issue/GRA-89/load-2-1000kgs-5-pallets-in-month-2
        $this->travelTo($start->addMonth());
        $this->command->info('Creating second load for ukay ukay owner');
        $load = Load::factory()->create([
            'weight' => 1000,
            'volume' => 10,

            'pickup_start' => now()->isMonday() ?
            now()->hour(5) :
            now()->next('Saturday')->hour(5),
            'pickup_end' => now()->isMonday() ?
            now()->hour(6) :
            now()->next('Saturday')->hour(6),
            'pickup_location' => new Point(14.589180856457421, 120.96434692953726),
            'pickup_address_id' => $pickup->id,

            'delivery_start' => now()->isMonday() ?
            now()->hour(2) :
            now()->next('Saturday')->hour(2),
            'delivery_end' => now()->isMonday() ?
            now()->hour(4) :
            now()->next('Saturday')->hour(4),
            'delivery_location' => new Point(15.12856334381691, 120.59788736325552),
            'delivery_address_id' => $delivery->id,

            'customer_max_amount' => 20000,
            'customer_max_currency_code' => 'PHP',
            'user_id' => $customer->id,
            'company' => 'User four Company',
            'contact_name' => 'User four',
            'email_to_notify' => 'userfour@gmail.com',
            'pickup_equipments' => json_encode(['forklifts', 'boomtruck']),
            'delivery_equipments' => json_encode(['boomtruck', 'forklifts']),
            'state' => array_rand(LoadStatusEnum::labels(), 1),
        ]);

        // https://linear.app/grabatruckloadph/issue/GRA-90/load-3-1500kgs-8-pallets-in-month-3
        $this->travelTo($start->addMonth());
        $this->command->info('Creating third load for ukay ukay owner');
        $load = Load::factory()->create([
            'weight' => 1500,
            'volume' => 11.52,

            'pickup_start' => now()->isMonday() ?
            now()->hour(5) :
            now()->next('Saturday')->hour(5),
            'pickup_end' => now()->isMonday() ?
            now()->hour(6) :
            now()->next('Saturday')->hour(6),
            'pickup_location' => new Point(14.589180856457421, 120.96434692953726),
            'pickup_address_id' => $pickup->id,

            'delivery_start' => now()->isMonday() ?
            now()->hour(2) :
            now()->next('Saturday')->hour(2),
            'delivery_end' => now()->isMonday() ?
            now()->hour(4) :
            now()->next('Saturday')->hour(4),
            'delivery_location' => new Point(15.12856334381691, 120.59788736325552),
            'delivery_address_id' => $delivery->id,

            'customer_max_amount' => 32000,
            'customer_max_currency_code' => 'PHP',
            'user_id' => $customer->id,
            'company' => 'User four Company',
            'contact_name' => 'User four',
            'email_to_notify' => 'userfour@gmail.com',
            'pickup_equipments' => json_encode(['forklifts', 'boomtruck']),
            'delivery_equipments' => json_encode(['boomtruck', 'forklifts']),
            'state' => array_rand(LoadStatusEnum::labels(), 1),
        ]);

        // https://linear.app/grabatruckloadph/issue/GRA-91/load-4-800kgs-4-pallets-in-month-4
        $this->travelTo($start->addMonth());
        $this->command->info('Creating fourth load for ukay ukay owner');
        $load = Load::factory()->create([
            'weight' => 800,
            'volume' => 5.76,

            'pickup_start' => now()->isMonday() ?
            now()->hour(5) :
            now()->next('Saturday')->hour(5),
            'pickup_end' => now()->isMonday() ?
            now()->hour(6) :
            now()->next('Saturday')->hour(6),
            'pickup_location' => new Point(14.589180856457421, 120.96434692953726),
            'pickup_address_id' => $pickup->id,

            'delivery_start' => now()->isMonday() ?
            now()->hour(2) :
            now()->next('Saturday')->hour(2),
            'delivery_end' => now()->isMonday() ?
            now()->hour(4) :
            now()->next('Saturday')->hour(4),
            'delivery_location' => new Point(15.12856334381691, 120.59788736325552),
            'delivery_address_id' => $delivery->id,

            'customer_max_amount' => 16000,
            'customer_max_currency_code' => 'PHP',
            'user_id' => $customer->id,
            'company' => 'User four Company',
            'contact_name' => 'User four',
            'email_to_notify' => 'userfour@gmail.com',
            'pickup_equipments' => json_encode(['forklifts', 'boomtruck']),
            'delivery_equipments' => json_encode(['boomtruck', 'forklifts']),
            'state' => array_rand(LoadStatusEnum::labels(), 1),
        ]);

        // https://linear.app/grabatruckloadph/issue/GRA-92/load-5-2000kgs-10-pallets-in-month-5
        $this->travelTo($start->addMonth());
        $this->command->info('Creating fifth load for ukay ukay owner');
        $load = Load::factory()->create([
            'weight' => 2000,
            'volume' => 14.4,

            'pickup_start' => now()->isMonday() ?
            now()->hour(5) :
            now()->next('Saturday')->hour(5),
            'pickup_end' => now()->isMonday() ?
            now()->hour(6) :
            now()->next('Saturday')->hour(6),
            'pickup_location' => new Point(14.589180856457421, 120.96434692953726),
            'pickup_address_id' => $pickup->id,

            'delivery_start' => now()->isMonday() ?
            now()->hour(2) :
            now()->next('Saturday')->hour(2),
            'delivery_end' => now()->isMonday() ?
            now()->hour(4) :
            now()->next('Saturday')->hour(4),
            'delivery_location' => new Point(15.12856334381691, 120.59788736325552),
            'delivery_address_id' => $delivery->id,

            'customer_max_amount' => 40000,
            'customer_max_currency_code' => 'PHP',
            'user_id' => $customer->id,
            'company' => 'User four Company',
            'contact_name' => 'User four',
            'email_to_notify' => 'userfour@gmail.com',
            'pickup_equipments' => json_encode(['forklifts', 'boomtruck']),
            'delivery_equipments' => json_encode(['boomtruck', 'forklifts']),
            'state' => array_rand(LoadStatusEnum::labels(), 1),
        ]);

        // https://linear.app/grabatruckloadph/issue/GRA-93/load-6-500kgs-3-pallets-in-month-6
        $this->travelTo($start->addMonth());
        $this->command->info('Creating sixth load for ukay ukay owner');
        $load = Load::factory()->create([
            'weight' => 500,
            'volume' => 4.32,

            'pickup_start' => now()->isMonday() ?
            now()->hour(5) :
            now()->next('Saturday')->hour(5),
            'pickup_end' => now()->isMonday() ?
            now()->hour(6) :
            now()->next('Saturday')->hour(6),
            'pickup_location' => new Point(14.589180856457421, 120.96434692953726),
            'pickup_address_id' => $pickup->id,

            'delivery_start' => now()->isMonday() ?
            now()->hour(2) :
            now()->next('Saturday')->hour(2),
            'delivery_end' => now()->isMonday() ?
            now()->hour(4) :
            now()->next('Saturday')->hour(4),
            'delivery_location' => new Point(15.12856334381691, 120.59788736325552),
            'delivery_address_id' => $delivery->id,

            'customer_max_amount' => 12000,
            'customer_max_currency_code' => 'PHP',
            'user_id' => $customer->id,
            'company' => 'User four Company',
            'contact_name' => 'User four',
            'email_to_notify' => 'userfour@gmail.com',
            'pickup_equipments' => json_encode(['forklifts', 'boomtruck']),
            'delivery_equipments' => json_encode(['boomtruck', 'forklifts']),
            'state' => array_rand(LoadStatusEnum::labels(), 1),
        ]);
    }
}
