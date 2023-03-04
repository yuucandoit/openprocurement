<?php

namespace Database\Seeders;

use App\Models\CategoryPO;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(SubmissionSeeder::class);
        $this->call(VendorSeeder::class);
        $this->call(CategoryPO::class);
    }
}
