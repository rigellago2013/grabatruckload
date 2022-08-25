<?php

namespace Database\Seeders;

use App\Actions\Loads\AcceptOffer;
use App\Actions\Loads\DeliverLoad;
use App\Actions\Loads\GetOffersForLoad;
use App\Actions\Loads\MakeOfferOnLoad;
use App\Actions\Loads\PickupLoad;
use App\Actions\Loads\PublishLoad;
use App\Console\Commands\CreateRolesAndPermissions;
use App\Models\Load;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleGroup;
use Brick\Money\Money;
use Database\Seeders\Users\OwnerOneSeeder;
use Database\Seeders\Users\OwnerTwoSeeder;
use Database\Seeders\Users\UserEightSeeder;
use Database\Seeders\Users\UserElevenSeeder;
use Database\Seeders\Users\UserFifteenSeeder;
use Database\Seeders\Users\UserFiveSeeder;
use Database\Seeders\Users\UserFourSeeder;
use Database\Seeders\Users\UserFourteenSeeder;
use Database\Seeders\Users\UserNineSeeder;
use Database\Seeders\Users\UserOneSeeder;
use Database\Seeders\Users\UserSevenSeeder;
use Database\Seeders\Users\UserSevenTeenSeeder;
use Database\Seeders\Users\UserSixSeeder;
use Database\Seeders\Users\UserSixteenSeeder;
use Database\Seeders\Users\UserTenSeeder;
use Database\Seeders\Users\UserThirteenSeeder;
use Database\Seeders\Users\UserTwelveSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\Concerns\InteractsWithTime;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    use InteractsWithTime;

    public function run(): void
    {
        Artisan::call(CreateRolesAndPermissions::class);

        // Add Users
        foreach (Role::all() as $role) {
            User::factory(10)
                ->withRole($role->name)
                ->create();
        }

        User::factory()
            ->withRole('admin')
            ->create([
                'email' => 'admin@example.com',
            ]);

        $this->call(OwnerOneSeeder::class);
        $this->call(OwnerTwoSeeder::class);
        $this->call(UserOneSeeder::class);
        $this->call(UserEightSeeder::class);
        $this->call(UserElevenSeeder::class);
        $this->call(UserFourSeeder::class);
        $this->call(UserFourteenSeeder::class);
        $this->call(UserNineSeeder::class);
        $this->call(UserFiveSeeder::class);
        $this->call(UserSixSeeder::class);
        $this->call(UserSevenSeeder::class);
        $this->call(UserSeventeenSeeder::class);
        $this->call(UserSixteenSeeder::class);
        $this->call(UserTenSeeder::class);
        $this->call(UserThirteenSeeder::class);
        $this->call(UserTwelveSeeder::class);
        $this->call(UserFifteenSeeder::class);

        // Add vehicles
        foreach (User::role('owner')->get() as $owner) {
            Vehicle::factory()
                ->ownedBy($owner)
                ->create();
        }

        // Add loads
        foreach (User::role('customer')->get() as $customer) {
            $load = Load::factory()
                ->create([
                    'user_id' => $owner->id,
                ]);

            if (random_int(0, 10) >= 5) {
                app(PublishLoad::class)->execute($load);

                if (random_int(0, 10) >= 3) {
                    $this->command->info('1 day before pickup add an offer');
                    $this->travelTo($load->pickup_start->subDays(1));
                    app(MakeOfferOnLoad::class)->execute(
                        $load,
                        $owner,
                        Money::of(17000, 'PHP'), // the factory max is 15k
                        VehicleGroup::ownedBy($owner)->first(),
                        null,
                    );

                    $this->command->info('after one hour, negotiate');
                    $this->travelTo($load->pickup_start->subDays(1)->addHour());
                    app(MakeOfferOnLoad::class)->execute(
                        $load,
                        $owner,
                        Money::of(16000, 'PHP'), // the factory max is 15k
                        VehicleGroup::ownedBy($owner)->first(),
                        null,
                    );

                    // after another hour accept
                    $this->travelTo($load->pickup_start->subDays(1)->addHours(2));
                    $offers = app(GetOffersForLoad::class)->execute($load, $owner);
                    app(AcceptOffer::class)->execute($offers->first());
                    $load->refresh();

                    // at the end of the pickup window, driver confirms pickup
                    $this->travelTo($load->pickup_end);
                    app(PickupLoad::class)->execute($load);
                    $load->refresh();

                    // at the end of the pickup window, driver confirms pickup
                    $this->travelTo($load->delivery_start);
                    app(DeliverLoad::class)->execute($load);
                    $load->refresh();
                }

                // these ones all expire with no offers
            }
        }

        // Add routes

        // Create matches

        // Move loads into various states
    }
}
