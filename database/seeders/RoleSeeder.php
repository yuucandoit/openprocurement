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
        //#1
        Role::create([
            'name' => 'admin',
            'guard_name' => 'web',
        ]);
        //#2
        Role::create([
            'name' => 'user',
            'guard_name' => 'web',
        ]);
        //#3
        Role::create([
            'name' => 'super admin',
            'guard_name' => 'web',
        ]);
        //#4
        Role::create([
            'name' => 'purchasing',
            'guard_name' => 'web',
        ]);
        //#5
        Role::create([
            'name' => 'finance',
            'guard_name' => 'web',
        ]);
        //#6
        Role::create([
            'name' => 'super user',
            'guard_name' => 'web',
        ]);
        //#7
        Role::create([
            'name' => 'R&D',
            'guard_name' => 'web',
        ]);
        //#8
        Role::create([
            'name' => 'production',
            'guard_name' => 'web',
        ]);
        //#9
        Role::create([
            'name' => 'support workshop',
            'guard_name' => 'web',
        ]);
        //#10
        Role::create([
            'name' => 'project',
            'guard_name' => 'web',
        ]);
        //#11
        Role::create([
            'name' => 'business development',
            'guard_name' => 'web',
        ]);
        //#12
        Role::create([
            'name' => 'product',
            'guard_name' => 'web',
        ]);
        //#13
        Role::create([
            'name' => 'tax',
            'guard_name' => 'web',
        ]);
        //#14
        Role::create([
            'name' => 'Human Resource',
            'guard_name' => 'web',
        ]);
        //#15
        Role::create([
            'name' => 'GA',
            'guard_name' => 'web',
        ]);
        //#16
        Role::create([
            'name' => 'legal',
            'guard_name' => 'web',
        ]);
    }
}
