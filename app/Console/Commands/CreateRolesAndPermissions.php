<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateRolesAndPermissions extends Command
{
    protected $signature = 'permissions:create';
    protected $description = 'Create the roles and permissions in the system';

    public function handle()
    {
        $admin = Role::findOrCreate('admin');
        $customer = Role::findOrCreate('customer');
        $customerReadOnly = Role::findOrCreate('customer-read-only');
        $owner = Role::findOrCreate('owner');
        $ownerReadOnly = Role::findOrCreate('owner-read-only');
        $ownerEditor = Role::findOrCreate('owner-editor');
        $driver = Role::findOrCreate('driver');

        // Internal
        $customerService = Role::findOrCreate('customer-service');

        $loadCreate = Permission::findOrCreate('load:create');
        $loadRead = Permission::findOrCreate('load:read');
        $loadUpdate = Permission::findOrCreate('load:update');
        $loadDelete = Permission::findOrCreate('load:delete');
        $loadConfirm = Permission::findOrCreate('load:confirm');
        $loadComplete = Permission::findOrCreate('load:complete');
        $loadPublish = Permission::findOrCreate('load:publish');
        $vehicleRead = Permission::findOrCreate('vehicle:read');
        $vehicleCreate = Permission::findOrCreate('vehicle:create');
        $vehicleUpdate = Permission::findOrCreate('vehicle:update');
        $vehicleDelete = Permission::findOrCreate('vehicle:delete');
        $routeRead = Permission::findOrCreate('route:read');
        $routeCreate = Permission::findOrCreate('route:create');
        $routeUpdate = Permission::findOrCreate('route:update');
        $routeDelete = Permission::findOrCreate('route:delete');

        $admin->givePermissionTo($loadCreate);
        $admin->givePermissionTo($loadRead);
        $admin->givePermissionTo($loadUpdate);
        $admin->givePermissionTo($loadDelete);
        $admin->givePermissionTo($loadConfirm);
        $admin->givePermissionTo($loadComplete);
        $admin->givePermissionTo($loadPublish);
        $admin->givePermissionTo($vehicleCreate);
        $admin->givePermissionTo($vehicleRead);
        $admin->givePermissionTo($vehicleUpdate);
        $admin->givePermissionTo($vehicleDelete);
        $admin->givePermissionTo($routeRead);
        $admin->givePermissionTo($routeCreate);
        $admin->givePermissionTo($routeUpdate);
        $admin->givePermissionTo($routeDelete);

        $customerService->givePermissionTo($loadCreate);
        $customerService->givePermissionTo($loadRead);
        $customerService->givePermissionTo($loadUpdate);
        $customerService->givePermissionTo($loadConfirm);
        $customerService->givePermissionTo($loadComplete);
        $customerService->givePermissionTo($loadPublish);
        $customerService->givePermissionTo($vehicleCreate);
        $customerService->givePermissionTo($vehicleRead);
        $customerService->givePermissionTo($vehicleUpdate);
        $customerService->givePermissionTo($routeRead);
        $customerService->givePermissionTo($routeCreate);
        $customerService->givePermissionTo($routeUpdate);

        $customer->givePermissionTo($loadCreate);
        $customer->givePermissionTo($loadRead);
        $customer->givePermissionTo($loadUpdate);
        $customer->givePermissionTo($loadUpdate);

        $customerReadOnly->givePermissionTo($loadRead);

        $owner->givePermissionTo($vehicleCreate);
        $owner->givePermissionTo($vehicleRead);
        $owner->givePermissionTo($vehicleUpdate);
        $owner->givePermissionTo($routeRead);
        $owner->givePermissionTo($routeCreate);
        $owner->givePermissionTo($routeUpdate);
        $owner->givePermissionTo($routeDelete);

        $ownerReadOnly->givePermissionTo($vehicleRead);
        $ownerReadOnly->givePermissionTo($routeRead);

        $ownerEditor->givePermissionTo($vehicleCreate);
        $ownerEditor->givePermissionTo($vehicleRead);
        $ownerEditor->givePermissionTo($vehicleUpdate);
        $ownerEditor->givePermissionTo($routeRead);
        $ownerEditor->givePermissionTo($routeCreate);
        $ownerEditor->givePermissionTo($routeUpdate);

        $driver->givePermissionTo($loadConfirm);
        $driver->givePermissionTo($loadComplete);

        return 0;
    }
}
