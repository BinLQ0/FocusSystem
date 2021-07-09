<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Setup Roles
        Role::create(
            ['name' => 'Administrator'],
            ['name' => 'Warehouse Staff'],
            ['name' => 'Support']
        );

        // Setup Permission
        $permissions = [
            ['name' => 'admin module'],
            ['name' => 'warehouse module'],
            ['name' => 'manufacture module'],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }

        $this->setupAdministrator($permissions);
    }

    /**
     * Method to setup administrator permissions
     */
    public function setupAdministrator(array $allowedPermissions): void
    {
        $administrator = User::firstOrCreate([
            'username' => 'admin'
        ]);

        $role_administrator = Role::where('name', 'Administrator')->first();
        $role_administrator->givePermissionTo($allowedPermissions);

        $administrator->assignRole($role_administrator);
    }
}
