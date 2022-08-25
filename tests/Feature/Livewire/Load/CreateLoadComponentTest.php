<?php

namespace Tests\Feature\Livewire\Load;

use App\Http\Livewire\Loads\CreateLoadComponent;
use App\Models\Load;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire;
use Tests\TestCase;

class CreateLoadComponentTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_contains_livewire_component(): void
    {
        $this->actingAs(User::factory()->withRole('admin')->create())
            ->get('/loads/create')
            ->assertSeeLivewire('loads.create-load-component');
    }

    // 1. test complete form 1 with valid data
    // set properties, check
    // call createLoad
    // check load is in database
    // check get redirected to step 2
    public function test_it_can_create_a_load(): void
    {
        $user = User::factory()
            ->withRole('admin')
            ->create();

        $this->actingAs($user);

        Storage::fake('local');

        $image = UploadedFile::fake()->create('image', 1000, 'jpg');
        $file = UploadedFile::fake()->create('doc', 1000, 'pdf');

        Livewire::test(
            CreateLoadComponent::class,
            [
                'loadType' => 'refrigerated',
                'noOfItems' => 2,
                'weight' => 12,
                'volume' => 1.5,
                'description' => 'test description',
            //                'images' => [$image], these are causing an error - need to work out why
            //                'files' => [$file],
            ]
        )->call('createLoad')
        ->assertRedirect(route(
            'loads.update-pickup-details',
            ['load' => Load::where('description', 'test description')->firstOrFail()]
        ));

        $this->assertTrue(Load::where('description', 'test description')->exists());
    }

    // 2. test complete form 1 with invalid data
    // check for validation errors
    public function test_it_can_not_create_a_load_with_invalid_data(): void
    {
        $user = User::factory()->withRole('admin')->create();
        $this->actingAs($user);

        Livewire::test(CreateLoadComponent::class)
            ->set('loadType', '')
            ->set('noOfItems', -1)
            ->set('weight', 0)
            ->set('volume', 0)
            ->set('description', '')
            ->assertHasErrors(['loadType', 'noOfItems', 'weight', 'volume', 'description']);
    }

    // 7. check which user roles can create a load
    public function test_admin_can_create_load(): void
    {
        $user = User::factory()->withRole('admin')->create();
        $user->givePermissionTo('load:create');
        $this->actingAs($user);

        Livewire::test(
            CreateLoadComponent::class,
            [
                'loadType' => 'refrigerated',
                'noOfItems' => 2,
                'weight' => 12,
                'volume' => 1.5,
                'description' => 'test description admin',
            ]
        )->call('createLoad')
        ->assertRedirect(route(
            'loads.update-pickup-details',
            ['load' => Load::where('description', 'test description admin')->firstOrFail()]
        ));

        $this->assertTrue(Load::where('description', 'test description admin')->exists());
    }

    public function test_customer_can_create_load(): void
    {
        $user = User::factory()->withRole('customer')->create();
        $user->givePermissionTo('load:create');
        $this->actingAs($user);

        Livewire::test(
            CreateLoadComponent::class,
            [
                'loadType' => 'refrigerated',
                'noOfItems' => 2,
                'weight' => 12,
                'volume' => 1.5,
                'description' => 'test description customer',
            ]
        )->call('createLoad')
        ->assertRedirect(route(
            'loads.update-pickup-details',
            ['load' => Load::where('description', 'test description customer')->firstOrFail()]
        ));

        $this->assertTrue(Load::where('description', 'test description customer')->exists());
    }

    public function test_owner_can_create_load(): void
    {
        $user = User::factory()->withRole('owner')->create();
        $user->givePermissionTo('load:create');
        $this->actingAs($user);

        Livewire::test(
            CreateLoadComponent::class,
            [
                'loadType' => 'refrigerated',
                'noOfItems' => 2,
                'weight' => 12,
                'volume' => 1.5,
                'description' => 'test description owner',
            ]
        )->call('createLoad')
        ->assertRedirect(route(
            'loads.update-pickup-details',
            ['load' => Load::where('description', 'test description owner')->firstOrFail()]
        ));

        $this->assertDatabaseHas('loads', ['description' => 'test description owner']);
    }

    public function test_driver_can_create_load(): void
    {
        $user = User::factory()->withRole('driver')->create();
        // $user->givePermissionTo('load:create');
        $this->actingAs($user);

        Livewire::test(
            CreateLoadComponent::class,
            [
                'loadType' => 'refrigerated',
                'noOfItems' => 2,
                'weight' => 12,
                'volume' => 1.5,
                'description' => 'test description driver',
            ]
        )->call('createLoad')
        ->assertRedirect(route(
            'loads.update-pickup-details',
            ['load' => Load::where('description', 'test description driver')->firstOrFail()]
        ));

        $this->assertTrue(Load::where('description', 'test description driver')->exists());
    }

    //8. confirm other user roles can not access create load page, or update a load
    public function test_admin_can_access_create_load_page(): void
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->withRole('admin')->create();
        $response = $this->actingAs($user)->get('/loads/create');
        $response->assertStatus(200);
    }

    public function test_customer_can_access_create_load_page(): void
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->withRole('customer')->create();
        $response = $this->actingAs($user)->get('/loads/create');
        $response->assertStatus(200);
    }

    public function test_driver_can_not_access_create_load_page(): void
    {
        $user = User::factory()->withRole('driver')->create();
        $response = $this->actingAs($user)->get('/loads/create');
        $response->assertStatus(403);
    }

    public function test_owner_can_not_access_create_load_page(): void
    {
        $user = User::factory()->withRole('owner')->create();
        $response = $this->actingAs($user)->get('/loads/create');
        $response->assertStatus(403);
    }
}
