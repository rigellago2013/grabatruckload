<?php

namespace Tests;

use App\Console\Commands\CreateRolesAndPermissions;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    // Location helpers
    public function inDavao(): void
    {
    }

    public function setUp(): void
    {
        parent::setUp();

        $this->artisan(CreateRolesAndPermissions::class);

        $this->app->make(\Spatie\Permission\PermissionRegistrar::class)->registerPermissions();
    }
}
