<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Inventory;
use App\Models\Office;
use App\Models\ReferensiNamaProject;
use App\Models\RND;
use App\Models\WhoSubmitted;
use App\Models\Workshop;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubmissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Who Submitted
        WhoSubmitted::create([
            'name' => 'Aina Yohana'
        ]);
        WhoSubmitted::create([
            'name' => 'Faisal Nursalim'
        ]);
        WhoSubmitted::create([
            'name' => 'Nicholas J Hutagaol'
        ]);
        WhoSubmitted::create([
            'name' => 'Indah Wardani'
        ]);
        WhoSubmitted::create([
            'name' => 'Tri Minarsih'
        ]);
        WhoSubmitted::create([
            'name' => 'Eka Ayu Wulandari'
        ]);
        WhoSubmitted::create([
            'name' => 'Nia Sulistiyani'
        ]);
        WhoSubmitted::create([
            'name' => 'Gunto Kunto Aji'
        ]);
        WhoSubmitted::create([
            'name' => 'Nirma Yustina'
        ]);
        WhoSubmitted::create([
            'name' => 'Nuryani'
        ]);
        WhoSubmitted::create([
            'name' => 'Endar Suryadi'
        ]);
        // End Who Submitted



        //End Referensi Project

        // Start Department

        Department::create([
            'name' => 'Accounting'
        ]);
        Department::create([
            'name' => 'Audit'
        ]);
        Department::create([
            'name' => 'GA'
        ]);
        Department::create([
            'name' => 'Business Development'
        ]);
        Department::create([
            'name' => 'Finance'
        ]);
        Department::create([
            'name' => 'GA'
        ]);
        Department::create([
            'name' => 'HR'
        ]);
        Department::create([
            'name' => 'HSE'
        ]);
        Department::create([
            'name' => 'Operational'
        ]);
        Department::create([
            'name' => 'Pajak'
        ]);
        Department::create([
            'name' => 'Project'
        ]);
        Department::create([
            'name' => 'Project Manager'
        ]);

        //End

        //Office
        Office::create([
            'name' => 'Test Office'
        ]);
        //End

        //Workshop
        Workshop::create([
            'name' => 'Test Workshop'
        ]);
        //End

        //Inventory
        Inventory::create([
            'name' => 'Test Inventory'
        ]);
        //End

        //R&D
        RND::create([
            'name' => 'Test RND'
        ]);
        //End

    }
}
//Business Development
// Finance
// GA
// Human Resource
// Legal
// Programmer
// Project
// Product
// Production
// Purchasing
// R&D
// Support Workshop
// Tax
