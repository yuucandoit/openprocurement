<?php

namespace App\Console\Commands;

use App\Models\CategoryPO;
use Illuminate\Console\Command;

class GenerateNewStatus extends Command
{
    protected $signature = 'new:status';

    protected $description = 'Update PO Approved To PO & Payment Approved';

    public function handle()
    {
        $data = CategoryPO::where('status','PO Approved')->get();

        foreach($data as $s){
            CategoryPO::where('id',$s->id)->update([
                'status' => 'PO & Payment Approved'
            ]);
        }

        echo "Command Success Update Data Status";

        return Command::SUCCESS;
    }
}
