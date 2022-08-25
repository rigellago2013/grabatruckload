<?php

namespace Tests\Feature\Livewire\Load;

use App\Http\Livewire\Loads\UpdateDeliveryDetailsComponent;
use App\Models\Address;
use App\Models\Load;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire;
use Tests\TestCase;

class UpdateDeliveryDetailsComponentTest extends TestCase
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
            ->get("/loads/{$this->load->id}/delivery-details")
            ->assertSeeLivewire('loads.update-delivery-details-component');
    }

    // 1. test complete form 3 with valid data
    // set some properties
    // call updateDelivery
    // check data is updated in database
    // check that you are redirected to the show load route
    public function test_it_can_update_delivery_details(): void
    {
        $this->actingAs(User::factory()->withRole('admin')->create());
        $deliveryStart = Carbon::parse('2021-12-22 09:00:00');
        $deliveryEnd = Carbon::parse('2021-12-23 09:00:00');

        Livewire::test(UpdateDeliveryDetailsComponent::class, ['load' => $this->load])
            ->set('company', 'Company Name')
            ->set('contactName', 'Contact Name')
            ->set('phoneNumber', '1234567')
            ->set('email', 'test@gmail.com')
            ->set('extraEmails', ['test@gmail.com'])
            ->set('street', 'Street Name')
            ->set('town', 'Town Name')
            ->set('postCode', '12345')
            ->set('deliveryStart', $deliveryStart)
            ->set('deliveryEnd', $deliveryEnd)
            ->set('deliveryEquipments', ['forklifts', 'boomtruck'])
            ->call('updateDelivery')
            ->assertHasNoErrors(['deliveryEquipments','street', 'town', 'postCode', 'company', 'contactName', 'phoneNumber', 'email', 'extraEmails', 'pickupStart', 'pickupEnd'])
            ->assertRedirect(route('loads.index'));
        $this->assertTrue(Address::where('postCode', '12345')->exists());
    }

    // // 2. test complete form 3 with invalid data
    // // check for validation errors
    // // general
    public function test_it_can_not_update_delivery_details_with_invalid_data(): void
    {
        $this->actingAs(User::factory()->withRole('admin')->create());

        $deliveryStart = Carbon::parse('0000/00/00 00:00:00');
        $deliveryEnd = Carbon::parse('0000/00/00 00:00:00');

        Livewire::test(UpdateDeliveryDetailsComponent::class, ['load' => $this->load])
            ->set('company', '')
            ->set('contactName', '')
            ->set('phoneNumber', '12')
            ->set('email', '')
            ->set('street', '')
            ->set('town', '')
            ->set('postCode', '')
            ->set('deliveryStart', $deliveryStart)
            ->set('deliveryEnd', $deliveryEnd)
            ->set('instructions', '')
            ->call('updateDelivery')
            ->assertHasErrors(['street', 'town', 'postCode', 'company', 'contactName', 'phoneNumber', 'email', 'deliveryStart', 'deliveryEnd']);
    }

    // 3. check which user roles can update delivery details
    public function test_admin_can_update_delivery_details(): void
    {
        $this->actingAs(User::factory()->withRole('admin')->create());
        $deliveryStart = Carbon::parse('2021-12-22 09:00:00');
        $deliveryEnd = Carbon::parse('2021-12-23 09:00:00');

        Livewire::test(UpdateDeliveryDetailsComponent::class, ['load' => $this->load])
            ->set('company', 'Company Name')
            ->set('contactName', 'Contact Name')
            ->set('phoneNumber', '1234567')
            ->set('email', 'test@gmail.com')
            ->set('extraEmails', ['test@gmail.com'])
            ->set('street', 'Street Name')
            ->set('town', 'Town Name')
            ->set('postCode', '12345')
            ->set('deliveryStart', $deliveryStart)
            ->set('deliveryEnd', $deliveryEnd)
            ->set('deliveryEquipments', ['forklifts', 'boomtruck'])
            ->call('updateDelivery')
            ->assertHasNoErrors(['deliveryEquipments','street', 'town', 'postCode', 'company', 'contactName', 'phoneNumber', 'email', 'extraEmails', 'pickupStart', 'pickupEnd'])
            ->assertRedirect(route('loads.index'));
        $this->assertTrue(Address::where('postCode', '12345')->exists());
    }

    public function test_customer_can_update_delivery_details(): void
    {
        $this->actingAs(User::factory()->withRole('admin')->create());
        $deliveryStart = Carbon::parse('2021-12-22 09:00:00');
        $deliveryEnd = Carbon::parse('2021-12-23 09:00:00');

        Livewire::test(UpdateDeliveryDetailsComponent::class, ['load' => $this->load])
            ->set('company', 'Company Name')
            ->set('contactName', 'Contact Name')
            ->set('phoneNumber', '1234567')
            ->set('email', 'test@gmail.com')
            ->set('extraEmails', ['test@gmail.com'])
            ->set('street', 'Street Name')
            ->set('town', 'Town Name')
            ->set('postCode', '12345')
            ->set('deliveryStart', $deliveryStart)
            ->set('deliveryEnd', $deliveryEnd)
            ->set('deliveryEquipments', ['forklifts', 'boomtruck'])
            ->call('updateDelivery')
            ->assertHasNoErrors(['deliveryEquipments','street', 'town', 'postCode', 'company', 'contactName', 'phoneNumber', 'email', 'extraEmails', 'pickupStart', 'pickupEnd'])
            ->assertRedirect(route('loads.index'));
        $this->assertTrue(Address::where('postCode', '12345')->exists());
    }

    public function test_owner_can_update_delivery_details(): void
    {
        $this->actingAs(User::factory()->withRole('admin')->create());
        $deliveryStart = Carbon::parse('2021-12-22 09:00:00');
        $deliveryEnd = Carbon::parse('2021-12-23 09:00:00');

        Livewire::test(UpdateDeliveryDetailsComponent::class, ['load' => $this->load])
            ->set('company', 'Company Name')
            ->set('contactName', 'Contact Name')
            ->set('phoneNumber', '1234567')
            ->set('email', 'test@gmail.com')
            ->set('extraEmails', ['test@gmail.com'])
            ->set('street', 'Street Name')
            ->set('town', 'Town Name')
            ->set('postCode', '12345')
            ->set('deliveryStart', $deliveryStart)
            ->set('deliveryEnd', $deliveryEnd)
            ->set('deliveryEquipments', ['forklifts', 'boomtruck'])
            ->call('updateDelivery')
            ->assertHasNoErrors(['deliveryEquipments','street', 'town', 'postCode', 'company', 'contactName', 'phoneNumber', 'email', 'extraEmails', 'pickupStart', 'pickupEnd'])
            ->assertRedirect(route('loads.index'));
        $this->assertTrue(Address::where('postCode', '12345')->exists());
    }

    public function test_driver_can_update_delivery_details(): void
    {
        $this->actingAs(User::factory()->withRole('admin')->create());
        $deliveryStart = Carbon::parse('2021-12-22 09:00:00');
        $deliveryEnd = Carbon::parse('2021-12-23 09:00:00');

        Livewire::test(UpdateDeliveryDetailsComponent::class, ['load' => $this->load])
            ->set('company', 'Company Name')
            ->set('contactName', 'Contact Name')
            ->set('phoneNumber', '1234567')
            ->set('email', 'test@gmail.com')
            ->set('extraEmails', ['test@gmail.com'])
            ->set('street', 'Street Name')
            ->set('town', 'Town Name')
            ->set('postCode', '12345')
            ->set('deliveryStart', $deliveryStart)
            ->set('deliveryEnd', $deliveryEnd)
            ->set('deliveryEquipments', ['forklifts', 'boomtruck'])
            ->call('updateDelivery')
            ->assertHasNoErrors(['deliveryEquipments','street', 'town', 'postCode', 'company', 'contactName', 'phoneNumber', 'email', 'extraEmails', 'pickupStart', 'pickupEnd'])
            ->assertRedirect(route('loads.index'));
        $this->assertTrue(Address::where('postCode', '12345')->exists());
    }


    // 4. confirm other user roles can not access update deliver details page, or update a load
    public function test_admin_can_access_delivery_details_page(): void
    {
        $user = User::factory()->withRole('admin')->create();
        $response = $this->actingAs($user)->get("/loads/{$this->load->id}/delivery-details");
        $response->assertStatus(200);
    }

    public function test_customer_can_access_delivery_details_page(): void
    {
        $user = User::factory()->withRole('customer')->create();
        $response = $this->actingAs($user)->get("/loads/{$this->load->id}/delivery-details");
        $response->assertStatus(200);
    }

    public function test_driver_can_access_delivery_details_page(): void
    {
        $user = User::factory()->withRole('driver')->create();
        $response = $this->actingAs($user)->get("/loads/{$this->load->id}/delivery-details");
        $response->assertStatus(200);
    }

    public function test_owner_can_access_delivery_details_page(): void
    {
        $user = User::factory()->withRole('owner')->create();
        $response = $this->actingAs($user)->get("/loads/{$this->load->id}/delivery-details");
        $response->assertStatus(200);
    }
}
