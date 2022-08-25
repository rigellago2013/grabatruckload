<?php

namespace Database\Seeders\Users;

use App\Actions\Loads\AcceptOffer;
use App\Actions\Loads\DeliverLoad;
use App\Actions\Loads\MakeOfferOnLoad;
use App\Actions\Loads\PickupLoad;
use App\Actions\Loads\PublishLoad;
use App\Enums\LoadTypeEnum;
use App\Enums\VehicleCategoryEnum;
use App\Enums\VehicleTypeEnum;
use App\Models\Address;
use App\Models\Link;
use App\Models\Load;
use App\Models\Movement;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleGroup;
use Brick\Money\Money;
use Carbon\Carbon;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\Concerns\InteractsWithTime;

class UserOneSeeder extends Seeder
{
    use InteractsWithTime;

    public function run(): void
    {
        $this->travelBack();
        $start = now()->subMonths(6);

        // https://linear.app/grabatruckloadph/issue/GRA-60/for-user-1-create-a-weekly-booking-moving-coconuts-from-sulop-to-davao
        $this->travelTo($start);

        $farmer = User::factory()
            ->withRole('Customer')
            ->create([
                'name' => 'Sulop Farmer',
            ]);

        $pickup = Address::factory()->create();
        $delivery = Address::factory()->create();

        foreach (range(1, 50) as $week) {
            $this->travelTo($start->addWeek());

            $this->command->info("Creating load for sulop farmer, week {$week}");

            $vehicleGroup = VehicleGroup::factory()->create([
                'user_id' => $farmer->id,
            ]);

            $vehicle = Vehicle::factory()->create([
                'plate_number' => 'TRK0011',
                'type' => VehicleTypeEnum::labels()['truck'],
                'category' => VehicleCategoryEnum::general(),
                'or_cr_copy' => json_encode(['cr/VSrTxVoBazYEpEyHV8Rz4ribQzngnvYhyIw6wcdU.png']),
                'insurance_docs' => json_encode(['samples/or .jpeg']),
                'truck_picture' => json_encode(['samples/cr.jpeg']),
                'weight_capacity' => 10000,
                'volume_capacity' => 10,
                'truck_category' => 'large',
                'notes' => 'Lorem ipsum',
                'deck_length' => rand(1, 1000),
                'maximum_capacity' => rand(100, 10000),
                'vehicle_group_id' => $vehicleGroup->id,
            ]);

            $load = Load::factory()->create([
                'weight' => rand(1, 5000),
                'volume' => rand(1, 1000),
                'load_type' => LoadTypeEnum::general(),
                'pickup_start' => now()->isWednesday() ? now()->addDay(3)->hour(10) : now()->addDay(3)->hour(10),
                'pickup_end' => now()->isWednesday() ? now()->addDay(3)->hour(15) : now()->addDay(3)->hour(15),
                'pickup_location' => new Point(6.640434672033844, 125.32341788821032),
                'pickup_address_id' => $pickup->id,
                'delivery_start' => now()->isMonday() ? now()->hour(4) : now()->next('Monday')->hour(4),
                'delivery_end' => now()->isMonday() ? now()->hour(4) : now()->next('Monday')->hour(4),
                'delivery_location' => new Point(7.077722013924448, 125.62552310985049),
                'delivery_address_id' => $delivery->id,
                'customer_max_amount' => 5000,
                'customer_max_currency_code' => 'PHP',
                'user_id' => $farmer->id,
                'company' => 'User one Company',
                'contact_name' => 'User one',
                'email_to_notify' => 'userone@gmail.com',
                'pickup_equipments' => json_encode(['forklifts', 'boomtruck']),
                'pickup_equipments' => json_encode(['boomtruck', 'forklifts']),
                'vehicle_id' => $vehicle->id,
            ]);

            $movement = Movement::factory()->create([
                'pickup_start' => now()->isWednesday() ? now()->addDay(3)->hour(10) : now()->addDay(3)->hour(10),
                'pickup_end' => now()->isWednesday() ? now()->addDay(3)->hour(15) : now()->addDay(3)->hour(15),
                'destination_start' => now()->isMonday() ? now()->hour(4) : now()->next('Monday')->hour(4),
                'destination_end' => now()->isMonday() ? now()->hour(4) : now()->next('Monday')->hour(4),
                'pickup_address_id' => $pickup->id,
                'destination_address_id' => $delivery->id,
            ]);

            app(PublishLoad::class)->execute($load);

            Link::factory()->create([
                'load_id' => $load->id,
                'movement_id' => $movement->id,
            ]);

            // between 96 and 48 hours ahead of pickup time, create an offer for at least 1 truck owner
            $this->travelTo(Carbon::createFromDate($load->pickup_start)->subDays(3));

            $owner = User::customer()
                ->hasVehicles()
                ->firstOrFail();

            $group = VehicleGroup::ownedBy($owner)->first();

            $offerOne = app(MakeOfferOnLoad::class)->execute(
                $load,
                $owner,
                Money::ofMinor(4500, 'PHP'),
                $group,
                null
            );

            // 12-24 hours later create a counter-offer
            $this->travelTo(Carbon::createFromDate($load->pickup_start)->subDays(2));
            $offerTwo = app(MakeOfferOnLoad::class)->execute(
                $load,
                $owner,
                Money::ofMinor(4200, 'PHP'),
                null,
                $offerOne
            );

            app(AcceptOffer::class)->execute($offerTwo);
            $load->refresh();

            $this->travelTo(Carbon::createFromDate($load->pickup_start)->addHour());
            app(PickupLoad::class)->execute($load);
            $load->refresh();

            $this->travelTo(Carbon::createFromDate($load->delivery_start)->addHour());
            app(DeliverLoad::class)->execute($load);
            $load->refresh();
        }
    }
}
