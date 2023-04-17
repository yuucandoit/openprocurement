<?php

namespace App\Console\Commands;

use App\Models\CategoryPO;
use App\Models\Invoicing;
use Illuminate\Console\Command;

class poidonpayment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:poidonpayment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate po id on payment or invoicing table';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {


        // $po = CategoryPO::all();
        $invoice = Invoicing::all();

        foreach($invoice as $i){
        // $time = Invoicing::where('ppb_id',$p->ppb_id)->first();
        $po_id = CategoryPO::where('ppb_id',$i->ppb_id)->first();
        Invoicing::where('id',$i->id)->update([
                'po_id' => $po_id->id ?? null,
            ]);
        }

        echo('Success Generate Approve Time ');
        return Command::SUCCESS;
    }
}

