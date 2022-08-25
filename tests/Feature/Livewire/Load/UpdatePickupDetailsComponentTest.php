<?php

namespace Tests\Feature\Livewire\Load;

use App\Http\Livewire\Loads\UpdatePickupDetailsComponent;
use App\Models\Address;
use App\Models\Load;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire;
use Tests\TestCase;

class UpdatePickupDetailsComponentTest extends TestCase
{
    use RefreshDatabase;

    protected $load;

    public function setUp(): void
    {
        parent::setUp();
        $this->load = Load::factory()->create();
    }

    public function test_it_contains_livewire_component(): void
    {
        $this->actingAs(User::factory()->withRole('admin')->create())
            ->get("loads/{$this->load->id}/pickup-details")
            ->assertSeeLivewire('loads.update-pickup-details-component');
    }

    // 1. test complete form 2 with valid data
    // use factory to create a load with the right data from step 1
    // set some properties
    // call updatePickup
    // check data is updated in database
    // check that you are redirected
    public function test_it_can_update_pickup_details(): void
    {
        $this->actingAs(User::factory()->withRole('admin')->create());

        $pickupStart = Carbon::parse('2021-12-22 09:00:00');
        $pickupEnd = Carbon::parse('2021-12-23 09:00:00');

        Livewire::test(UpdatePickupDetailsComponent::class, ['load' => $this->load])
            ->set('company', 'Company Name')
            ->set('contactName', 'Contact Name')
            ->set('phoneNumber', '1234567')
            ->set('email', 'test@gmail.com')
            ->set('extraEmails', [''])
            ->set('street', 'Street Name')
            ->set('town', 'Town Name')
            ->set('postCode', '12345')
            ->set('pickupStart', $pickupStart)
            ->set('pickupEnd', $pickupEnd)
            ->call('updatePickup')
            ->assertHasNoErrors(['street', 'town', 'postCode', 'company', 'contactName', 'phoneNumber', 'email', 'extraEmails', 'pickupStart', 'pickupEnd'])
            ->assertRedirect(route('loads.update-delivery-details', ['load' => $this->load]));
        $this->assertTrue(Address::where('postCode', '12345')->exists());
    }

    // // 2. test complete form 2 with invalid data
    // // check for validation errors
    public function test_it_can_not_update_pickup_details_with_invalid_data(): void
    {
        $this->actingAs(User::factory()->withRole('admin')->create());

        $pickupStart = Carbon::parse('0000/00/00 00:00:00');
        $pickupEnd = Carbon::parse('0000/00/00 00:00:00');

        Livewire::test(UpdatePickupDetailsComponent::class, ['load' => $this->load])
            ->set('company', '')
            ->set('contactName', '')
            ->set('phoneNumber', '12')
            ->set('email', '')
            ->set('street', '')
            ->set('town', '')
            ->set('postCode', '')
            ->set('pickupStart', $pickupStart)
            ->set('pickupEnd', $pickupEnd)
            ->call('updatePickup')
            ->assertHasErrors(['street', 'town', 'postCode', 'company', 'contactName', 'phoneNumber', 'email', 'pickupStart', 'pickupEnd']);
    }

    // 3. check which user roles can create a load
    public function test_admin_can_update_pickup_details(): void
    {
        $this->actingAs(User::factory()->withRole('admin')->create());

        $pickupStart = Carbon::parse('2021-12-22 09:00:00');
        $pickupEnd = Carbon::parse('2021-12-23 09:00:00');

        Livewire::test(UpdatePickupDetailsComponent::class, ['load' => $this->load])
            ->set('company', 'Company Name')
            ->set('contactName', 'Contact Name')
            ->set('phoneNumber', '1234567')
            ->set('email', 'test@gmail.com')
            ->set('extraEmails', [''])
            ->set('street', 'Street Name')
            ->set('town', 'Town Name')
            ->set('postCode', '12345')
            ->set('pickupStart', $pickupStart)
            ->set('pickupEnd', $pickupEnd)
            ->call('updatePickup')
            ->assertHasNoErrors(['street', 'town', 'postCode', 'company', 'contactName', 'phoneNumber', 'email', 'extraEmails', 'pickupStart', 'pickupEnd'])
            ->assertRedirect(route('loads.update-delivery-details', ['load' => $this->load]));
        $this->assertTrue(Address::where('postCode', '12345')->exists());
    }

