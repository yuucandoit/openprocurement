<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'admin',
            'guard_name' => 'web',
        ]);
        Role::create([
            'name' => 'user',
            'guard_name' => 'web',
        ]);
        Role::create([
            'name' => 'super admin',
            'guard_name' => 'web',
        ]);
        Role::create([
            'name' => 'purchasing',
            'guard_name' => 'web',
        ]);
        Role::create([
            'name' => 'finance',
            'guard_name' => 'web',
        ]);
    }
}
