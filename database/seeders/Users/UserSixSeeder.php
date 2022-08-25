<?php

namespace Database\Seeders\Users;

use App\Enums\LoadStatusEnum;
use App\Models\Address;
use App\Models\Load;
use App\Models\User;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\Concerns\InteractsWithTime;

class UserSixSeeder extends Seeder
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
                'name' => 'Sari Sari Store',
            ]);

        $pickup = Address::factory()->create([
            'street_address' => 'Monde Nissin, Balibago Road',
            'barangay' => '',
            'city' => 'Sta. Rosa City',
            'province' => 'Laguna',
        ]);

        $delivery = Address::factory()->create([
            'street_address' => 'Vercons Supermarket and Department Store Orion',
            'barangay' => 'Orion Public Market',
            'city' => 'Orion',
            'province' => 'Bataan',
        ]);

        foreach (range(1, 2) as $week) {
            $this->command->info("Creating load {$week} for sari-sari");
            Load::factory()->create([
                'weight' => 11900,
                'volume' => 5,
                'pickup_start' => now()->isMonday() ? now()->hour(5) : now()->next('Monday')->hour(5),
                'pickup_end' => now()->isMonday() ? now()->hour(6) : now()->next('Monday')->hour(6),
                'pickup_location' => new Point(14.290925122253482, 121.09807302165952),
                'pickup_address_id' => $pickup->id,
                'delivery_start' => now()->isMonday() ? now()->hour(10) : now()->next('Monday')->hour(10),
                'delivery_end' => now()->isMonday() ? now()->hour(12) : now()->next('Monday')->hour(12),
                'delivery_location' => new Point(14.627540376691053, 120.57605154294167),
                'delivery_address_id' => $delivery->id,
                'customer_max_amount' => 18135,
                'customer_max_currency_code' => 'PHP',
                'user_id' => $customer->id,
                'company' => 'User six Company',
                'contact_name' => 'User six',
                'email_to_notify' => 'usersix@gmail.com',
                'pickup_equipments' => json_encode(['forklifts', 'boomtruck']),
                'delivery_equipments' => json_encode(['boomtruck', 'forklifts']),
                'state' => array_rand(LoadStatusEnum::labels(), 1),
            ]);

            $this->travelTo($start->addMonths(3));

            Load::factory()->create([
                'weight' => 11900,
                'volume' => 5,
                'pickup_start' => now()->isMonday() ? now()->hour(5) : now()->next('Monday')->hour(5),
                'pickup_end' => now()->isMonday() ? now()->hour(6) : now()->next('Monday')->hour(6),
                'pickup_location' => new Point(14.290925122253482, 121.09807302165952),
                'pickup_address_id' => $pickup->id,
                'delivery_start' => now()->isMonday() ? now()->hour(10) : now()->next('Monday')->hour(12),
                'delivery_end' => now()->isMonday() ? now()->hour(10) : now()->next('Monday')->hour(12),
                'delivery_location' => new Point(14.627540376691053, 120.57605154294167),
                'delivery_address_id' => $delivery->id,
                'customer_max_amount' => 18135,
                'customer_max_currency_code' => 'PHP',
                'user_id' => $customer->id,
                'company' => 'User six Company',
                'contact_name' => 'User six',
                'email_to_notify' => 'usersix@gmail.com',
                'pickup_equipments' => json_encode(['forklifts', 'boomtruck']),
                'delivery_equipments' => json_encode(['boomtruck', 'forklifts']),
                'state' => array_rand(LoadStatusEnum::labels(), 1),
            ]);
        }
    }
}
