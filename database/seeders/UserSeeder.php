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
            'email' => 'sindu@bod.com',
            'password' => bcrypt('superuser1;')
        ]);

        $super_user->assignRole('super user');

        // #7
        $super_user = User::create([
            'name' => 'Bayu Nugraha',
            'email' => 'bayu@bod.com',
            'password' => bcrypt('superuser2;')
        ]);

        $super_user->assignRole('super user');

        // #8
        $super_user = User::create([
            'name' => 'Victor',
            'email' => 'victor@bod.com',
            'password' => bcrypt('superuser3;')
        ]);

        $super_user->assignRole('super user');

        // #9
        $super_user = User::create([
            'name' => 'Erwin Danuaji',
            'email' => 'erwin@bod.com',
            'password' => bcrypt('superuser4;')
        ]);

        $super_user->assignRole('super user');

        // #10
        $user = User::create([
            'name' => 'Nuryani',
            'email' => 'nuryani@solusi.com',
            'password' => bcrypt('password1;')
        ]);

        $user->assignRole('user');

         // #10
         $user = User::create([
            'name' => 'Nicholas J Hutagaol',
            'email' => 'nicholas@solusi.com',
            'password' => bcrypt('password2;')
        ]);

        $user->assignRole('user');

         // #11
         $user = User::create([
            'name' => 'Faisal Nursalim',
            'email' => 'faisal@solusi.com',
            'password' => bcrypt('password3;')
        ]);

        $user->assignRole('user');

        // #12
        $user = User::create([
            'name' => 'Indah Wardani',
            'email' => 'indah@solusi.com',
            'password' => bcrypt('password4;')
        ]);

        $user->assignRole('user');
        // #13
        $user = User::create([
            'name' => 'Aina Yohana',
            'email' => 'aina@solusi.com',
            'password' => bcrypt('password5;')
        ]);

        $user->assignRole('user');
        // #14
        $user = User::create([
            'name' => 'Nirma Yustina',
            'email' => 'nirma@solusi.com',
            'password' => bcrypt('password6;')
        ]);

        $user->assignRole('user');
        // #15
        $user = User::create([
            'name' => 'Tri Minarsih',
            'email' => 'triminarsih@solusi.com',
            'password' => bcrypt('password7;')
        ]);

        $user->assignRole('user');
        // #16
        $user = User::create([
            'name' => 'Eka Ayu Wulandari',
            'email' => 'eka@solusi.com',
            'password' => bcrypt('password8;')
        ]);

        $user->assignRole('user');
        // #17
        $user = User::create([
            'name' => 'Nia Sulistiyani',
            'email' => 'nia@solusi.com',
            'password' => bcrypt('password9;')
        ]);

        $user->assignRole('user');
        // #18
        $user = User::create([
            'name' => 'Gunto Kunto Aji',
            'email' => 'kuntoaji@solusi.com',
            'password' => bcrypt('password10;')
        ]);

        $user->assignRole('user');
        // #19
        $user = User::create([
            'name' => 'Endar Suryadi',
            'email' => 'endar@solusi.com',
            'password' => bcrypt('password11;')
        ]);

        $user->assignRole('user');

       // #20
       $purchasing = User::create([
        'name' => 'Mutiara Nurhasyyati',
        'email' => 'mutiara@purchase.com',
        'password' => bcrypt('purchase1;')
        ]);

        $purchasing->assignRole('purchasing');

         // #21
       $purchasing = User::create([
        'name' => 'Fandy B Mustofa',
        'email' => 'fandy@purchase.com',
        'password' => bcrypt('purchase2;')
        ]);

        $purchasing->assignRole('purchasing');

         // #22
       $purchasing = User::create([
        'name' => 'Ervina Nursafitri',
        'email' => 'ervina@purchase.com',
        'password' => bcrypt('purchase3;')
        ]);

        $purchasing->assignRole('purchasing');

         // #23
         $super_admin = User::create([
            'name' => 'Triyani',
            'email' => 'triyani@super.admin',
            'password' => bcrypt('superadmin2;')
        ]);

    }
}
