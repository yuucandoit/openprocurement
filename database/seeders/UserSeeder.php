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
            'name' => 'Admin',
            'email' => 'admin@role.test',
            'password' => bcrypt('password')
        ]);

        $admin->assignRole('admin');

        $user = User::create([
            'name' => 'User',
            'email' => 'user@role.test',
            'password' => bcrypt('password')
        ]);

        $user->assignRole('user');

        $super_admin = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@role.test',
            'password' => bcrypt('password')
        ]);

        $super_admin->assignRole('super admin');

        $purchasing = User::create([
            'name' => 'Purchasing',
            'email' => 'purchasing@role.test',
            'password' => bcrypt('password')
        ]);

        $purchasing->assignRole('purchasing');

        $finance = User::create([
            'name' => 'Finance',
            'email' => 'finance@role.test',
            'password' => bcrypt('password')
        ]);

        $finance->assignRole('finance');

        $super_user = User::create([
            'name' => 'Sindu Irawan',
            'email' => 'sindu@role.test',
            'password' => bcrypt('password')
        ]);

        $super_user->assignRole('super user');

        $super_user = User::create([
            'name' => 'Bayu',
            'email' => 'bayu@role.test',
            'password' => bcrypt('password')
        ]);

        $super_user->assignRole('super user');
    }
}
