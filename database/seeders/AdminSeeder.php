<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $admin= Admin::create([
            'name' => 'SuperAdmin',
            'email' => 'email@admin.com',
            'password' => Hash::make(12345),
            'type'=>'SuperAdmin',
        ]);
             $admin->assignRole(Role::findByName('Super-Admin', 'admin'));

    }
}
