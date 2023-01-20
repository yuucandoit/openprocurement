<?php

namespace App\Http\Controllers;

use App\Models\CategoryEcommerce;
use App\Models\CategoryPengajuanPembelian;
use App\Models\CategoryPO;
use App\Models\CategoryPP;
use App\Models\CategoryPT;
use App\Models\Comment;
use App\Models\Department;
use App\Models\PengajuanPembelian;
use App\Models\PrivatePerson;
use App\Models\PurchaseOrder;
use App\Models\ReferensiNamaProject;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\TermsAndConditions;
use App\Models\User;
use App\Models\WhoSubmitted;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoryPOController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $check = Role::where('model_id', Auth::user()->id)->first();

        if ($check->role_id == 4 || $check->role_id == 3) {
            $datappb            = CategoryPengajuanPembelian::where('status','Purchase Proses')->orderBy('dateline', 'asc')->orderBy('approved_at', 'desc')->paginate(10, ['*'],'in');
            $datappb2           = CategoryPengajuanPembelian::orderBy('status', 'desc')->orderBy('dateline', 'asc')->orderBy('approved_at', 'asc')->first();
            $pt                 = CategoryPT::all();
            $op                 = CategoryPP::all();
            $dataws             = WhoSubmitted::all();
            $datadepartment     = Department::all();
            $ec                 = CategoryEcommerce::all();
            $datapo             = CategoryPO::first();
            //dd($datappb);
            return view('purchaseOrder.menu.index')
                ->with('pt', $pt)
                ->with('op', $op)
                ->with('ec', $ec)
                // ->with('datahstry', $datahstry)
                ->with('dataws', $dataws)
                ->with('datadepartment', $datadepartment)
                ->with('datappb2', $datappb2)
                ->with('datappb', $datappb)
                ->with('datapo', $datapo);
        }
    }

    public function SearchPOIn(Request $request)
   {
    $cariIn = $request->cariIn;
    //dd($cari);
    $datappb = CategoryPengajuanPembelian::orderBy('status', 'desc')->orderBy('dateline', 'asc')->orderBy('approved_at', 'asc')->
    orWhere('id','like',"%".$cariIn."%")
    ->orWhere('status','like',"%".$cariIn."%")
    ->orWhere('desc','like',"%".$cariIn."%")
    ->orWhereHas('whosubmit', function($q) use($cariIn){
         $q->where('name','like',"%".$cariIn."%");
    })
    ->paginate(10, ['*'],'in');

    $datahstry = CategoryPengajuanPembelian::where('status','Waiting For PO Approval')->orWhere('status','PO Approved')->orWhere('status','Invoicing Process')
    ->orWhere('status','Payment Approved')->orWhere( 'status','Unpaid')
    ->orWhere('status','Paid')->orWhere('status','Delivery Process')->orWhere('status','Delivery Success')->paginate(10);

    return view('purchaseOrder.menu.index')
    ->with('datappb',$datappb)
    ->with('datahstry',$datahstry);
   }

   public function out()
   {
       $check = Role::where('model_id', Auth::user()->id)->first();
       if ($check->role_id == 4 || $check->role_id == 3) {
        $datappb          = CategoryPengajuanPembelian::where('status','Waiting For PO Approval')->orWhere('status','PO Approved')->orWhere('status','Invoicing Process')
        ->orWhere('status','Payment Approved')->orWhere( 'status','Unpaid')
        ->orWhere('status','Paid')->orWhere('status','Delivery Process')->orWhere('status','Delivery Success')->paginate(10, ['*'],'out');
           $pt = CategoryPT::all();
           $op = CategoryPP::all();
           $ec = CategoryEcommerce::all();
           $datapo = CategoryPO::all();
           return view('purchaseOrder.menu.out')
               ->with('pt', $pt)
               ->with('op', $op)
               ->with('ec', $ec)
               ->with('datappb', $datappb)
               ->with('datapo', $datapo);
       }
   }

   public function SearchPOOut(Request $request)
   {
    $cariOut = $request->cariOut;
    //dd($cari);
    $datappb = CategoryPengajuanPembelian::orderBy('status', 'desc')->orderBy('dateline', 'asc')->orderBy('approved_at', 'asc')
    ->orWhere('id','like',"%".$cariOut."%")
    ->orWhere('status','like',"%".$cariOut."%")
    ->orWhere('desc','like',"%".$cariOut."%")
    ->orWhereHas('whosubmit', function($q) use($cariOut){
         $q->where('name','like',"%".$cariOut."%");
    })
    ->paginate(10, ['*'],'out');

    return view('purchaseOrder.menu.out')
    ->with('datappb',$datappb);
   }


    public function history()
    {
        $check = Role::where('model_id', Auth::user()->id)->first();
        if ($check->role_id == 4 || $check->role_id == 3) {
            $datappb = CategoryPengajuanPembelian::all();
            $pt = CategoryPT::all();
            $op = CategoryPP::all();
            $ec = CategoryEcommerce::all();
            $datapo = CategoryPO::all();
            return view('purchaseOrder.menu.history')
                ->with('pt', $pt)
                ->with('op', $op)
                ->with('ec', $ec)
                ->with('datappb', $datappb)
                ->with('datapo', $datapo);
        }
    }

    public function detail($id)
    {
        $data_pengajuan     = CategoryPengajuanPembelian::find($id);
        $pengajuan          = PengajuanPembelian::where('pp_id', $id)->get();
        $datapo             = CategoryPO::where('ppb_id', $id)->get();
        $datacpo            = CategoryPO::where('ppb_id', $id)->first();
        $dataws             = WhoSubmitted::all();
        $datadepartment     = Department::all();
        $dpp                = PengajuanPembelian::selectRaw('pp_id,SUM(total) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $ppn                = PengajuanPembelian::selectRaw('pp_id,SUM(total *11/100) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $total              = PengajuanPembelian::selectRaw('pp_id,SUM((total)+(total*11/100)) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $total_tnpa_ppn     = PengajuanPembelian::selectRaw('pp_id,SUM(total) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $comments           = Comment::where('ppb_id',$id)->get();

        //dd($datacpo);
        return view('purchaseOrder.menu.detail')
            ->with('pengajuan', $pengajuan)
            ->with('dpp', $dpp)
            ->with('datapo', $datapo)
            ->with('dataws', $dataws)
            ->with('datacpo', $datacpo)
            ->with('datadepartment', $datadepartment)
            ->with('ppn', $ppn)
            ->with('total', $total)
            ->with('total_tnpa_ppn', $total_tnpa_ppn)
            ->with('data_pengajuan', $data_pengajuan)
            ->with('comments', $comments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $pt                 = CategoryPT::all();
        $op                 = CategoryPP::all();
        $ec                 = CategoryEcommerce::all();
        $atasan             = User::whereIn('id', [3, 6, 7, 8, 9])->get();
        $terms              = TermsAndConditions::all();
        $dv                 = CategoryPengajuanPembelian::find($id);
        $pengajuan2        = PengajuanPembelian::all();
        $pengajuan          = PengajuanPembelian::where('pp_id', $id)->get();
        $pengajuan1        = PengajuanPembelian::find($id);
        $dpp                = PengajuanPembelian::selectRaw('pp_id,SUM(total) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $ppn                = PengajuanPembelian::selectRaw('pp_id,SUM(total *11/100) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $total              = PengajuanPembelian::selectRaw('pp_id,SUM((total)+(total*11/100)) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $total_tnpa_ppn     = PengajuanPembelian::selectRaw('pp_id,SUM(total) as total')->groupBy('pp_id')->where('pp_id', $id)->get();


        // foreach($pengajuan as $p){
        // var_dump($p->id);
        // }
        return view('purchaseOrder.menu.create')
            ->with('pt', $pt)
            ->with('op', $op)
            ->with('ec', $ec)
            ->with('dv', $dv)
            ->with('atasan', $atasan)
            ->with('terms', $terms)
            ->with('pengajuan', $pengajuan)
            ->with('dpp', $dpp)
            ->with('ppn', $ppn)
            ->with('total', $total)
            ->with('total_tnpa_ppn', $total_tnpa_ppn);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {

        // $request->validate([
        //     'category_purpose' => 'required',
        //     'date_ps' => 'required',
        //     'dateline' => 'required',
        //     'ws'      => 'required',
        //     'department' => 'required',
        //     'desc'  => 'required',
        //     'atasan' => 'required',
        //     'matauang' => 'required',
        //     'send_to' => 'required',
        //     // 'path_file.*' => 'mimes:png,jpg,jpeg,csv,txt,xlx,xls,pdf'
        // ], [
        //     'category_purpose.required' => 'The Purpose field is required.',
        //     'date_ps.required' => 'The Date field is required.',
        //     'dateline.required' => 'The Date Line field is required.',
        //     'ws.required' => 'The Who Submitted field is required.',
        //     'department.required' => 'The Department field is required.',
        //     'desc.required' => 'The Description field is required.',
        //     'atasan.required' => 'The Super User field is required.',
        //     'mata_uang.required' => 'The Currency field is required.',
        //     'send_to.required' => 'The Send To field is required.',
        //     'ppn.required' => 'The PPN To field is required.',
        // ]);
        // dd($request->all());
        $data = CategoryPengajuanPembelian::find($id);
        $item = PengajuanPembelian::all();

        $data2 = $request->all();
    //    dd($data2);

        $pt = CategoryPT::find($id);
        $pp = CategoryPP::find($id);
        $ec = CategoryEcommerce::find($id);


        if ($request->term_conditions == "custom") {
            $term = TermsAndConditions::create([
                "term_condition" => $request->term_condition,
            ]);
            $ppn = CategoryPengajuanPembelian::find($id);
            $ppn->atasan_po = $request->atasan_po;
            $ppn->ppn =  $request->ppn;
            $ppn->save();

            $purchase = new CategoryPO([
                "ppb_id" => $data->id,
                "term_conditions" => $term->id,
                "quotation" => $request->quotation,
                // "ppn" => $request->ppn
            ]);
            if ($request->vendor == "company") {
                $vendor1 = CategoryPT::find($request->perusahaan);
                $purchase = $vendor1->vendors()->save($purchase);
            } elseif ($request->vendor == "privateperson") {
                $vendor2 = CategoryPP::find($request->orangpribadi);
                $purchase = $vendor2->vendors()->save($purchase);
            } elseif ($request->vendor == "ecommerce") {
                $vendor3 = CategoryEcommerce::find($request->ecommerce);

                $purchase = $vendor3->vendors()->save($purchase);

            }

             foreach ($data2['id'] as $key => $item) {
                $unit_price = str_replace(".", "", $data2['unit_price'][$key]);
                $update = array(
                    'item'              => $data2['item'][$key],
                    'qty'               => $data2['qty'][$key],
                    'kategori'          => $data2['kategori'][$key],
                    'unit_price'        => $unit_price,
                    'total'             => $data2['total'][$key],
                );
                PengajuanPembelian::updateOrCreate([
                    'item' => $data2['item'][$key],
                    'id' => $item
            ], $update);
            }
        }

        else {

            $ppn = CategoryPengajuanPembelian::find($id);
            $ppn->ppn =  $request->ppn;
            $ppn->atasan_po = $request->atasan_po;
            $ppn->save();

        //     $purchase = new CategoryPO([
        //         "ppb_id" => $data->id,
        //         "term_conditions" => $request->term_conditions,
        //         "quotation" => $request->quotation,
        //         // "ppn" => $request->ppn
        //     ]);
        //     if ($request->vendor == "company") {
        //         $vendor1 = CategoryPT::find($request->perusahaan);
        //         $purchase = $vendor1->vendors()->save($purchase);
        //     } elseif ($request->vendor == "privateperson") {
        //         $vendor2 = CategoryPP::find($request->orangpribadi);
        //         $purchase = $vendor2->vendors()->save($purchase);
        //     } elseif ($request->vendor == "ecommerce") {
        //         $vendor3 = CategoryEcommerce::find($request->ecommerce);
        //         $purchase = $vendor3->vendors()->save($purchase);
        //     }
        // }
        // foreach($data2['item_ppid'] as $ppid => $item_id){
        foreach($data2['vendor'] as $vendorable => $vendor_po){
            dd($data2['item_ppid_'.$vendorable]);
            foreach($data2['item_ppid_'.$vendorable] as $item_id){
                $purchase = array (
                    'ppb_id' =>  $data->id,
                    "term_conditions" =>  $data2['term_conditions'][$vendorable],
                    "quotation" => $data2['quotation'][$vendorable],
                    "item_ppid" =>  $item_id,
                );


                if ($vendor_po == "company") {

                    $vendor1 = CategoryPT::find($data2['perusahaan'][$vendorable]);
                    // dd($vendor1->vendors());
                     $vendor1->vendors()->create($purchase);

                } elseif ($vendor_po == "privateperson") {
                    $vendor2 = CategoryPP::find($data2['orangpribadi'][$vendorable]);
                     $vendor2->vendors()->create($purchase);

                } elseif ($vendor_po == "ecommerce") {
                    $vendor3 = CategoryEcommerce::find($data2['ecommerce'][$vendorable]);
                    //    dd($vendor3->vendors());
                    $vendor3->vendors()->create($purchase);
                }
                // print_r($data2['item_ppid'][$vendorable]);
                // dd($data2);
                // print_r($data2['vendor'][$vendorable]);
                // dd($data2['item_ppid_'.$vendorable]);
            // }
            }
        }


    }

             foreach ($data2['id'] as $key => $item) {
                $unit_price = str_replace(".", "", $data2['unit_price'][$key]);
                $update = array(
                    'item'              => $data2['item'][$key],
                    'qty'               => $data2['qty'][$key],
                    'kategori'          => $data2['kategori'][$key],
                    'unit_price'        => $unit_price,
                    'total'             => $data2['total'][$key],
                );
                PengajuanPembelian::updateOrCreate([
                    'item' => $data2['item'][$key],
                    'pp_id' => $id,
                    'id' => $item,
            ], $update);


        }


        //dd($request);

        return redirect("menu-purchase-order/");
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

        $atasan = User::whereIn('id', [3, 6, 7, 8, 9])->get();
        $datapt = CategoryPT::all();
        $op                 = CategoryPP::all();
        $ec                 = CategoryEcommerce::all();
        $terms              = TermsAndConditions::all();
        $datapo             = CategoryPO::where('ppb_id', $id)->get();
        $datacpo            = CategoryPO::where('ppb_id', $id)->first();
        $dv                 = CategoryPengajuanPembelian::find($id);
        $atasanpo           = CategoryPengajuanPembelian::where('id', $id)->get();
        $purpose            = ReferensiNamaProject::all();
        $dataws             = WhoSubmitted::all();
        $datadepartment     = Department::all();
        $item = PengajuanPembelian::where('pp_id', $id)->get();

        return view('purchaseOrder.menu.edit')
            ->with('atasan', $atasan)
            ->with('atasanpo', $atasanpo)
            ->with('datapo', $datapo)
            ->with('datapt', $datapt)
            ->with('datacpo', $datacpo)
            ->with('op', $op)
            ->with('ec', $ec)
            ->with('terms', $terms)
            ->with('purpose', $purpose)
            ->with('dataws', $dataws)
            ->with('datadepartment', $datadepartment)
            ->with('item', $item)
            ->with('dv', $dv);
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

        // $request->validate([
        //     'category_purpose' => 'required',
        //     'date_ps' => 'required',
        //     'dateline' => 'required',
        //     'ws'      => 'required',
        //     'department' => 'required',
        //     'desc'  => 'required',
        //     'atasan' => 'required',
        //     'matauang' => 'required',
        //     'send_to' => 'required',
        //     // 'path_file.*' => 'mimes:png,jpg,jpeg,csv,txt,xlx,xls,pdf'
        // ], [
        //     'category_purpose.required' => 'The Purpose field is required.',
        //     'date_ps.required' => 'The Date field is required.',
        //     'dateline.required' => 'The Date Line field is required.',
        //     'ws.required' => 'The Who Submitted field is required.',
        //     'department.required' => 'The Department field is required.',
        //     'desc.required' => 'The Description field is required.',
        //     'atasan.required' => 'The Super User field is required.',
        //     'mata_uang.required' => 'The Currency field is required.',
        //     'send_to.required' => 'The Send To field is required.',
        //     'ppn.required' => 'The PPN To field is required.',
        // ]);

        $data = CategoryPengajuanPembelian::find($id);
        $data2 = $request->all();
        // dd($data2);


        if ($request->term_conditions == "custom") {
            $term = TermsAndConditions::create([
                "term_condition" => $request->term_condition,
            ]);

            $ppn = CategoryPengajuanPembelian::find($id);
            $ppn->ppn =  $request->ppn;
            $ppn->atasan_po = $request->atasan_po;
            $ppn->save();

            $purchase =  CategoryPO::where('ppb_id', $id)->first();
            $purchase->update([
                "term_conditions" => $request->term_conditions,
                "quotation" => $request->quotation,
            ]);


            if ($request->vendor == "company") {
                $vendor1 = CategoryPT::find($request->perusahaan);
                $vendor1->vendors()->where('id',$id)->delete();
                $vendor1->vendors()->save($purchase);

            } elseif ($request->vendor == "privateperson") {
                $vendor2 = CategoryPP::find($request->orangpribadi);
                $vendor2->vendors()->where('id',$id)->delete();
                $vendor2->vendors()->save($purchase);

            } elseif ($request->vendor == "ecommerce") {
                $vendor3 = CategoryEcommerce::find($request->ecommerce);
                $vendor3->vendors()->where('id',$id)->delete();
                $vendor3->vendors()->save($purchase);
            }

            // dd($data2['item']);
             // $data2 = $request->all();
             // $data2 = $request->all();
             foreach ($data2['id'] as $key => $item) {
                $unit_price = str_replace(".", "", $data2['unit_price'][$key]);
                $update = array(
                    'item'              => $data2['item'][$key],
                    'qty'               => $data2['qty'][$key],
                    'kategori'          => $data2['kategori'][$key],
                    'unit_price'        => $unit_price,
                    'total'             => $data2['total'][$key],
                );

                // dd($item);
                PengajuanPembelian::updateOrCreate([
                    'id' => $item,
                    'item' => $data2['item'][$key]
            ], $update);
            }
        } else {

            $ppn = CategoryPengajuanPembelian::find($id);

            $ppn->ppn =  $request->ppn;
            $ppn->atasan_po = $request->atasan_po;
            $ppn->save();

            $purchase =  CategoryPO::where('ppb_id', $id)->first();
            $purchase->update([
                "term_conditions" => $request->term_conditions,
                "quotation" => $request->quotation,
            ]);


            if ($request->vendor == "company") {
                $vendor1 = CategoryPT::find($request->perusahaan);
                $vendor1->vendors()->where('id',$id)->delete();
                $vendor1->vendors()->save($purchase);

            } elseif ($request->vendor == "privateperson") {
                $vendor2 = CategoryPP::find($request->orangpribadi);
                $vendor2->vendors()->where('id',$id)->delete();
                $vendor2->vendors()->save($purchase);

            } elseif ($request->vendor == "ecommerce") {
                $vendor3 = CategoryEcommerce::find($request->ecommerce);
                $vendor3->vendors()->where('id',$id)->delete();
                $vendor3->vendors()->save($purchase);
            }

            // $data2 = $request->all();
            foreach ($data2['id'] as $key => $item) {
                $unit_price = str_replace(".", "", $data2['unit_price'][$key]);
                $update = array(
                    'item'              => $data2['item'][$key],
                    'qty'               => $data2['qty'][$key],
                    'kategori'          => $data2['kategori'][$key],
                    'unit_price'        => $unit_price,
                    'total'             => $data2['total'][$key],
                );

                // dd($item);
                PengajuanPembelian::where('id', $item)($update);
            }
        }
        // dd($key);

        return redirect("menu-purchase-order/out");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = CategoryPengajuanPembelian::find($id);
        $data->delete();
        return redirect('/menu-purchase-order')->with('success', 'Task Deleted Successfully!');
    }

    public function ajukan_keatasan($id)
    {

        $data = CategoryPengajuanPembelian::find($id);
        if(empty($data->atasan_po)){
            return redirect()->back()->withErrors(["Approver Not Found"]);
        }else{
        $data->status = 'Waiting For PO Approval';
        $data->save();
        return redirect('send-purchase/'.$data->id);
        }
    }

    public function Reject($id)
    {
        $data = CategoryPengajuanPembelian::find($id);
        $data->status = 'Rejected By Purchasing';
        $data->save();
        return redirect('menu-purchase-order');
    }
}
