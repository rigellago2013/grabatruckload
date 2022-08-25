<?php

namespace Tests\Feature\Livewire\Load;

use App\Http\Livewire\Loads\LoadsTableComponent;
use App\Models\Load;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire;
use Tests\TestCase;

class LoadsTableComponentTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_contains_livewire_component(): void
    {
        $this->actingAs(User::factory()->withRole('admin')->create())
            ->get('/loads')
            ->assertSeeLivewire('loads.loads-table-component');
    }

    public function test_it_can_search_loads_by_searchTerm(): void
    {
        $user = User::factory()->withRole('admin')->create();
        $this->actingAs($user);
        Livewire::test(LoadsTableComponent::class)
            ->set('searchTerm', '5067')
            ->assertHasNoErrors(['searchTerm']);
    }

    public function test_it_can_search_load_by_pickup_and_delivery_date(): void
    {
        $user = User::factory()->withRole('admin')->create();
        $this->actingAs($user);

        Livewire::test(LoadsTableComponent::class)
            ->set('dateStartString', '12/01/2021')
            ->set('dateEndString', '12/30/2021')
            ->assertHasNoErrors(['dateStartString', 'dateEndString']);
    }

    // 7. check which user roles can create a load
    public function test_it_can_search_load_by_loadtype(): void
    {
        $user = User::factory()->withRole('admin')->create();
        $this->actingAs($user);

        Livewire::test(LoadsTableComponent::class)
            ->set('loadType', 'loose')
            ->assertHasNoErrors(['loadType']);
    }

    public function test_it_can_search_load_by_pickup_region(): void
    {
        $user = User::factory()->withRole('admin')->create();
        $this->actingAs($user);

        Livewire::test(LoadsTableComponent::class)
            ->set('pickupRegion', ['Batangas'])
            ->assertHasNoErrors(['pickupRegion']);
    }

    public function test_it_can_search_load_by_delivery_region(): void
    {
        $user = User::factory()->withRole('admin')->create();
        $this->actingAs($user);

        Livewire::test(LoadsTableComponent::class)
            ->set('deliveryRegion', ['Batangas'])
            ->assertHasNoErrors(['deliveryRegion']);
    }

    public function test_it_can_search_load_by_status(): void
    {
        $user = User::factory()->withRole('admin')->create();
        $this->actingAs($user);

        Livewire::test(LoadsTableComponent::class)
            ->set('statuses', ['complete'])
            ->assertHasNoErrors(['statuses']);
    }

    public function test_it_can_sort_loads(): void
    {
        $user = User::factory()->withRole('admin')->create();
        $this->actingAs($user);

        Livewire::test(LoadsTableComponent::class)
            ->set('sort', 'pickup_start')
            ->assertHasNoErrors(['sort']);
    }

    //8. confirm other user roles can not access create load page, or update a load
    public function test_admin_can_access_loads_table_page(): void
    {
        $user = User::factory()->withRole('admin')->create();
        $response = $this->actingAs($user)->get('/loads');
        $response->assertStatus(200);
    }

    public function test_customer_can_access_loads_table_page(): void
    {
        $user = User::factory()->withRole('customer')->create();
        $response = $this->actingAs($user)->get('/loads');
        $response->assertStatus(200);
    }

    public function test_driver_can_not_access_loads_table_page(): void
    {
        $user = User::factory()->withRole('driver')->create();
        $response = $this->actingAs($user)->get('/loads');
        $response->assertStatus(403);
    }

    public function test_owner_can_not_access_loads_table_page(): void
    {
        $user = User::factory()->withRole('owner')->create();
        $response = $this->actingAs($user)->get('/loads');
        $response->assertStatus(403);
    }
}
