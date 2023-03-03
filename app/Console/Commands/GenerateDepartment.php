<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class GenerateDepartment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Department N Location Role User';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $data = User::all();

        #Aina Yohana
        User::where('id',14)->update([
            'department' => 'Accounting',
            'location'   => 'Tebet',
        ]);
         #Faisal Nursalim
         User::where('id',12)->update([
            'department' => 'Audit',
            'location'   => 'Tebet',
        ]);
         #Nicholas J Hutagaol
         User::where('id',11)->update([
            'department' => 'Business Development',
            'location'   => 'Tebet',
        ]);
        #Indah Wardani 
        User::where('id',13)->update([
            'department' => 'Finance',
            'location'   => 'Tebet',
        ]);
        #Tri Minarsih
        User::where('id',16)->update([
            'department' => 'GA',
            'location'   => 'Tebet',
        ]);
         #Eka Ayu Wulandari
         User::where('id',17)->update([
            'department' => 'HR',
            'location'   => 'Tebet',
        ]);
        #Nia Sulistiyani
        User::where('id',18)->update([
            'department' => 'HSE',
            'location'   => 'Tebet',
        ]);
        #Gunto Kunto Aji
        User::where('id',19)->update([
            'department' => 'Operational',
            'location'   => 'Cikunir',
        ]);
        #Nirma Yustina
         User::where('id',15)->update([
            'department' => 'Pajak',
            'location'   => 'Tebet',
        ]);
        #Nuryani
        User::where('id',10)->update([
            'department' => 'Project',
            'location'   => 'Tebet',
        ]);
        #Endar Suryadi
        User::where('id',20)->update([
            'department' => 'Project Manager',
            'location'   => 'Tebet',
        ]);
        #M.Firmansyah
        User::where('id',30)->update([
            'department' => 'Design',
            'location'   => 'Tebet',
        ]);
         #Eko Prasetyo
         User::where('id',31)->update([
            'department' => 'Programmer',
            'location'   => 'Cikunir',
        ]);
        #Awan Setiawan
        User::where('id',33)->update([
            'department' => 'Support',
            'location'   => 'Cikunir',
        ]);
         #Badrul Huda Mutammam
         User::where('id',34)->update([
            'department' => 'Product Engineering',
            'location'   => 'Cikunir',
        ]);
        #M. Ali Wafa
        User::where('id',35)->update([
            'department' => 'Mikro Kontroller',
            'location'   => 'Cikunir',
        ]);
        #Maulana Fakih Latief
        User::where('id',36)->update([
            'department' => 'Mekatronik',
            'location'   => 'Cikunir',
        ]);
         # Dedi Lesmana  
         User::where('id',37)->update([
            'department' => 'Manufaktur',
            'location'   => 'Cikunir',
        ]);


        echo "Command Success Update Data";
        return Command::SUCCESS;
    }
}
