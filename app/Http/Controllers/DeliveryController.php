<?php

namespace App\Http\Controllers;

use App\Exports\PembelianExport;
use App\Models\CategoryEcommerce;
use App\Models\CategoryPengajuanPembelian;
use App\Models\CategoryPO;
use App\Models\CategoryPP;
use App\Models\CategoryPT;
use App\Models\Delivery;
use Illuminate\Http\Request;
use App\Imports\PengajuanImport;
use App\File;
use App\Models\Comment;
use App\Models\DeliveryTrack;
use App\Models\Department;
use App\Models\ItemPO;
use App\Models\PengajuanPembelian;
use App\Models\WhoSubmitted;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $check = Auth::user();
        if ($check->role_id == 3 || $check->role_id == 20 || $check->role_id == 4 || $check->role_id == 17) {

            if($check->role_id == 20){
                $datappb = CategoryPengajuanPembelian::select('category_pengajuan_pembelian.*')
                ->join('category_po as quot', 'quot.ppb_id', '=', 'category_pengajuan_pembelian.id')
                ->whereIn('quot.status', ['PO & Payment Approved', 'Unpaid', 'Paid','Delivery Success'])
                ->where(function($query) {
                    $query->where('quot.flag_delivery', '!=', 2)
                        ->orWhereNull('quot.flag_delivery'); // Ambil yang bukan 2 atau yang null
                })
                ->where('quot.status', 'not like', '%Rejected%')
                ->where('category_pengajuan_pembelian.status', 'not like', '%Rejected%')
                ->orderByRaw('ISNULL(quot.first_estimate), quot.first_estimate ASC')
                ->orderBy('category_pengajuan_pembelian.dateline', 'asc')
                ->orderBy('category_pengajuan_pembelian.approved_at', 'asc')
                ->groupBy('category_pengajuan_pembelian.id')
                ->paginate(10, ['*'], 'in');
            }else {
                $datappb = CategoryPengajuanPembelian::whereHas('quot',function($i){
                    $i->whereIn('status',['PO & Payment Approved','Unpaid','Paid','Delivery Success'])
                    ->where(function($query) {
                        $query->where('flag_delivery', '!=', 2)
                            ->orWhereNull('flag_delivery'); // Ambil yang bukan 2 atau yang null
                    })
                    ->where('status', 'not like', '%Rejected%');
                })
                ->where('status', 'not like', '%Rejected%')
                ->orderBy('created_at','desc')
                ->orderBy('dateline', 'asc')
                ->orderBy('approved_at','asc')
                ->paginate(10, ['*'],'in');
            }

            return view('delivery.menu.index')
            ->with('datappb',$datappb);

        }else {
            return redirect()->route('dashboard');
        }
    }

    public function SearchDeliveryIn(Request $request)
    {


     $check = Auth::user();
     $cari = $request->cariIn;

        if ($check->role_id == 3 || $check->role_id == 20 || $check->role_id == 4 || $check->role_id == 17) {

            if($check->role_id == 20){
                $datappb = CategoryPengajuanPembelian::select('category_pengajuan_pembelian.*')
                ->join('category_po as quot', 'quot.ppb_id', '=', 'category_pengajuan_pembelian.id')
                ->whereIn('quot.status', ['PO & Payment Approved', 'Unpaid', 'Paid'])
                ->where('quot.status', 'not like', '%Rejected%')
                ->where(function($query) {
                    $query->where('quot.flag_delivery', '!=', 2)
                        ->orWhereNull('quot.flag_delivery'); // Ambil yang bukan 2 atau yang null
                })
                ->where('category_pengajuan_pembelian.status', 'not like', '%Rejected%')
                ->where(function($query) use ($cari) {
                    $query->where('category_pengajuan_pembelian.id', 'like', "%" . $cari . "%")
                        ->orWhere('category_pengajuan_pembelian.status', 'like', "%" . $cari . "%")
                        ->orWhere('category_pengajuan_pembelian.desc', 'like', "%" . $cari . "%")
                        ->orWhere('category_pengajuan_pembelian.code_pengajuan', 'like', "%" . $cari . "%")
                        ->orWhereHas('whosubmit', function($query) use ($cari) {
                            $query->where('name', 'like', "%" . $cari . "%");
                        })
                        ->orWhereHas('itemppn', function($query) use ($cari) {
                            $query->where('item', 'like', "%" . $cari . "%");
                        })
                        ->orWhereHas('quot', function($query) use ($cari) {
                            $query->where('quot.id', 'like', "%" . $cari . "%")
                                ->orWhere('quot.code_po', 'like', "%" . $cari . "%")
                                ->orWhere('quot.status', 'like', "%" . $cari . "%")
                                ->orWhere('quot.no_resi', 'like', "%" . $cari . "%")
                                ->where('quot.status', 'not like', '%Rejected%');
                        });
                })
                ->orderByRaw('ISNULL(quot.first_estimate), quot.first_estimate ASC')
                ->orderBy('category_pengajuan_pembelian.dateline', 'asc')
                ->orderBy('category_pengajuan_pembelian.approved_at', 'asc')
                ->groupBy('category_pengajuan_pembelian.id')
                ->paginate(10, ['*'], 'in');
            }else {
                $datappb = CategoryPengajuanPembelian::where(function($query) use ($cari) {
                    $query->whereHas('quot', function($q) {
                            $q->whereIn('status',['PO & Payment Approved','Unpaid','Paid','Delivery Success'])
                            ->where(function($query) {
                                $query->where('flag_delivery', '!=', 2)
                                    ->orWhereNull('flag_delivery'); // Ambil yang bukan 2 atau yang null
                            })
                            ->where('status', 'not like', '%Rejected%');
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
                                ->orWhere('code_po', 'like', "%" . $cari . "%")
                                ->orWhere('status', 'like', "%" . $cari . "%")
                                ->orWhere('no_resi', 'like', "%" . $cari . "%");
                            });
                        });
                    })
                    ->orderBy('created_at', 'desc')
                    ->orderBy('dateline', 'asc')
                    ->orderBy('approved_at','asc')
                    ->paginate(10, ['*'], 'in');
            }

            return view('delivery.menu.index')
            ->with('datappb',$datappb);
        }else {
            return redirect()->back();
        }

    }
    public function out()
    {
        $check = Auth::user();
        if ($check->role_id == 20 || $check->role_id == 3 || $check->role_id == 4 || $check->role_id == 17) {
            $datappb = CategoryPengajuanPembelian::where('status','Delivery Success')
            ->orderBy('status', 'asc')->orderBy('dateline', 'asc')
            ->orderBy('approved_at','asc')->paginate(10, ['*'],'out');
            $pt = CategoryPT::all();
            $op = CategoryPP::all();
            $ec = CategoryEcommerce::all();
            $datapo = CategoryPO::all();
            return view('delivery.menu.out')
                ->with('pt',$pt)
                ->with('op',$op)
                ->with('ec',$ec)
                ->with('datappb',$datappb)
                ->with('datapo', $datapo);
        }
    }

    public function SearchDeliveryOut(Request $request)
    {
     $cari = $request->cariOut;
     $datappb = CategoryPengajuanPembelian::orderBy('status', 'desc')->orderBy('dateline', 'asc')->orderBy('approved_at', 'asc')
     ->orWhere('id','like',"%".$cari."%")
     ->orWhere('status','like',"%".$cari."%")
     ->orWhere('desc','like',"%".$cari."%")
     ->orWhereHas('whosubmit', function($q) use($cari){
          $q->where('name','like',"%".$cari."%");
     })
     ->paginate(10, ['*'], 'out');

     return view('delivery.menu.index')
     ->with('datappb',$datappb);
    }


    public function history()
    {
        $check = Auth::user();
        if ($check->role_id == 20 || $check->role_id == 3 || $check->role_id == 4 || $check->role_id == 17) {
            // kalau PR Status Belum Delivery Success
            // Tapi PO nya sudah punya flag 2 atau statusnya sudah delivery sucess maka tampilkan
            // sisanya yang sudah delivery sucess PRnya tampilin walau POnya masi nyangkut dan diannggap selesai POnya

            $datappb = CategoryPengajuanPembelian::select('category_pengajuan_pembelian.*')
            ->join('category_po as quot', 'quot.ppb_id', '=', 'category_pengajuan_pembelian.id')
            ->where('quot.status', 'not like', '%Rejected%')
            ->where('category_pengajuan_pembelian.status', 'not like', '%Rejected%')
            ->where(function($query) {
                // Jika PR belum "Delivery Success" tapi PO sudah punya flag 2 atau status PO sudah "Delivery Success"
                $query->where(function($q) {
                    $q->where('category_pengajuan_pembelian.status', '!=', 'Delivery Success')
                      ->where(function($subQuery) {
                          $subQuery->where('quot.flag_delivery', 2)
                                   ->orWhere('quot.status', 'Delivery Success');
                      });
                })
                // Atau PR sudah "Delivery Success", ditampilkan meskipun PO belum selesai
                ->orWhere('category_pengajuan_pembelian.status', 'Delivery Success');
            })
            ->orderByRaw('ISNULL(quot.first_estimate), quot.first_estimate ASC')
            ->orderBy('category_pengajuan_pembelian.created_at', 'desc')
            ->orderBy('category_pengajuan_pembelian.dateline', 'asc')
            ->orderBy('category_pengajuan_pembelian.approved_at', 'asc')
            ->groupBy('category_pengajuan_pembelian.id')
            // ->get();
            ->paginate(10, ['*'], 'in');
            // $datappb = CategoryPengajuanPembelian::where('status','Delivery Success')->paginate(10);
            $pt = CategoryPT::all();
            $op = CategoryPP::all();
            $ec = CategoryEcommerce::all();
            $datapo = CategoryPO::all();
            return view('delivery.menu.history')
                ->with('pt',$pt)
                ->with('op',$op)
                ->with('ec',$ec)
                ->with('datappb',$datappb)
                ->with('datapo', $datapo);
        }else {
            return redirect()->route('dashboard');
        }
    }

    public function SearchHistoryDelivery(Request $request)
    {
     $cari = $request->cari;
     $datappb = CategoryPengajuanPembelian::select('category_pengajuan_pembelian.*')
     ->join('category_po as quot', 'quot.ppb_id', '=', 'category_pengajuan_pembelian.id')
     ->where('quot.status', 'not like', '%Rejected%')
     ->where('category_pengajuan_pembelian.status', 'not like', '%Rejected%')
     ->where(function($query) {
         // Jika PR belum "Delivery Success" tapi PO sudah punya flag 2 atau status PO sudah "Delivery Success"
         $query->where(function($q) {
             $q->where('category_pengajuan_pembelian.status', '!=', 'Delivery Success')
               ->where(function($subQuery) {
                   $subQuery->where('quot.flag_delivery', 2)
                            ->orWhere('quot.status', 'Delivery Success');
               });
         })
         // Atau PR sudah "Delivery Success", ditampilkan meskipun PO belum selesai
         ->orWhere('category_pengajuan_pembelian.status', 'Delivery Success');
     })
     ->where(function($search) use($cari) {
        $search->where('category_pengajuan_pembelian.id', 'like', "%" . $cari . "%")
            ->orWhere('category_pengajuan_pembelian.status', 'like', "%" . $cari . "%")
            ->orWhere('category_pengajuan_pembelian.desc', 'like', "%" . $cari . "%")
            ->orWhere('category_pengajuan_pembelian.code_pengajuan', 'like', "%" . $cari . "%")
            ->orWhereHas('whosubmit', function($search) use ($cari) {
                $search->where('name', 'like', "%" . $cari . "%");
            })
            ->orWhereHas('itemppn', function($search) use ($cari) {
                $search->where('item', 'like', "%" . $cari . "%");
            })
            ->orWhereHas('quot', function($search) use ($cari) {
                $search->where('quot.id', 'like', "%" . $cari . "%")
                    ->orWhere('quot.code_po', 'like', "%" . $cari . "%")
                    ->orWhere('quot.status', 'like', "%" . $cari . "%")
                    ->orWhere('quot.no_resi', 'like', "%" . $cari . "%")
                    ->orWhereHasMorph(
                        'vendorable',
                        [CategoryPT::class, CategoryPP::class, CategoryEcommerce::class],
                        function ($query) use ($cari) {
                            $query->where('nama', 'like', "%" . $cari . "%");
                        }
                    )
                    ->where('quot.status', 'not like', '%Rejected%');
            });
     })
     ->orderByRaw('ISNULL(quot.first_estimate), quot.first_estimate ASC')
     ->orderBy('category_pengajuan_pembelian.created_at', 'desc')
     ->orderBy('category_pengajuan_pembelian.dateline', 'asc')
     ->orderBy('category_pengajuan_pembelian.approved_at', 'asc')
     ->groupBy('category_pengajuan_pembelian.id')
     ->paginate(10);

     return view('delivery.menu.history')
     ->with('datappb',$datappb);
    }

    public function SortHistoryDelivery(Request $request)
    {
     $sort = $request->sort;
     $datappb = CategoryPengajuanPembelian::whereIn('status',$sort)->paginate(10);
     $datapo = CategoryPO::get();
     return view('delivery.menu.history')
     ->with('datappb',$datappb)
     ->with('datapo',$datapo)
     ->with('sort',$sort);
    }

    public function create($id)
    {
        $check = Auth::user();
        if ($check->role_id == 3 || $check->role_id == 20 || $check->role_id == 4 || $check->role_id == 17) {
            $dv = CategoryPengajuanPembelian::find($id);
            return view('delivery.menu.create')
            ->with('dv' , $dv);
        }else {
            return redirect()->route('dashboard');
        }
    }
    public function detail($id)
    {
        $check = Auth::user();
        if ($check->role_id == 3 || $check->role_id == 20 || $check->role_id == 4 || $check->role_id == 17) {
            $data_pengajuan     = CategoryPengajuanPembelian::find($id);
            $pengajuan          = PengajuanPembelian::where('pp_id', $id)->get();
            $vendor             = CategoryPO::where('ppb_id',$id)->first();
            $items              = CategoryPO::where('ppb_id',$id)->get();
            $groupedItem        = ItemPO::groupBy('po_id')->get();
            $dataws             = WhoSubmitted::all();
            $datadepartment     = Department::all();
            $delivery           = Delivery::where('ppb_id', $id)->get();
            $dpp                = PengajuanPembelian::selectRaw('pp_id,SUM(total) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
            $ppn                = PengajuanPembelian::selectRaw('pp_id,SUM(total *11/100) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
            $total              = PengajuanPembelian::selectRaw('pp_id,SUM((total)+(total*11/100)) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
            $total_tnpa_ppn     = PengajuanPembelian::selectRaw('pp_id,SUM(total) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
            $disc               = PengajuanPembelian::where('pp_id',$id)->first();
            $status             = DeliveryTrack::where('ppb_id', $id)->get();
            return view('delivery.menu.detail')
            ->with('pengajuan', $pengajuan)
            ->with('dpp', $dpp)
            ->with('delivery',$delivery)
            ->with('vendor',$vendor)
            ->with('items', $items)
            ->with('groupedItem', $groupedItem)
            ->with('dataws', $dataws)
            ->with('datadepartment', $datadepartment)
            ->with('ppn', $ppn)
            ->with('total', $total)
            ->with('total_tnpa_ppn', $total_tnpa_ppn)
            ->with('data_pengajuan', $data_pengajuan)
            ->with('disc', $disc)
            ->with('status', $status);
        }else {
            return redirect()->route('dashboard');
        }
    }

    public function track_po($id)
    {
        $po = CategoryPO::find($id);
        return view('delivery.menu.tracking.index',compact('po'));
    }
    public function po_detail($id)
    {
        $check = Auth::user();
        if ($check->role_id == 3 || $check->role_id == 20 || $check->role_id == 4 || $check->role_id == 17) {
            $datapo             = CategoryPO::where('id', $id)->get();
            $datacpo            = CategoryPO::find($id);
            $pengajuan          = PengajuanPembelian::where('pp_id', $datacpo->ppb_id)->get();
            $dpp                = PengajuanPembelian::selectRaw('pp_id,SUM(total) as total')->groupBy('pp_id')->where('pp_id', $datacpo->ppb_id)->get();
            $ppn                = PengajuanPembelian::selectRaw('pp_id,SUM(total *11/100) as total')->groupBy('pp_id')->where('pp_id', $datacpo->ppb_id)->get();
            $total              = PengajuanPembelian::selectRaw('pp_id,SUM((total)+(total*11/100)) as total')->groupBy('pp_id')->where('pp_id', $datacpo->ppb_id)->get();
            $total_tnpa_ppn     = PengajuanPembelian::selectRaw('pp_id,SUM(total) as total')->groupBy('pp_id')->where('pp_id', $datacpo->ppb_id)->get();
            $disc               = PengajuanPembelian::where('pp_id',$datacpo->ppb_id)->first();
            $comments           = Comment::where('ppb_id',$id)->get();

            return view('delivery.menu.po')
                ->with('pengajuan', $pengajuan)
                ->with('dpp', $dpp)
                ->with('datapo', $datapo)
                ->with('datacpo', $datacpo)
                ->with('ppn', $ppn)
                ->with('total', $total)
                ->with('total_tnpa_ppn', $total_tnpa_ppn)
                ->with('disc', $disc)
                ->with('comments', $comments);
        }else {
            return redirect()->route('dashboard');
        }
    }


    public function startShip(Request $request, $id)
    {
        $check = Auth::user();
        if ($check->role_id == 3 || $check->role_id == 20 || $check->role_id == 4 || $check->role_id == 17) {
            $request->validate([
                'no_resi' => 'required',
                'first_estimate' => 'required',
                'last_estimate' => 'required',
            ]);

            $cpo = CategoryPO::find($id);
            $ppb = CategoryPengajuanPembelian::where('id',$cpo->ppb->id)->first();

            DeliveryTrack::create([
                'po_id'         => $cpo->id,
                'ppb_id'        => $ppb->id,
                'status'        => 'Start Shipping',
                'creator_id'    => Auth::user()->id,
                'creator_name'  => Auth::user()->name,
            ]);

            $cpo->no_resi = $request->no_resi;
            $cpo->first_estimate = $request->first_estimate;
            $cpo->last_estimate = $request->last_estimate;
            $cpo->flag_delivery = 1; //Waiting For Delivery
            $cpo->save();
            return redirect()->back();
        }else {
            return redirect()->route('dashboard');
        }
    }

    public function deliverystatus(Request $request, $id)
    {
        $check = Auth::user();
        if ($check->role_id == 3 || $check->role_id == 20 || $check->role_id == 4 || $check->role_id == 17) {
            $cpo = CategoryPO::find($id);
            $ppb = CategoryPengajuanPembelian::where('id',$cpo->ppb->id)->first();
            DeliveryTrack::create([
                'po_id'         => $cpo->id,
                'ppb_id'        => $ppb->id,
                'status'        => $request->status,
                'creator_id'    => Auth::user()->id,
                'creator_name'  => Auth::user()->name,
            ]);
            if($cpo->flag_delivery == 0){
                $cpo->flag_delivery = 1; //Waiting For Delivery
                $cpo->save();
            }
            return redirect()->back();
        }else {
            return redirect()->route('dashboard');
        }
    }

    public function endShip(Request $request, $id)
    {
        $check = Auth::user();
        if ($check->role_id == 3 || $check->role_id == 20 || $check->role_id == 4 || $check->role_id == 17) {
            $cpo = CategoryPO::find($id);
            $ppb = CategoryPengajuanPembelian::where('id',$cpo->ppb->id)->first();

            $request->validate([
                'path_image' => 'file|mimes:jpg,png,jpeg,gif,svg,pdf,docx|max:2048',
                'receiver' => 'required',
            ]);

            DeliveryTrack::create([
                'po_id'         => $cpo->id,
                'ppb_id'        => $ppb->id,
                'status'        => 'Package has arrivved',
                'creator_id'    => Auth::user()->id,
                'creator_name'  => Auth::user()->name,
            ]);

            $cpo->flag_delivery = 2; //Waiting For Delivery
            $cpo->save();



            $pengajuan        = $ppb->id;

            if($request->hasFile('path_image')){
                $path_name        = $request->file('path_image');
                $name             = $path_name->getClientOriginalName();
                $path_name->move('images', $name);
            }
            $receiver         = $request->receiver;


            // Savings Report Delivery
            $save = new Delivery;
            $save->ppb_id     = $pengajuan;
            $save->po_id      = $cpo->id;
            $save->path_image = $name ?? '';
            $save->receiver   = $receiver;
            $save->save();


            return redirect()->back();
        }else {
            return redirect()->route('dashboard');
        }
    }
    //setBackShippy

    public function setBackShippy($id)
    {
        $check = Auth::user();
        if ($check->role_id == 3 || $check->role_id == 20 || $check->role_id == 4 || $check->role_id == 17) {
            $cpo = CategoryPO::find($id);
            $ppb = CategoryPengajuanPembelian::where('id',$cpo->ppb->id)->first();

            DeliveryTrack::create([
                'po_id'         => $cpo->id,
                'ppb_id'        => $ppb->id,
                'status'        => 'The status has been reset to waiting delivery again',
                'creator_id'    => Auth::user()->id,
                'creator_name'  => Auth::user()->name,
            ]);

            $cpo->flag_delivery = 1; //Waiting For Delivery
            $cpo->save();
            return redirect()->back();
        }else {
            return redirect()->route('dashboard');
        }
    }

    public function store(Request $request, $id )
    {
        $check = Auth::user();
        if ($check->role_id == 3 || $check->role_id == 20 || $check->role_id == 4 || $check->role_id == 17) {
            $cpo = CategoryPO::find($id);
            $data = CategoryPengajuanPembelian::where('id',$cpo->ppb->id)->first();
            $request->validate([
                'path_image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);

            $pengajuan        = $data->id;
            $path_name        = $request->file('path_image');
            $name             = $path_name->getClientOriginalName();
            $path_name->move('images', $name);
            $receiver         = $request->receiver;

            //    $data = $request->all();

            $save = new Delivery;
            $save->ppb_id     = $pengajuan;
            $save->po_id      = $cpo->id;
            $save->path_image = $name;
            $save->receiver   = $receiver;
            $save->save();

            return redirect()->back()->with('status', 'Report Has been uploaded successfully');
        }else {
            return redirect()->route('dashboard');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function show(Delivery $delivery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function edit(Delivery $delivery,$id)
    {
        $check = Auth::user();
        if ($check->role_id == 3 || $check->role_id == 20 || $check->role_id == 4 || $check->role_id == 17) {
            $dv  = CategoryPengajuanPembelian::find($id);
            $delivery = Delivery::where('ppb_id',$id)->get();

            return view('delivery.menu.edit')
            ->with('delivery', $delivery)
            ->with('dv' , $dv);
        }else{
            return redirect()->route('dashboard');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Delivery $delivery,$id)
    {
        $check = Auth::user();
        if ($check->role_id == 3 || $check->role_id == 20 || $check->role_id == 4 || $check->role_id == 17) {
            $data = CategoryPengajuanPembelian::find($id);
            $request->validate([
                'path_image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                'receiver'   => 'required',
            ]);
            $pengajuan        = $data->id;
            $path_name        = $request->file('path_image');
            $name             = $path_name->getClientOriginalName();
            $path_name->move('images', $name);
            $receiver         = $request->receiver;

                Delivery::where('ppb_id',$id)->update([
                'path_image' => $name,
                'receiver' => $receiver,
            ]);
            return redirect('/delivery')->with('status', 'Data Has been Updated successfully');
        }else{
            return redirect()->route('dashboard');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Delivery $delivery)
    {
        //
    }

    public function complete($id)
    {
        $check = Auth::user();
        if ($check->role_id == 3 || $check->role_id == 20 || $check->role_id == 4 || $check->role_id == 17) {
            $data = CategoryPengajuanPembelian::find($id);
            $data->status = 'Delivery Success';
            $data->save();
            CategoryPO::where('ppb_id',$id)->update([
                'status' => 'Delivery Success'
            ]);
            return redirect('delivery');
        }else{
            return redirect()->route('dashboard');
        }
    }

    public function denied($id)
    {
        $check = Auth::user();
        if ($check->role_id == 3 || $check->role_id == 20 || $check->role_id == 4 || $check->role_id == 17) {
            $data = CategoryPO::find($id);
            $data->status = 'Rejected By Purchasing';
            $data->save();
            CategoryPO::where('ppb_id',$id)->update([
                'status' => 'Rejected By Purchasing'
            ]);
            return redirect('menu-purchase-order');
        }else {
            return redirect()->route('dashboard');
        }
    }

    //Generate Token Gerry
    private function getToken()
    {
        $loginServiceUrl = env('LOGIN_SERVICE_URL');
        $response = Http::post($loginServiceUrl, [
            'email' => env('EMAIL_SERVICE_URL'),
            'password' => env('PASSWORD_SERVICE_URL'),
        ]);

        if (!empty($response['status'])) {
            if ($response['status'] == 200) {
                $userData = $response['user'];
                $token = $response['token'];
                dd($response);
                Session::put('token', $token);
            }
        }
    }

//Check Token US
    private function CheckToken($token)
    {
        if($token){
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->get('https://gerry.intek.co.id/api/check-token');
            if ($response->successful() && $response['valid']) {
                // Token masih valid, lanjutkan ke rute yang diminta
                return true;
            }else {
                return false;
            }
        }
    }


    private function pushStocky($id,$qty)
    {
        $tokenGerry = Session::get('token');

        $checking = $this->CheckToken($tokenGerry);

        $items= [];

        if(!$checking){
            $this->getToken();
        }else {
            $url = env('URL_STOCKY').'/incoming_product_api/'.$id;
            $response = Http::withHeaders([
                'Authorization' => 'Bearer '. $tokenGerry,
            ])->post($url,['qty'=>$qty]);

            if($response->successful()) {

            }else {
                
            }
        }
    }

    public function complete_2($id)
    {
        $check = Auth::user();
        if ($check->role_id == 3 || $check->role_id == 20 || $check->role_id == 4 || $check->role_id == 17) {
            $cpo = CategoryPO::find($id);
            $pr = CategoryPengajuanPembelian::find($cpo->ppb_id);
            $lastQuot = $pr->quot->last();

            CategoryPO::where('id',$id)->update([
                'status' => 'Delivery Success'
            ]);

            $itemPO = ItemPO::where('po_id', $id)->get();

            foreach($itemPO as $itemp){
                if(!empty($itemp->product_id)){
                    $this->pushStocky($itemp->product_id, $itemp->qty);
                }
            }

            if($cpo->id == $lastQuot->id && $pr->status == $cpo->status){
                $data = CategoryPengajuanPembelian::where('id', $cpo->ppb->id)->update([
                    'status' => 'Delivery Success',
                ]);
            }
            return redirect('delivery');
        }else{
            return redirect()->route('dashboard');
        }
    }

    public function denied_2($id)
    {
        $check = Auth::user();
        if ($check->role_id == 3 || $check->role_id == 20 || $check->role_id == 4 || $check->role_id == 17) {
            $data = CategoryPO::find($id);
            $data->status = 'Rejected By Purchasing';
            $data->save();
            CategoryPO::where('ppb_id',$id)->update([
                'status' => 'Rejected By Purchasing'
            ]);
            return redirect('menu-purchase-order');
        }else {
            return redirect()->route('dashboard');
        }
    }

    public function export()
    {
        return Excel::download(new PembelianExport(), 'Pembelian Import.xlsx');
    }
    public function fileImportPPB(){
        return view('delivery.menu.import');
    }

    public function fileImport(Request $request)
    {

        // try {

		// menangkap file excel
		$file = $request->file('file');

		// membuat nama file unik
		$nama_file = rand().$file->getClientOriginalName();

		// upload ke folder file_siswa di dalam folder public
		$file->move('upload_pengajuan',$nama_file);

		// import data
		Excel::import(new PengajuanImport , public_path('/upload_pengajuan/'.$nama_file));

		// alihkan halaman kembali
		return redirect('/delivery');
        // } catch (\Exception $e) {
            // return redirect()->back()->withErrors([$e->getMessage()]);
        // }
    }

    //Tracking DHL

    public function trackDHL()
    {
        return view('delivery.menu.tracking.dhl.index');
    }

    //Tracking Fedex
    public function trackFedex()
    {
        return view('delivery.menu.tracking.fedex.fedex');
    }

}
