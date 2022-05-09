<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\City;
use App\Models\Admin;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call([
            PermissionSeeder::class,
            RoleSeeder::class,
        CitySeeder::class,
        AdminSeeder::class,

        ]);

        // Permission::create(['name' => 'Read-Users', 'guard_name' => 'user-api']);
        // Permission::create(['name' => 'Read-Cities', 'guard_name' => 'user-api']);
    }
}
