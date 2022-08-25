<?php

namespace Tests\Feature\Livewire\Vehicle;

use App\Http\Livewire\Vehicles\VehiclesCreateComponent;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire;
use Tests\TestCase;

class CreateVehicleComponentTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_contains_livewire_component(): void
    {
        $this->actingAs(User::factory()->withRole('admin')->create())
            ->get('/trucks/create')
            ->assertSeeLivewire('vehicles.vehicles-create-component');
    }

    public function test_it_can_create_a_vehicle(): void
    {
        $user = User::factory()
            ->withRole('admin')
            ->create();

        $this->actingAs($user);

        Livewire::test(
            VehiclesCreateComponent::class,
            [
                'loadType' => 'loose',
                'vehicleType' => 'trailer',
                'category' => 'refrigerated',
                'plateNumber' => 'YNN7878',
                'notes' => 'Lorem Ipsum',
                'deckLength' => 233,
                'trailerType' => 'livestock',
                'weight' => 2509,
                'truckType' => 'wing',
                'truckCategory' => 'general',
                'or' => json_encode([]),
                'cr' => json_encode([]),
                'truckPicture' => json_encode([]),
                'volume' => 12,
                'trailerOption' => 'test',
            ]
        )->call('createVehicle')->assertRedirect(route('trucks.index'));
    }

    public function test_it_can_not_create_a_vehicle_with_invalid_data(): void
    {
        $user = User::factory()->withRole('admin')->create();
        $this->actingAs($user);

        Livewire::test(VehiclesCreateComponent::class)
            ->set('loadType', '')
            ->set('category', '')
            ->set('plateNumber', '')
            ->assertHasErrors(['loadType', 'category', 'plateNumber']);
    }

    public function test_admin_can_create_vehicle(): void
    {
        $user = User::factory()->withRole('admin')->create();
        $this->actingAs($user);

        Livewire::test(
            VehiclesCreateComponent::class,
            [
                'loadType' => 'loose',
                'vehicleType' => 'trailer',
                'category' => 'refrigerated',
                'plateNumber' => 'YNN7878',
                'notes' => 'Lorem Ipsum',
                'deckLength' => 233,
                'trailerType' => 'livestock',
                'weight' => 2509,
                'truckType' => 'wing',
                'truckCategory' => 'general',
                'or' => json_encode([]),
                'cr' => json_encode([]),
                'truckPicture' => json_encode([]),
                'volume' => 12,
                'trailerOption' => 'test',
            ]
        )->call('createVehicle')->assertRedirect(route('trucks.index'));
    }

    public function test_customer_can_create_vehicle(): void
    {
        $user = User::factory()->withRole('customer')->create();
        $this->actingAs($user);

        Livewire::test(
            VehiclesCreateComponent::class,
            [
                'loadType' => 'loose',
                'vehicleType' => 'trailer',
                'category' => 'refrigerated',
                'plateNumber' => 'YNN7878',
                'notes' => 'Lorem Ipsum',
                'deckLength' => 233,
                'trailerType' => 'livestock',
                'weight' => 2509,
                'truckType' => 'wing',
                'truckCategory' => 'general',
                'or' => json_encode([]),
                'cr' => json_encode([]),
                'truckPicture' => json_encode([]),
                'volume' => 12,
                'trailerOption' => 'test',
            ]
        )->call('createVehicle')->assertRedirect(route('trucks.index'));
    }

    public function test_owner_can_create_vehicle(): void
    {
        $user = User::factory()->withRole('owner')->create();
        $this->actingAs($user);

        Livewire::test(
            VehiclesCreateComponent::class,
            [
                'loadType' => 'loose',
                'vehicleType' => 'trailer',
                'category' => 'refrigerated',
                'plateNumber' => 'YNN7878',
                'notes' => 'Lorem Ipsum',
                'deckLength' => 233,
                'trailerType' => 'livestock',
                'weight' => 2509,
                'truckType' => 'wing',
                'truckCategory' => 'general',
                'or' => json_encode([]),
                'cr' => json_encode([]),
                'truckPicture' => json_encode([]),
                'volume' => 12,
                'trailerOption' => 'test',
            ]
        )->call('createVehicle')->assertRedirect(route('trucks.index'));
    }

    public function test_admin_can_access_create_vehicle_page(): void
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->withRole('admin')->create();
        $response = $this->actingAs($user)->get('/trucks/create');
        $response->assertStatus(200);
    }

    public function test_customer_can_not_access_create_vehicle_page(): void
    {
        $user = User::factory()->withRole('customer')->create();
        $response = $this->actingAs($user)->get('/trucks/create');
        $response->assertStatus(403);
    }

    public function test_driver_can_access_create_vehicle_page(): void
    {
        $user = User::factory()->withRole('driver')->create();
        $response = $this->actingAs($user)->get('/trucks/create');
        $response->assertStatus(403);
    }

    public function test_owner_can_access_create_vehicle_page(): void
    {
        $user = User::factory()->withRole('owner')->create();
        $response = $this->actingAs($user)->get('/trucks/create');
        $response->assertStatus(200);
    }
}
