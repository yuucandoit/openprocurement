<?php

namespace App\Console\Commands;

use App\Models\CategoryPO;
use Illuminate\Console\Command;

class GenerateStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'status:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the previously empty status';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $data = CategoryPO::all();

        foreach($data as $s) {
            if($s->ppb->status == "Purchase Proses") {
                CategoryPO::where('id',$s->id)->update([
                    'status' => 'Purchase Proses'
                ]);
            } elseif($s->ppb->status == "Cross Check PO"){
                CategoryPO::where('id', $s->id)->update([
                    'status' => 'Cross Check PO'
                ]);
            } elseif($s->ppb->status == "Waiting For PO Approval"){
                CategoryPO::where('id',$s->id)->update([
                    'status' => 'Waiting For PO Approval'
                ]);
            } elseif($s->ppb->status == "PO Approved"){
                CategoryPO::where('id',$s->id)->update([
                    'status' => 'PO Approved'
                ]);
            } elseif($s->ppb->status == "Invoicing Process"){
                CategoryPO::where('id',$s->id)->update([
                    'status' => 'Invoicing Process'
                ]);
            } elseif($s->ppb->status == "Payment Approved"){
                CategoryPO::where('id',$s->id)->update([
                    'status' => 'Payment Approved'
                ]);
            } elseif($s->ppb->status == "Unpaid"){
                CategoryPO::where('id',$s->id)->update([
                    'status' => 'Unpaid'
                ]);
            } elseif($s->ppb->status == "Paid"){
                CategoryPO::where('id',$s->id)->update([
                    'status' => 'Paid'
                ]);
            } elseif($s->ppb->status == "Delivery Success"){
                CategoryPO::where('id',$s->id)->update([
                    'status' => 'Delivery Success'
                ]);
            }
        }

        echo "Command Success Update Data Status";
        return Command::SUCCESS;
    }
}