    public function test_customer_can_update_pickup_details(): void
    {
        $this->actingAs(User::factory()->withRole('customer')->create());

        $pickupStart = Carbon::parse('2021-12-22 09:00:00');
        $pickupEnd = Carbon::parse('2021-12-23 09:00:00');

        Livewire::test(UpdatePickupDetailsComponent::class, ['load' => $this->load])
            ->set('company', 'Company Name')
            ->set('contactName', 'Contact Name')
            ->set('phoneNumber', '1234567')
            ->set('email', 'test@gmail.com')
            ->set('extraEmails', [''])
            ->set('street', 'Street Name')
            ->set('town', 'Town Name')
            ->set('postCode', '12345')
            ->set('pickupStart', $pickupStart)
            ->set('pickupEnd', $pickupEnd)
            ->call('updatePickup')
            ->assertHasNoErrors(['street', 'town', 'postCode', 'company', 'contactName', 'phoneNumber', 'email', 'extraEmails', 'pickupStart', 'pickupEnd'])
            ->assertRedirect(route('loads.update-delivery-details', ['load' => $this->load]));
        $this->assertTrue(Address::where('postCode', '12345')->exists());
    }

    public function test_owner_can_update_pickup_details(): void
    {
        $this->actingAs(User::factory()->withRole('owner')->create());

        $pickupStart = Carbon::parse('2021-12-22 09:00:00');
        $pickupEnd = Carbon::parse('2021-12-23 09:00:00');

        Livewire::test(UpdatePickupDetailsComponent::class, ['load' => $this->load])
            ->set('company', 'Company Name')
            ->set('contactName', 'Contact Name')
            ->set('phoneNumber', '1234567')
            ->set('email', 'test@gmail.com')
            ->set('extraEmails', [''])
            ->set('street', 'Street Name')
            ->set('town', 'Town Name')
            ->set('postCode', '12345')
            ->set('pickupStart', $pickupStart)
            ->set('pickupEnd', $pickupEnd)
            ->call('updatePickup')
            ->assertHasNoErrors(['street', 'town', 'postCode', 'company', 'contactName', 'phoneNumber', 'email', 'extraEmails', 'pickupStart', 'pickupEnd'])
            ->assertRedirect(route('loads.update-delivery-details', ['load' => $this->load]));
        $this->assertTrue(Address::where('postCode', '12345')->exists());
    }

    public function test_driver_can_update_pickup_details(): void
    {
        $this->actingAs(User::factory()->withRole('driver')->create());

        $pickupStart = Carbon::parse('2021-12-22 09:00:00');
        $pickupEnd = Carbon::parse('2021-12-23 09:00:00');

        Livewire::test(UpdatePickupDetailsComponent::class, ['load' => $this->load])
            ->set('company', 'Company Name')
            ->set('contactName', 'Contact Name')
            ->set('phoneNumber', '1234567')
            ->set('email', 'test@gmail.com')
            ->set('extraEmails', [''])
            ->set('street', 'Street Name')
            ->set('town', 'Town Name')
            ->set('postCode', '12345')
            ->set('pickupStart', $pickupStart)
            ->set('pickupEnd', $pickupEnd)
            ->call('updatePickup')
            ->assertHasNoErrors(['street', 'town', 'postCode', 'company', 'contactName', 'phoneNumber', 'email', 'extraEmails', 'pickupStart', 'pickupEnd'])
            ->assertRedirect(route('loads.update-delivery-details', ['load' => $this->load]));
        $this->assertTrue(Address::where('postCode', '12345')->exists());
    }

    // 4. confirm other user roles can not access create load page, or update a load
    public function test_admin_can_access_pickup_details_page(): void
    {
        $user = User::factory()->withRole('admin')->create();
        $response = $this->actingAs($user)->get("/loads/{$this->load->id}/pickup-details");
        $response->assertStatus(200);
    }

    public function test_customer_can_access_pickup_details_page(): void
    {
        $user = User::factory()->withRole('customer')->create();
        $response = $this->actingAs($user)->get("/loads/{$this->load->id}/pickup-details");
        $response->assertStatus(200);
    }

    public function test_driver_can_access_pickup_details_page(): void
    {
        $user = User::factory()->withRole('driver')->create();
        $response = $this->actingAs($user)->get("/loads/{$this->load->id}/pickup-details");
        $response->assertStatus(200);
    }

    public function test_owner_can_access_pickup_details_page(): void
    {
        $user = User::factory()->withRole('owner')->create();
        $response = $this->actingAs($user)->get("/loads/{$this->load->id}/pickup-details");
        $response->assertStatus(200);
    }
}
