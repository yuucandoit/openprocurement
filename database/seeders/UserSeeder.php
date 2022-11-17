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
        // #1
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@role.test',
            'password' => bcrypt('password')
        ]);

        $admin->assignRole('admin');

        // #2
        $user = User::create([
            'name' => 'User',
            'email' => 'user@role.test',
            'password' => bcrypt('password')
        ]);

        $user->assignRole('user');

        // #3
        $super_admin = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@role.test',
            'password' => bcrypt('password')
        ]);

        $super_admin->assignRole('super admin');

        // #4
        $purchasing = User::create([
            'name' => 'Purchasing',
            'email' => 'purchasing@role.test',
            'password' => bcrypt('password')
        ]);

        $purchasing->assignRole('purchasing');

        // #5
        $finance = User::create([
            'name' => 'Finance',
            'email' => 'finance@role.test',
            'password' => bcrypt('password')
        ]);

        $finance->assignRole('finance');

        // #6
        $super_user = User::create([
            'name' => 'Sindu Irawan',
            'email' => 'sindu@role.test',
            'password' => bcrypt('password')
        ]);

        $super_user->assignRole('super user');

        // #7
        $super_user = User::create([
            'name' => 'Bayu Nugraha',
            'email' => 'bayu@role.test',
            'password' => bcrypt('password')
        ]);

        $super_user->assignRole('super user');

        // #8
        $super_user = User::create([
            'name' => 'Victor',
            'email' => 'victor@role.test',
            'password' => bcrypt('password')
        ]);

        $super_user->assignRole('super user');

        // #9
        $super_user = User::create([
            'name' => 'Erwindanuaji',
            'email' => 'erwin@role.test',
            'password' => bcrypt('password')
        ]);

        $super_user->assignRole('super user');

        // #10
        $user = User::create([
            'name' => 'Brian',
            'email' => 'brian@solusi.com',
            'password' => bcrypt('password')
        ]);

        $user->assignRole('user');
    }
}
