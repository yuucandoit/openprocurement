<?php

namespace App\Http\Controllers;

use App\Models\CategoryEcommerce;
use App\Models\CategoryPengajuanPembelian;
use App\Models\CategoryPO;
use App\Models\CategoryPP;
use App\Models\CategoryPT;
use App\Models\Comment;
use App\Models\Department;
use App\Models\ItemPO;
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

        if ($check->role_id == 4 || $check->role_id == 3 || $check->role_id == 17) {
            $datappb            = CategoryPengajuanPembelian::where('status','Purchase Proses')->orWhere('status','Cross Check PO')->orderBy('dateline', 'asc')->orderBy('approved_at', 'desc')->paginate(10, ['*'],'in');
            $datappb2           = CategoryPengajuanPembelian::where('status','Purchase Proses')->orderBy('status', 'desc')->orderBy('dateline', 'asc')->orderBy('approved_at', 'asc')->get();
            foreach($datappb2 as $ppb){
                $datapo             = CategoryPO::where('ppb_id', $ppb->id)->get();
            }
            //dd($datappb);
            return view('purchaseOrder.menu.index')
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
    ->orWhereHas('itemppn', function($i) use($cariIn){
        $i->where('item','like',"%".$cariIn."%");
    })
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
       if ($check->role_id == 4 || $check->role_id == 3 ||$check->role_id == 17) {
        $datappb          = CategoryPengajuanPembelian::where('status','Waiting For PO Approval')->orWhere('status','PO Approved')->orWhere('status','Invoicing Process')
        ->orWhere('status','Payment Approved')->orWhere( 'status','Unpaid')
        ->orWhere('status','Paid')->orWhere('status','Delivery Process')->orWhere('status','Delivery Success')->orderBy('updated_at','desc')->paginate(10, ['*'],'out');
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
    ->orWhereHas('itemppn', function($i) use($cariOut){
        $i->where('item','like',"%".$cariOut."%");
    })
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

    public function SearchHistoryPO(Request $request)
    {
     $cari = $request->cari;
     //dd($cari);
     $datappb = CategoryPengajuanPembelian::orderBy('status', 'desc')->orderBy('dateline', 'asc')->orderBy('approved_at', 'asc')
     ->orWhere('id','like',"%".$cari."%")
     ->orWhere('status','like',"%".$cari."%")
     ->orWhere('desc','like',"%".$cari."%")
     ->orWhereHas('itemppn', function($i) use($cari){
         $i->where('item','like',"%".$cari."%");
     })
     ->orWhereHas('whosubmit', function($q) use($cari){
          $q->where('name','like',"%".$cari."%");
     })
     ->paginate(10);

     return view('purchaseOrder.menu.history')
     ->with('datappb',$datappb);
    }

    public function detail($id)
    {
        $pt                 = CategoryPT::all();
        $op                 = CategoryPP::all();
        $ec                 = CategoryEcommerce::all();
        $terms              = TermsAndConditions::all();
        $atasan             = User::whereIn('id', [3, 6, 7, 8, 9])->get();
        $data_pengajuan     = CategoryPengajuanPembelian::find($id);
        $pengajuan          = PengajuanPembelian::where('pp_id', $id)->get();
        $vendor             = CategoryPO::where('ppb_id',$id)->first();
        $items              = CategoryPO::where('ppb_id',$id)->get();
        $groupedItem        = ItemPO::groupBy('po_id')->get();
        $itempurchase       = ItemPO::groupBy('po_id')->first();

        $dpp                = PengajuanPembelian::selectRaw('pp_id,SUM(total) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $ppn                = PengajuanPembelian::selectRaw('pp_id,SUM(total *11/100) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $total              = PengajuanPembelian::selectRaw('pp_id,SUM((total)+(total*11/100)) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $total_tnpa_ppn     = PengajuanPembelian::selectRaw('pp_id,SUM(total) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $disc               = PengajuanPembelian::where('pp_id',$id)->first();
        $comments           = Comment::where('ppb_id',$id)->get();

        //dd($datacpo);
        return view('purchaseOrder.menu.detail')
            ->with('pt', $pt)
            ->with('op', $op)
            ->with('ec', $ec)
            ->with('terms', $terms)
            ->with('groupedItem', $groupedItem)
            ->with('itempurchase', $itempurchase)
            ->with('atasan', $atasan)
            ->with('pengajuan', $pengajuan)
            ->with('dpp', $dpp)
            // ->with('datapo', $datapo)
            // ->with('datacpo', $datacpo)
            ->with('ppn', $ppn)
            ->with('vendor', $vendor)
            ->with('items', $items)
            // ->with('item', $item)
            ->with('total', $total)
            ->with('disc' , $disc)
            ->with('total_tnpa_ppn', $total_tnpa_ppn)
            ->with('data_pengajuan', $data_pengajuan)
            ->with('comments', $comments);
    }


    public function po_detail($id)
    {
        // $data_pengajuan     = CategoryPengajuanPembelian::find($id);
        $pengajuan          = PengajuanPembelian::where('pp_id', $id)->get();
        $datapo             = CategoryPO::where('id', $id)->get();
        $datacpo            = CategoryPO::where('id', $id)->first();
        // dd($datacpo);
        $dataws             = WhoSubmitted::all();
        $datadepartment     = Department::all();
        $dpp                = PengajuanPembelian::selectRaw('pp_id,SUM(total) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $ppn                = PengajuanPembelian::selectRaw('pp_id,SUM(total *11/100) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $total              = PengajuanPembelian::selectRaw('pp_id,SUM((total)+(total*11/100)) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $total_tnpa_ppn     = PengajuanPembelian::selectRaw('pp_id,SUM(total) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $comments           = Comment::where('ppb_id',$id)->get();

        //dd($datacpo);
        return view('purchaseOrder.menu.po')
            ->with('pengajuan', $pengajuan)
            ->with('dpp', $dpp)
            ->with('datapo', $datapo)
            ->with('dataws', $dataws)
            ->with('datacpo', $datacpo)
            ->with('datadepartment', $datadepartment)
            ->with('ppn', $ppn)
            ->with('total', $total)
            ->with('total_tnpa_ppn', $total_tnpa_ppn)
            // ->with('data_pengajuan', $data_pengajuan)
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
        $vendor             = CategoryPO::where('ppb_id',$id)->first();
        $id_item             = CategoryPO::where('ppb_id',$id)->latest('item_ppid')->first();
        $vendors            = CategoryPO::where('ppb_id',$id)->groupBy('vendorable_type')->groupBy('vendorable_id')->get();
        $items              = CategoryPO::where('ppb_id',$id)->get();
        $pengajuan          = PengajuanPembelian::where('pp_id', $id)->get();
        // dd($id_item);

        return view('purchaseOrder.menu.create')
            ->with('pt', $pt)
            ->with('op', $op)
            ->with('ec', $ec)
            ->with('dv', $dv)
            ->with('atasan', $atasan)
            ->with('terms', $terms)
            ->with('vendor', $vendor)
            ->with('vendors', $vendors)
            ->with('id_item', $id_item)
            ->with('items', $items)
            ->with('pengajuan', $pengajuan);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {

        // dd($request->all());
        $data = CategoryPengajuanPembelian::find($id);
        $item = PengajuanPembelian::all();

        $data2 = $request->all();
        // dd($data2);
    // dd($data2['discount']);

        $pt = CategoryPT::find($id);
        $pp = CategoryPP::find($id);
        $ec = CategoryEcommerce::find($id);




        if ($request->term_conditions == "custom") {
            $term = TermsAndConditions::create([
                "term_condition" => $request->term_condition,
            ]);
            $ppn = CategoryPengajuanPembelian::find($id);
            $ppn->atasan_po = $request->atasan_po;
            $ppn->save();

            $file = null;
            if ($file = $request->file('path_quotation') ?? null){
            $path_file = $file->getClientOriginalName();
            $file->move('upload_quotation',$path_file);
            }

            $purchase = new CategoryPO([
                "ppb_id" => $data->id,
                "term_conditions" => $term->id ,
                "quotation" => $request->quotation,
                "path_quotation" => $path_file ?? null,
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


            foreach ($data2['item'] as $key => $item) {
                $price_unit = str_replace("," ,"", $data2['unit_price'][$key]);
                $sum = str_replace(",", "" , $data2['total'][$key]);
                $dpp = str_replace(",", "" , $data2['dpp']);
                // dd($price_unit);
                $diskon = str_replace(",", "", $data2['discount']);
                $grand_total = str_replace(",","", $data2['grand_total']);
                $ongkir     = str_replace(",", "", $data2['ongkir']);
                // dd($purchase->id);
                $update = array(
                    'po_id'             => $purchase->id,
                    'item'              => $data2['item'][$key],
                    'qty'               => $data2['qty'][$key],
                    'kategori'          => $data2['kategori'][$key],
                    'unit_price'        => $price_unit,
                    'matauang'          => $data2['matauang'],
                    'discount'          => $diskon,
                    "ongkir"            => $ongkir,
                    "dpp"               => $dpp,
                    'total'             => $sum,
                    "ppn"               => $data2['ppn']?? 0,
                    "grand_total"       => $grand_total,
                );
                    $item_po_id = ItemPO::create($update);
            }

        }

        else {
            $po = CategoryPO::where('ppb_id',$id)->first();

            $ppn = CategoryPengajuanPembelian::find($id);
            $ppn->atasan_po = $request->atasan_po;
            // $ppn->matauang = $request->matauang;
            // $ppn->ppn =  $request->ppn;
            $ppn->save();

            $file = null;
            if ($file = $request->file('path_quotation') ?? null){
            $path_file = $file->getClientOriginalName();
            $file->move('upload_quotation',$path_file);
            }

            $purchase = new CategoryPO([
                "ppb_id" => $data->id,
                "term_conditions" => $request->term_conditions,
                "quotation" => $request->quotation,
                "path_quotation" => $path_file ?? null,
            ]);
            // dd($purchase->id);
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


            foreach ($data2['item'] as $key => $item) {
                $price_unit = str_replace("," ,"", $data2['unit_price'][$key]);
                $sum = str_replace(",", "" , $data2['total'][$key]);
                $dpp = str_replace(",", "" , $data2['dpp']);
                // dd($price_unit);
                $diskon = str_replace(",", "", $data2['discount']);
                $grand_total = str_replace(",","", $data2['grand_total']);
                $ongkir     = str_replace(",", "", $data2['ongkir']);
                // dd($purchase->id);
                $update = array(
                    'po_id'             => $purchase->id,
                    'item'              => $data2['item'][$key],
                    'qty'               => $data2['qty'][$key],
                    'kategori'          => $data2['kategori'][$key],
                    'unit_price'        => $price_unit,
                    'matauang'          => $data2['matauang'],
                    'discount'          => $diskon,
                    "ongkir"            => $ongkir,
                    "dpp"               => $dpp,
                    'total'             => $sum,
                    "ppn"               => $data2['ppn']?? 0,
                    "grand_total"       => $grand_total,
                );
                    $item_po_id = ItemPO::create($update);
            }
        }
        return redirect()->back();
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

        $atasan             = User::whereIn('id', [3, 6, 7, 8, 9])->get();
        $pt                 = CategoryPT::all();
        $op                 = CategoryPP::all();
        $ec                 = CategoryEcommerce::all();
        $terms              = TermsAndConditions::all();
        $datapo             = CategoryPO::where('id',$id)->get();
        $currency           = ItemPO::where('po_id',$id)->first();
        // $item               = ItemPO::where('po_id',$id)->get();
        // $item2              = ItemPO::where('po_id',$id)->first();
        // $dv                 = CategoryPengajuanPembelian::find($id);
        // dd($datapo);
        $groupedItem        = ItemPO::groupBy('po_id')->get();
        $atasanpo           = CategoryPengajuanPembelian::where('id', $id)->get();
        $purpose            = ReferensiNamaProject::all();
        $dataws             = WhoSubmitted::all();
        $datadepartment     = Department::all();
        $item               = PengajuanPembelian::where('pp_id', $id)->get();

        return view('purchaseOrder.menu.edit')
            ->with('atasan', $atasan)
            ->with('atasanpo', $atasanpo)
            ->with('currency', $currency)
            ->with('groupedItem', $groupedItem)
            ->with('pt', $pt)
            ->with('datapo', $datapo)
            ->with('op', $op)
            ->with('ec', $ec)
            ->with('terms', $terms)
            ->with('purpose', $purpose)
            ->with('dataws', $dataws)
            ->with('datadepartment', $datadepartment);
            // ->with('item2', $item2);
            // ->with('dv', $dv);
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
        $datapo = CategoryPO::where('id',$id)->first();
        $data = CategoryPengajuanPembelian::find($id);
        $data2 = $request->all();
        // dd($data2);



        if ($request->term_conditions == "custom") {
            $term = TermsAndConditions::create([
                "term_condition" => $request->term_condition,
            ]);
            $ppn = CategoryPengajuanPembelian::where('id',$datapo->ppb_id)->first();
            if($request->has('atasan_po')){
                $ppn->atasan_po = $request->atasan_po;
                $ppn->save();
            }

            $purchase = CategoryPO::where('id',$id)->first();

            $file = null;
            if ($file = $request->file('path_quotation') ?? null){
            $path_file = $file->getClientOriginalName();
            $file->move('upload_quotation',$path_file);
            $purchase->path_quotation = $path_file;
            $purchase->save();
            }

            $purchase->update([
                "ppb_id" => $datapo->ppb_id,
                "term_conditions" => $term->id,
                "quotation" => $request->quotation,
            ]);
            // dd($purchase);
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


            foreach ($data2['id'] as $key => $item) {
                $price_unit = str_replace("," ,"", $data2['unit_price'][$key]);
                $sum = str_replace(",", "" , $data2['total'][$key]);
                $dpp = str_replace(",", "" , $data2['dpp']);
                // dd($price_unit);
                $diskon = str_replace(",", "", $data2['discount']);
                $grand_total = str_replace(",","", $data2['grand_total']);
                $ongkir     = str_replace(",", "", $data2['ongkir']);

                // $price_unit = str_replace("." ,"", $data2['unit_price'][$key]);
                // $unit_price = str_replace(",", "" , $price_unit);

                // $diskon = str_replace(".", "", $data2['discount']);
                // $grand_total = str_replace(",","", $data2['grand_total']);
                // $ongkir     = str_replace(".", "", $data2['ongkir']);
                //dd($diskon);
                $update = array(
                    'po_id'             => $purchase->id,
                    'item'              => $data2['item'][$key],
                    'qty'               => $data2['qty'][$key],
                    'kategori'          => $data2['kategori'][$key],
                    'unit_price'        => $price_unit,
                    'discount'          => $diskon,
                    "ongkir"            => $ongkir,
                    'matauang'          => $data2['matauang'],
                    "dpp"               => $dpp,
                    'total'             => $sum,
                    "ppn"               => $data2['ppn']?? 0,
                    "grand_total"       => $grand_total,
                );
                ItemPO::where('id', $item)->update($update);
            }

        }

        else {
            $po = CategoryPO::where('ppb_id',$id)->first();

            // $ppn = CategoryPengajuanPembelian::find($id);
            $ppn = CategoryPengajuanPembelian::where('id',$datapo->ppb_id)->first();
            if($request->has('atasan_po')){
                $ppn->atasan_po = $request->atasan_po;
                $ppn->save();
            }

            $purchase = CategoryPO::where('id',$id)->first();

            $file = null;
            if ($file = $request->file('path_quotation') ?? null){
            $path_file = $file->getClientOriginalName();
            $file->move('upload_quotation',$path_file);
            $purchase->path_quotation = $path_file;
            }

            $purchase->update([
                "ppb_id" => $datapo->ppb_id,
                "term_conditions" => $request->term_conditions,
                "quotation" => $request->quotation,
            ]);
            // dd($data2);
            // dd($purchase->vendorable_type === $request->vendorable_type);
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
                dd($vendor3);
                $vendor3->vendors()->where('id',$id)->delete();
                $vendor3->vendors()->save($purchase);
            }

            foreach ($data2['id'] as $key => $item) {
                $price_unit = str_replace("," ,"", $data2['unit_price'][$key]);
                $sum = str_replace(",", "" , $data2['total'][$key]);
                $dpp = str_replace(",", "" , $data2['dpp']);
                // dd($price_unit);
                $diskon = str_replace(",", "", $data2['discount']);
                $grand_total = str_replace(",","", $data2['grand_total']);
                $ongkir     = str_replace(",", "", $data2['ongkir']);
                // $price_unit = str_replace("." ,"", $data2['unit_price'][$key]);
                // $unit_price = str_replace(",", "" , $price_unit);

                // $diskon = str_replace(".", "", $data2['discount']);
                // $grand_total = str_replace(",","", $data2['grand_total']);
                // $ongkir     = str_replace(".", "", $data2['ongkir']);
                // dd($purchase->id);
                $update = array(
                    'po_id'             => $purchase->id,
                    'item'              => $data2['item'][$key],
                    'qty'               => $data2['qty'][$key],
                    'kategori'          => $data2['kategori'][$key],
                    'unit_price'        => $price_unit,
                    'discount'          => $diskon,
                    "ongkir"            => $ongkir,
                    'matauang'          => $data2['matauang'],
                    "dpp"               => $dpp,
                    'total'             => $sum,
                    "ppn"               => $data2['ppn']?? 0,
                    "grand_total"       => $grand_total,
                );
                ItemPO::where('id', $item)->update($update);
            }
        }

        return redirect("menu-purchase-order/detail/".$datapo->ppb_id);
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

    public function checkPO($id)
    {

        $data = CategoryPengajuanPembelian::find($id);
        if(empty($data->atasan_po)){
            return redirect()->back()->withErrors(["Approver Not Found"]);
        }else{
        $data->status = 'Cross Check PO';
        $data->save();
        return redirect('menu-purchase-order');
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
