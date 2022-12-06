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
            'email' => 'sindu@intek.co.id',
            'password' => bcrypt('superuser1;')
        ]);

        $super_user->assignRole('super user');

        // #7
        $super_user = User::create([
            'name' => 'Bayu Nugraha',
            'email' => 'bayu@intek.co.id',
            'password' => bcrypt('superuser2;')
        ]);

        $super_user->assignRole('super user');

        // #8
        $super_user = User::create([
            'name' => 'Victor',
            'email' => 'victor@intek.co.id',
            'password' => bcrypt('superuser3;')
        ]);

        $super_user->assignRole('super user');

        // #9
        $super_user = User::create([
            'name' => 'Erwin Danuaji',
            'email' => 'erwin@intek.co.id',
            'password' => bcrypt('superuser4;')
        ]);

        $super_user->assignRole('super user');

        // #10
        $user = User::create([
            'name' => 'Nuryani',
            'email' => 'nuryani@intek.co.id',
            'password' => bcrypt('password1;')
        ]);

        $user->assignRole('user');

         // #10
         $user = User::create([
            'name' => 'Nicholas J Hutagaol',
            'email' => 'nicholas@intek.co.id',
            'password' => bcrypt('password2;')
        ]);

        $user->assignRole('user');

         // #11
         $user = User::create([
            'name' => 'Faisal Nursalim',
            'email' => 'faisal@intek.co.id',
            'password' => bcrypt('password3;')
        ]);

        $user->assignRole('user');

        // #12
        $user = User::create([
            'name' => 'Indah Wardani',
            'email' => 'indah@intek.co.id',
            'password' => bcrypt('password4;')
        ]);

        $user->assignRole('user');
        // #13
        $user = User::create([
            'name' => 'Aina Yohana',
            'email' => 'ainayohana@intek.co.id',
            'password' => bcrypt('password5;')
        ]);

        $user->assignRole('user');
        // #14
        $user = User::create([
            'name' => 'Nirma Yustina',
            'email' => 'nirmayustina@intek.co.id',
            'password' => bcrypt('password6;')
        ]);

        $user->assignRole('user');
        // #15
        $user = User::create([
            'name' => 'Tri Minarsih',
            'email' => 'triminarsih@intek.co.id',
            'password' => bcrypt('password7;')
        ]);

        $user->assignRole('user');
        // #16
        $user = User::create([
            'name' => 'Eka Ayu Wulandari',
            'email' => 'ayu@intek.co.id',
            'password' => bcrypt('password8;')
        ]);

        $user->assignRole('user');
        // #17
        $user = User::create([
            'name' => 'Nia Sulistiyani',
            'email' => 'nia@intek.co.id',
            'password' => bcrypt('password9;')
        ]);

        $user->assignRole('user');
        // #18
        $user = User::create([
            'name' => 'Gunto Kunto Aji',
            'email' => 'kuntoaji@intek.co.id',
            'password' => bcrypt('password10;')
        ]);

        $user->assignRole('user');
        // #19
        $user = User::create([
            'name' => 'Endar Suryadi',
            'email' => 'endar@intek.co.id',
            'password' => bcrypt('password11;')
        ]);

        $user->assignRole('user');

       // #20
       $purchasing = User::create([
        'name' => 'Mutiara Nurhasyyati',
        'email' => 'mutiaranur@intek.co.id',
        'password' => bcrypt('purchase1;')
        ]);

        $purchasing->assignRole('purchasing');

         // #21
       $purchasing = User::create([
        'name' => 'Fandy B Mustofa',
        'email' => 'fandy@intek.co.id',
        'password' => bcrypt('purchase2;')
        ]);

        $purchasing->assignRole('purchasing');

         // #22
       $purchasing = User::create([
        'name' => 'Ervina Nursafitri',
        'email' => 'ervina@intek.co.id',
        'password' => bcrypt('purchase3;')
        ]);

        $purchasing->assignRole('purchasing');

         // #23
         $super_admin = User::create([
            'name' => 'Triyani',
            'email' => 'triyani.acc@intek.co.id',
            'password' => bcrypt('superadmin2;')
        ]);

        $super_admin->assignRole('super admin');

        // #5
        $finance = User::create([
            'name' => 'Yuli Karliani',
            'email' => 'yuli@intek.co.id',
            'password' => bcrypt('finance1;')
        ]);

        $finance->assignRole('finance');
    }
}
