<?php

namespace App\Console\Commands;

use App\Models\CategoryPengajuanPembelian;
use App\Models\CategoryPO;
use App\Models\ItemPO;
use Illuminate\Console\Command;

class GeneratePengajuanID extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pengajuanid:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Pengajuan ID di Item PO';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $data = ItemPO::all();


        foreach($data as $d){
        $po = CategoryPO::where('id',$d->po_id)->get();

        foreach($po as $p){
            ItemPO::where('id',$d->id)->update([
                'ppb_id' => $p->ppb_id,
            ]);
        }

        }

        return Command::SUCCESS;
    }
}
