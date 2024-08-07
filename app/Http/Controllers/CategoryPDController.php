<?php

namespace App\Http\Controllers;

use App\Models\CategoryEcommerce;
use App\Models\CategoryPD;
use App\Models\CategoryPengajuanPembelian;
use App\Models\CategoryPO;
use App\Models\CategoryPP;
use App\Models\CategoryPT;
use App\Models\Comment;
use App\Models\Department;
use App\Models\Invoicing;
use App\Models\ItemPO;
use App\Models\PengajuanPembelian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use App\Models\WhoSubmitted;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class CategoryPDController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $check = Role::where('model_id', Auth::user()->id)->first();
        if ($check->role_id == 5) {
            $datappb = CategoryPengajuanPembelian::whereHas('quot',function($i){
                $i->where('status','Unpaid');
            })->where('status', 'not like', '%Rejected%')->orderBy('status', 'asc')->orderBy('dateline', 'asc')->orderBy('approved_at','asc')->paginate(10, ['*'],'in');
            return view('pengajuanDana.menu.index')
                ->with('datappb',$datappb);
        } else if ($check->role_id == 3 || $check->role_id == 5 || $check->role_id == 2) {
            $datappb = CategoryPengajuanPembelian::whereHas('quot',function($i){
                $i->where('status','Unpaid');
            })->where('status', 'not like', '%Rejected%')->orderBy('status', 'asc')->orderBy('dateline', 'asc')->orderBy('approved_at','asc')->paginate(10, ['*'],'in');
            return view('pengajuanDana.menu.index')
            ->with('datappb',$datappb);
        }
    }

    public function po_detail($id)
    {
        $pengajuan          = PengajuanPembelian::where('pp_id', $id)->get();
        $datacpo            = CategoryPO::where('id', $id)->first();
        $dpp                = PengajuanPembelian::selectRaw('pp_id,SUM(total) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $ppn                = PengajuanPembelian::selectRaw('pp_id,SUM(total *11/100) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $total              = PengajuanPembelian::selectRaw('pp_id,SUM((total)+(total*11/100)) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $total_tnpa_ppn     = PengajuanPembelian::selectRaw('pp_id,SUM(total) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $comments           = Comment::where('ppb_id',$id)->get();
        $disc               = PengajuanPembelian::where('pp_id',$id)->first();
        //dd($datacpo);
        return view('pengajuanDana.menu.po')
            ->with('pengajuan', $pengajuan)
            ->with('dpp', $dpp)
            ->with('datacpo', $datacpo)
            ->with('ppn', $ppn)
            ->with('total', $total)
            ->with('total_tnpa_ppn', $total_tnpa_ppn)
            ->with('disc', $disc)
            ->with('comments', $comments);
    }

    public function SearchPDIn(Request $request)
    {
     $cari = $request->cariIn;
     //dd($cari);
     $datappb = CategoryPengajuanPembelian::where(function($query) use ($cari) {
        $query->whereHas('quot', function($q) {
                $q->where('status', 'Unpaid');
            })
            ->where('status', 'not like', '%Rejected%')
            ->where(function($q) use ($cari) {
                $q->where('id', 'like', "%" . $cari . "%")
                    ->orWhere('status', 'like', "%" . $cari . "%")
                    ->orWhere('desc', 'like', "%" . $cari . "%")
                    ->orWhere('code_pengajuan', 'like', "%" . $cari . "%")
                    ->orWhereHas('whosubmit', function($q) use ($cari) {
                        $q->where('name', 'like', "%" . $cari . "%");
                    })
                    ->orWhereHas('itemppn', function($q) use ($cari) {
                        $q->where('item', 'like', "%" . $cari . "%");
                    })
                    ->orWhereHas('quot', function($q) use ($cari) {
                        $q->where('id', 'like', "%" . $cari . "%")
                        ->orWhere('code_po', 'like', "%" . $cari . "%");
                    });
            });
        })->paginate(10, ['*'], 'in');
        return view('pengajuanDana.menu.index')
        ->with('datappb',$datappb);
    }

    public function out()
    {
        $check = Role::where('model_id', Auth::user()->id)->first();
        if ($check->role_id == 5 || $check->role_id == 3) {
            $datappb = CategoryPengajuanPembelian::whereHas('quot',function($i){
                $i->where('status','Paid');
            })->orderBy('status', 'asc')->orderBy('dateline', 'asc')->orderBy('approved_at','asc')->paginate(10, ['*'],'out');
            $pt = CategoryPT::all();
            $op = CategoryPP::all();
            $ec = CategoryEcommerce::all();
            $datapo = CategoryPO::all();
            return view('pengajuanDana.menu.out')
                ->with('pt',$pt)
                ->with('op',$op)
                ->with('ec',$ec)
                ->with('datappb',$datappb)
                ->with('datapo', $datapo);
        }
    }

    public function SearchPDOut(Request $request)
    {
     $cari = $request->cariOut;
     //dd($cari);

     $datappb = CategoryPengajuanPembelian::where('id','like',"%".$cari."%")
     ->orWhere('status','like',"%".$cari."%")
     ->orWhere('desc','like',"%".$cari."%")
     ->orWhereHas('whosubmit', function($w) use($cari){
          $w->where('name','like',"%".$cari."%");
     })
     ->orWhereHas('itemppn', function($i) use($cari){
        $i->where('item','like',"%".$cari."%");
        })
        ->orWhereHas('quot', function($q) use($cari){
            $q->where('id','like',"%".$cari."%");
        })
        ->paginate(10, ['*'],'out');
        $datapo = CategoryPO::get();
        return view('pengajuanDana.menu.out')
        ->with('datappb',$datappb)
        ->with('datapo',$datapo);
    }


    public function history()
    {
        $check = Role::where('model_id', Auth::user()->id)->first();
        if ($check->role_id == 5 || $check->role_id == 3 || $check->role_id == 17 || $check->role_id == 4) {
            $datappb = CategoryPengajuanPembelian::whereHas('quot', function($q){
                $q->whereIn('status',['Paid','Delivery Process','Delivery Success'])->where('status', 'not like', '%Rejected%')->orderBy('updated_at','ASC');
            })
            ->where('status', 'not like', '%Rejected%')
            ->orderBy('created_at','DESC')->paginate(10);
            return view('pengajuanDana.menu.history')
            ->with('datappb',$datappb);
        }
    }

    public function SearchHistoryPD(Request $request)
    {
     $cari = $request->cari;
     //dd($cari);

     $datappb = CategoryPengajuanPembelian::where(function($query) use ($cari) {
        $query->whereHas('quot', function($q) {
                $q->whereIn('status',['Paid','Delivery Process','Delivery Success']);
            })
            ->where('status', 'not like', '%Rejected%')
            ->where(function($q) use ($cari) {
                $q->where('id', 'like', "%" . $cari . "%")
                    ->orWhere('status', 'like', "%" . $cari . "%")
                    ->orWhere('desc', 'like', "%" . $cari . "%")
                    ->orWhere('code_pengajuan', 'like', "%" . $cari . "%")
                    ->orWhereHas('whosubmit', function($q) use ($cari) {
                        $q->where('name', 'like', "%" . $cari . "%");
                    })
                    ->orWhereHas('itemppn', function($q) use ($cari) {
                        $q->where('item', 'like', "%" . $cari . "%");
                    })
                    ->orWhereHas('quot', function($q) use ($cari) {
                        $q->where('id', 'like', "%" . $cari . "%")
                        ->orWhere('code_po', 'like', "%" . $cari . "%");
                    });
            });
     })->paginate(10);

     return view('pengajuanDana.menu.history')
     ->with('datappb',$datappb);
    }

    public function SortHistoryPD(Request $request)
    {
     $sort = $request->sort;
    //  dd($cari);
     $datappb = CategoryPengajuanPembelian::whereIn('status',$sort)->paginate(10);
     $datapo = CategoryPO::get();
     return view('pengajuanDana.menu.history')
     ->with('datappb',$datappb)
     ->with('datapo',$datapo)
     ->with('sort',$sort);
    }

    public function detail($id)
    {
        $data_pengajuan = CategoryPengajuanPembelian::find($id);
        $pengajuan = PengajuanPembelian::where('pp_id', $id)->get();
        $datacpo            = CategoryPO::where('ppb_id',$id)->first();
        $dpp                = PengajuanPembelian::selectRaw('pp_id,SUM(total) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $ppn                = PengajuanPembelian::selectRaw('pp_id,SUM(total *11/100) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $total              = PengajuanPembelian::selectRaw('pp_id,SUM((total)+(total*11/100)) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $total_tnpa_ppn     = PengajuanPembelian::selectRaw('pp_id,SUM(total) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $disc               = PengajuanPembelian::where('pp_id',$id)->first();
        $dataws             = WhoSubmitted::all();
        $datadepartment     = Department::all();
        $comments           = Comment::where('ppb_id',$id)->get();
        $vendor             = CategoryPO::where('ppb_id',$id)->first();
        $items              = CategoryPO::where('ppb_id',$id)->get();
        $groupedItem        = ItemPO::groupBy('po_id')->get();
        $itempurchase       = ItemPO::groupBy('po_id')->first();
        return view('pengajuanDana.menu.detail')
            ->with('pengajuan', $pengajuan)
            ->with('comments', $comments)
            ->with('dataws', $dataws)
            ->with('datacpo',$datacpo)
            ->with('datadepartment', $datadepartment)
            ->with('dpp', $dpp)
            ->with('ppn', $ppn)
            ->with('total', $total)
            ->with('disc', $disc)
            ->with('vendor', $vendor)
            ->with('items', $items)
            ->with('groupedItem', $groupedItem)
            ->with('itempurchase', $itempurchase)
            ->with('total_tnpa_ppn', $total_tnpa_ppn)
            ->with('data_pengajuan', $data_pengajuan);
    }

    public function create($id)
    {
        $dv = CategoryPengajuanPembelian::find($id);
        return view('pengajuanDana.menu.create')
            ->with('dv', $dv);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $cpo = CategoryPO::find($id);
        if (!$cpo) {
            return redirect()->back()->with('error', 'Category PO not found.');
        }

        $request->validate([
            'path_image.*' => 'required|file|mimes:xlsx,pdf,docx,png,jpeg,jpg|max:2048',
        ]);

        $pengajuan = $cpo->ppb->id;

        if ($request->hasFile('path_image')) {
            foreach ($request->file('path_image') as $file) {
                $name = $file->getClientOriginalName();
                $file->move(public_path('images'), $name);

                $save = new CategoryPD;
                $save->ppb_id     = $pengajuan;
                $save->po_id      = $id;
                $save->path_image = $name;
                $save->save();
            }
        }

        return redirect()->back()->with('success', 'Task Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = CategoryPD::find($id);
        $delete->delete();
        return redirect('/menu-pengajuan-dana')->with('success', 'Task Deleted Successfully!');
    }

    public function paid(Request $request, $id)
    {
        $data = CategoryPengajuanPembelian::find($id);
        $data->status = 'Paid';
        $data->p_finance_timestamp = now();
        $data->save();
        CategoryPO::where('ppb_id',$id)->update([
            'status' => 'Paid'
        ]);
        return redirect('/menu-pengajuan-dana');
    }

    public function reject($id)
    {
        $data = CategoryPengajuanPembelian::find($id);
        $data->status = 'Rejected by Finance';
        $data->p_finance_timestamp = now();
        $data->save();
        CategoryPO::where('ppb_id',$id)->update([
            'status' => 'Rejected by Finance'
        ]);
        return redirect('/menu-pengajuan-dana');
    }

    public function paid_pd(Request $request, $id)
    {
        $validatedData = $request->validate([
            'payment_date' => 'required|date',
            'payment_purpose' => 'required|string|max:255',
            'nilai' => 'required',
            'ket_pajak' => 'required|string|max:255',
        ]);

        $cpo = CategoryPO::find($id);
        $pr = CategoryPengajuanPembelian::find($cpo->ppb_id);
        $lastQuot = $pr->quot->last();
        if($cpo->id == $lastQuot->id && $pr->status == $cpo->status){
                // PO & Payment Approved
            $data = CategoryPengajuanPembelian::where('id',$cpo->ppb_id)->update([
                'note_finance'            => $request->note_finance,
                'w_finance_pay_timestamp' => now(),
                'status'                  => 'Paid'
            ]);
        }
            CategoryPO::where('id',$id)->update([
                'payment_date' => $request->payment_date ?? null,
                'payment_purpose' => $request->payment_purpose ?? null,
                'nilai' => $request->nilai ?? null,
                'ket_pajak' => $request->ket_pajak ?? null,
                'status' => 'Paid',
            ]);

        return redirect('/menu-pengajuan-dana');
    }

    public function reject_pd(Request $request, $id)
    {
        $cpo = CategoryPO::find($id);
        CategoryPO::where('id',$id)->update([
            'notes' => $request->notes . ' # ' . Auth::user()->name,
            'status' => 'Rejected by Finance',
            'rejected_at' => now(),
        ]);

        $itempo = ItemPO::where('po_id',$id)->update([
            'is_reject' => 1,
        ]);

        return redirect('/menu-pengajuan-dana');
    }

    public function exportpdf($id)
    {
        $data['cpp'] = CategoryPengajuanPembelian::find($id);
        $data['cpo'] = CategoryPO::where('ppb_id', $id)->first();
        $data['id'] = PengajuanPembelian::where('pp_id', $id)->first();
        $data['sig'] = Invoicing::where('ppb_id', $id)->get()->first();
        $data['category_q'] = PengajuanPembelian::where('pp_id', $id)->get();
        $data['dpp'] = PengajuanPembelian::selectRaw('pp_id,SUM(total) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $data['ppn'] = PengajuanPembelian::selectRaw('pp_id,SUM(total *11/100) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $data['total'] = PengajuanPembelian::selectRaw('pp_id,SUM(total) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $data['total_tnp_ppn'] = PengajuanPembelian::selectRaw('pp_id,SUM(total) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $data['disc'] = PengajuanPembelian::where('pp_id',$id)->first();
        $data['year'] = Carbon::now()->format('y');
        $data['month'] = Carbon::now()->format('m');

        $pdf = PDF::loadView('pengajuanDana.export-pdf.payment', $data)->setpaper('A4', 'potrait');
        return $pdf->stream('PengajuanDana.pdf');
    }

    public function exportpdf_multi($id)
    {
        $data['cpp']            = CategoryPengajuanPembelian::find($id);
        $data['cpo']            = CategoryPO::where('ppb_id', $id)->get();
        $data['harga']          = ItemPO::groupBy('po_id')->get();
        $data['id']             = PengajuanPembelian::where('pp_id', $id)->first();
        $data['sig']            = Invoicing::where('ppb_id', $id)->get()->first();
        $data['category_q']     = PengajuanPembelian::where('pp_id', $id)->get();
        $data['dpp']            = PengajuanPembelian::selectRaw('pp_id,SUM(total) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $data['ppn']            = PengajuanPembelian::selectRaw('pp_id,SUM(total *11/100) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $data['total']          = PengajuanPembelian::selectRaw('pp_id,SUM(total) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $data['total_tnp_ppn']  = PengajuanPembelian::selectRaw('pp_id,SUM(total) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $data['disc']           = PengajuanPembelian::where('pp_id',$id)->first();
        $data['year']           = Carbon::now()->format('y');
        $data['month']          = Carbon::now()->format('m');

        $pdf = PDF::loadView('pengajuanDana.export-pdf.payment_multi', $data)->setpaper('A4', 'potrait');
        return $pdf->stream('PengajuanDana.pdf');
    }

    public function exportpdf_pyid($id)
    {
        $data['cpo'] = CategoryPO::find($id);
        $data['harga'] = ItemPO::where('po_id',$id)->groupBy('po_id')->get();
        // $data['sig']   = Invoicing::where('ppb_id', $id)->get()->first();
        $data['year'] = Carbon::now()->format('y');
        $data['month'] = Carbon::now()->format('m');

        $pdf = PDF::loadView('pengajuanDana.export-pdf.payment_id', $data)->setpaper('A4', 'potrait');
        return $pdf->stream('PengajuanDana.pdf');
    }
}
