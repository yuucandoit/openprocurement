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
            'name' => 'Business Development'
        ]);
        WhoSubmitted::create([
            'name' => 'Finance'
        ]);
        WhoSubmitted::create([
            'name' => 'GA'
        ]);
        WhoSubmitted::create([
            'name' => 'Human Resource'
        ]);
        WhoSubmitted::create([
            'name' => 'Legal'
        ]);
        WhoSubmitted::create([
            'name' => 'Programmer'
        ]);
        WhoSubmitted::create([
            'name' => 'Project'
        ]);
        WhoSubmitted::create([
            'name' => 'Product'
        ]);
        WhoSubmitted::create([
            'name' => 'Production'
        ]);
        WhoSubmitted::create([
            'name' => 'Purchasing'
        ]);
        WhoSubmitted::create([
            'name' => 'R&D'
        ]);
        WhoSubmitted::create([
            'name' => 'Support Workshop'
        ]);
        WhoSubmitted::create([
            'name' => 'Tax'
        ]);
        // End Who Submitted


        // Start Referensi Project

        ReferensiNamaProject::create([
            'name' => 'Next-G 2023'
        ]);
        ReferensiNamaProject::create([
            'name' => 'WB 2023'
        ]);
        ReferensiNamaProject::create([
            'name' => 'Stromz 2023'
        ]);

        //End Referensi Project

        // Start Department

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
            'name' => 'Human Resource'
        ]);
        Department::create([
            'name' => 'Legal'
        ]);
        Department::create([
            'name' => 'Programmer'
        ]);
        Department::create([
            'name' => 'Project'
        ]);
        Department::create([
            'name' => 'Product'
        ]);
        Department::create([
            'name' => 'Production'
        ]);
        Department::create([
            'name' => 'Purchasing'
        ]);
        Department::create([
            'name' => 'R&D'
        ]);
        Department::create([
            'name' => 'Support Workshop'
        ]);
        Department::create([
            'name' => 'Tax'
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
