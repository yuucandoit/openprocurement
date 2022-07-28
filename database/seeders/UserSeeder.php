<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Admin Role',
            'email' => 'admin@role.test',
            'password' => bcrypt('password')
        ]);

        $admin->assignRole('admin');

        $user = User::create([
            'name' => 'User Role',
            'email' => 'user@role.test',
            'password' => bcrypt('password')
        ]);

        $user->assignRole('user');

        $super_admin = User::create([
            'name' => 'Super Admin Role',
            'email' => 'superadmin@role.test',
            'password' => bcrypt('password')
        ]);

        $super_admin->assignRole('super admin');
    }
}
