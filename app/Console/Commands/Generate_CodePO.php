<?php

namespace App\Console\Commands;

use App\Models\CategoryPengajuanPembelian;
use App\Models\CategoryPO;
use App\Models\Invoicing;
use Carbon\Carbon;
use Illuminate\Console\Command;

class Generate_CodePO extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'code:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $data = CategoryPO::all();
        $datappb = CategoryPengajuanPembelian::all();
        $datapd = Invoicing::all();


        foreach ($data as $d) {
            $year = Carbon::parse($d->created_at)->format('y');
            $month = Carbon::parse($d->created_at)->format('m');
            $po_id = str_pad($d->id,5,'0', STR_PAD_LEFT);
            $generate =  strtoupper($po_id."/PO/SII/".$month."/".$year);
            CategoryPO::where('id',$d->id)->update([
                'code_po' => $generate,
            ]);
        }

        foreach($datappb as $ppb) {
            $year = Carbon::parse($ppb->created_at)->format('y');
            $month = Carbon::parse($ppb->created_at)->format('m');
            $ppb_id = str_pad($ppb->id,5,'0', STR_PAD_LEFT);
            $generateppb = strtoupper($ppb_id."/PPB/SII/".$month."/".$year);
            CategoryPengajuanPembelian::where('id',$ppb->id)->update([
                'code_pengajuan' => $generateppb,
            ]);
        }

        foreach($datapd as $pd) {
            $year = Carbon::parse($pd->created_at)->format('y');
            $month = Carbon::parse($pd->created_at)->format('m');
            $pd_id = str_pad($pd->id,5,'0', STR_PAD_LEFT);
            $generatepd = strtoupper($pd_id."/PD/SII/".$month."/".$year);
            Invoicing::where('id',$pd->id)->update([
                'code_pd' => $generatepd,
            ]);
        }
        echo "Command Success Update All data";
        return Command::SUCCESS;
    }
}
