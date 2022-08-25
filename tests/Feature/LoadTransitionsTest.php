<?php

namespace Tests\Feature;

use App\Models\Load;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class LoadTransitionsTest extends TestCase
{
    public User $customer;
    public User $customerService;
    public User $driver;
    public Load $load;

    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $this->customer = User::factory()
            ->withRole('customer')
            ->create();
        $this->customerService = User::factory()
            ->withRole('customer-service')
            ->create();
        $this->driver = User::factory()
            ->withRole('driver')
            ->create();
        $this->load = Load::factory()
            ->pending()
            ->create([
                'user_id' => $this->customer->id,
            ]);
    }

    // States and Transitions
    public function test_transition_from_draft_to_pending(): void
    {
        Notification::fake();

        $this->actingAs($this->customer);
        $response = $this->post(
            route('loads.transition', [
                'state' => 'pending',
                'load' => $this->load,
            ]),
        );
        $this->load->refresh();

        $response->assertRedirect();
        $this->assertEquals('pending', $this->load->state->getValue());
    }

    public function test_transition_from_pending_to_published(): void
    {
//        Notification::fake();
//
//        // Customer can't do this, even on their own load
//        $this->actingAs($this->customer);
//        $response = $this->post(
//            route('loads.transition', [
//                'state' => 'published',
//                'load' => $this->load,
//            ]),
//        );
//        $response->assertForbidden();
//
//        // Customer service can do this
//        $response = $this
//            ->actingAs($this->customerService)
//            ->post(
//                route('loads.transition', [
//                    'state' => 'published',
//                    'load' => $this->load,
//                ]),
//            );
//        $response->assertRedirect();
//
//        $this->load->refresh();
//        $this->assertEquals('published', $this->load->state->getValue());
//
//        // @todo customer service notification would be here as well
//        // @todo matches count depending on owner accounts etc in the demo data
    }

    public function test_transition_from_accepted_to_in_transit(): void
    {
//        Notification::fake();
//
//        // Customer can't do this, even on their own load
//        $this->actingAs($this->customer);
//        $response = $this->post(
//            route('loads.transition', [
//                'state' => 'accepted',
//                'load' => $this->load,
//            ]),
//        );
//        $response->assertForbidden();
//
//        // Driver can do this
//        $response = $this
//            ->actingAs($this->customerService)
//            ->post(
//                route('loads.transition', [
//                    'state' => 'in_transit',
//                    'load' => $this->load,
//                ]),
//            );
//        $response->assertRedirect();
//
//        $this->load->refresh();
//        $this->assertEquals('published', $this->load->state->getValue());
//        // @todo customer service notification would be here as well
//        // @todo matches count depending on owner accounts etc in the demo data
    }

    public function test_transition_from_accepted_to_cancelled(): void
    {
        $this->markTestIncomplete();
    }

    public function test_transition_from_expired_to_cancelled(): void
    {
        $this->markTestIncomplete();
    }

    public function test_transition_from_expired_to_published(): void
    {
        $this->markTestIncomplete();
    }

    public function test_transition_from_in_transit_to_complete(): void
    {
        $this->markTestIncomplete();
    }

    public function test_transition_from_pending_to_cancelled(): void
    {
        $this->markTestIncomplete();
    }

    public function test_transition_from_pending_payment_to_accepted(): void
    {
        $this->markTestIncomplete();
    }

    public function test_transition_from_published_to_accepted(): void
    {
        $this->markTestIncomplete();
    }

    public function test_transition_from_published_to_cancelled(): void
    {
        $this->markTestIncomplete();
    }

    public function test_transition_from_published_to_expired(): void
    {
        $this->markTestIncomplete();
    }

    public function test_transition_from_published_to_pending_payment(): void
    {
        $this->markTestIncomplete();
    }
}