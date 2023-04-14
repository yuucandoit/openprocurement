<?php

namespace App\Console\Commands;

use App\Models\CategoryPengajuanPembelian;
use App\Models\CategoryPO;
use Illuminate\Console\Command;

class Generate_atasan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:atasan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Atasan id from table category_pengajuan_pembelian to category_po';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $ppb = CategoryPengajuanPembelian::all();
        $po  = CategoryPO::all();

        foreach($po as $p){
            CategoryPO::where('id',$p->id)->update([
                'atasan_po' => $p->ppb->atasan_po,
                'atasan_py' => $p->ppb->atasan_py,
            ]);
        }
        print_r("Success Generate Atasan CategoryPO");
        return Command::SUCCESS;
    }
}
