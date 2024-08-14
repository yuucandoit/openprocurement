<?php

namespace App\Http\Controllers;

use App\Exports\PPBExport;
use App\Models\Pre_pr;
use App\Models\PartItem_Pre_pr;
use App\Models\CategoryEcommerce;
use App\Models\CategoryPengajuanPembelian;
use App\Models\CategoryPO;
use App\Models\CategoryPP;
use App\Models\CategoryPT;
use App\Models\Comment;
use App\Models\Delivery;
use App\Models\Department;
use App\Models\Inventory;
use App\Models\Office;
use App\Models\PengajuanPembelian;
use App\Models\ReferensiNamaProject;
use App\Models\RND;
use App\Models\Role;
use App\Models\Travel;
use App\Models\User;
use App\Models\WhoSubmitted;
use App\Models\Workshop;
use App\Models\Uom;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Calculation\Category;
use Illuminate\Support\Facades\Session;

class CategoryPengajuanPembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $check = Role::where('model_id', Auth::user()->id)->first();
        if ($check->role_id == 2 || $check->role_id == 18) {
            $user   = User::where('id', Auth::user()->id)->get();
            $datapt = CategoryPT::all();
            $dataop = CategoryPP::all();
            $dataec = CategoryEcommerce::all();
            $dataws = WhoSubmitted::all();
            $datadepartment = Department::all();
            $purpose = ReferensiNamaProject::all();
            $atasan = User::whereIn('id', [3, 6, 7, 8, 9])->get();
            $datadv = CategoryPengajuanPembelian::where('user_id', Auth::user()->id)->orderBy('id','DESC')->orderBy('date_ps','DESC')->orderBy('created_at','ASC')->paginate(10);
            // $datapo = CategoryPO::get();
            // $count  = \App\Models\CategoryPengajuanPembelian::where('user_id',Auth::user()->id)->count();
            $comments = Comment::where('user_id',Auth::user()->id)->count();
            // dd($count);
           // $progress = Delivery::where('ppb_id');
            return view('pengajuanPembelian.menu.index')
                ->with('user', $user)
                ->with('datapt', $datapt)
                ->with('dataop', $dataop)
                ->with('dataec', $dataec)
                ->with('atasan', $atasan)
                ->with('purpose', $purpose)
                ->with('datadv', $datadv)
                ->with('dataws', $dataws)
                ->with('comments', $comments)
                // ->with('datapo', $datapo)
                ->with('datadepartment', $datadepartment);
        } else if ($check->role_id == 1 || $check->role_id == 3) {
            $user = User::where('id', Auth::user()->id)->get();
            $datapt = CategoryPT::all();
            // $datapo = CategoryPO::get();
            $dataop = CategoryPP::all();
            $dataec = CategoryEcommerce::all();
            $dataws = WhoSubmitted::all();
            $datadepartment = Department::all();
            $purpose = ReferensiNamaProject::all();
            $atasan = User::whereIn('id', [3, 6, 7, 8, 9])->get();
            $datadv = CategoryPengajuanPembelian::orderBy('date_ps','DESC')->paginate(10);

            $comments = Comment::where('user_id',Auth::user()->id)->count();
            // dd($comments);


            return view('pengajuanPembelian.menu.index')
                ->with('user', $user)
                ->with('datapt', $datapt)
                // ->with('datapo', $datapo)
                ->with('dataop', $dataop)
                ->with('dataec', $dataec)
                ->with('atasan', $atasan)
                ->with('purpose', $purpose)
                ->with('datadv', $datadv)
                ->with('dataws', $dataws)
                ->with('comments', $comments)
                ->with('datadepartment', $datadepartment);
        }
    }

    public function SearchPRQ(Request $request)
   {
    $cari = $request->cari;
    //dd($cari);
    $dataws = WhoSubmitted::all();
    $datadv = CategoryPengajuanPembelian::Where('id','like',"%".$cari."%")
    ->orWhere('status','like',"%".$cari."%")
    ->orWhere('desc','like',"%".$cari."%")
    ->orWhereHas('whosubmit', function($q) use($cari){
         $q->where('name','like',"%".$cari."%");
    })
    ->where('user_id',Auth::user()->id)
    ->paginate(10);
    $datapo = CategoryPO::get();

    return view('pengajuanPembelian.menu.index')
    ->with('datadv',$datadv)
    ->with('datapo', $datapo)
    ->with('dataws',$dataws);
   }

    public function detail($id)
    {
        $check = Role::where('model_id', Auth::user()->id)->first();
        $data_pengajuan     = CategoryPengajuanPembelian::find($id);
        $pengajuan          = PengajuanPembelian::where('pp_id', $id)->get();
        $atasan             = User::whereIn('id', [3, 6, 7, 8, 9])->get();
        $delivery           = Delivery::where('ppb_id', $id)->get();
        $datacpo            = CategoryPO::where('ppb_id', $id)->first();
        $dpp                = PengajuanPembelian::selectRaw('pp_id,SUM(total) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $ppn                = PengajuanPembelian::selectRaw('pp_id,SUM(total *11/100) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $total              = PengajuanPembelian::selectRaw('pp_id,SUM((total)+(total*11/100)) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $total_tnpa_ppn     = PengajuanPembelian::selectRaw('pp_id,SUM(total) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $disc               = PengajuanPembelian::where('pp_id',$id)->first();
        $purpose            = ReferensiNamaProject::all();
        $dataws             = WhoSubmitted::all();
        $datadepartment     = Department::all();
        $comments           = Comment::where('ppb_id',$id)->get();
        if ($check->role_id == 2 || $check->role_id == 18) {
            if(Auth::user()->id == $data_pengajuan->user_id){
            return view('pengajuanPembelian.menu.detail')
                ->with('atasan', $atasan)
                ->with('pengajuan', $pengajuan)
                ->with('delivery', $delivery)
                ->with('dpp', $dpp)
                ->with('ppn', $ppn)
                ->with('datacpo', $datacpo)
                ->with('total', $total)
                ->with('disc', $disc)
                ->with('total_tnpa_ppn', $total_tnpa_ppn)
                ->with('purpose', $purpose)
                ->with('data_pengajuan', $data_pengajuan)
                ->with('dataws', $dataws)
                ->with('datadepartment', $datadepartment)
                ->with('comments', $comments);
            } else {
                return redirect()->route('dashboard');
            }
        }else if ($check->role_id == 1 || $check->role_id == 3) {
            return view('pengajuanPembelian.menu.detail')
                ->with('atasan', $atasan)
                ->with('pengajuan', $pengajuan)
                ->with('delivery', $delivery)
                ->with('dpp', $dpp)
                ->with('ppn', $ppn)
                ->with('datacpo', $datacpo)
                ->with('total', $total)
                ->with('disc', $disc)
                ->with('total_tnpa_ppn', $total_tnpa_ppn)
                ->with('purpose', $purpose)
                ->with('data_pengajuan', $data_pengajuan)
                ->with('dataws', $dataws)
                ->with('datadepartment', $datadepartment)
                ->with('comments', $comments);
        }
    }

    public function po_detail($id)
    {
        $check = Role::where('model_id', Auth::user()->id)->first();
        $code               = CategoryPO::find($id);
        $datapo             = CategoryPO::where('id', $id)->get();
        $datacpo            = CategoryPO::where('id', $id)->first();
        $pengajuan          = PengajuanPembelian::where('pp_id', $datacpo->ppb_id)->get();
        $dataws             = WhoSubmitted::all();
        $datadepartment     = Department::all();
        $dpp                = PengajuanPembelian::selectRaw('pp_id,SUM(total) as total')->groupBy('pp_id')->where('pp_id', $datacpo->ppb_id)->get();
        $ppn                = PengajuanPembelian::selectRaw('pp_id,SUM(total *11/100) as total')->groupBy('pp_id')->where('pp_id', $datacpo->ppb_id)->get();
        $total              = PengajuanPembelian::selectRaw('pp_id,SUM((total)+(total*11/100)) as total')->groupBy('pp_id')->where('pp_id', $datacpo->ppb_id)->get();
        $total_tnpa_ppn     = PengajuanPembelian::selectRaw('pp_id,SUM(total) as total')->groupBy('pp_id')->where('pp_id', $datacpo->ppb_id)->get();
        $comments           = Comment::where('ppb_id',$id)->get();
        $disc               = PengajuanPembelian::where('pp_id',$id)->first();

        //dd($datacpo);
        if ($check->role_id == 2 || $check->role_id == 18) {
            if(!empty($code->ppb->user_id )){
                if($code->ppb->user_id == Auth::user()->id){
                return view('pengajuanPembelian.menu.po')
                    ->with('pengajuan', $pengajuan)
                    ->with('dpp', $dpp)
                    ->with('code', $code)
                    ->with('datapo', $datapo)
                    ->with('dataws', $dataws)
                    ->with('datacpo', $datacpo)
                    ->with('datadepartment', $datadepartment)
                    ->with('ppn', $ppn)
                    ->with('total', $total)
                    ->with('total_tnpa_ppn', $total_tnpa_ppn)
                    ->with('disc', $disc)
                    ->with('comments', $comments);
                }else {
                    return redirect()->route('dashboard');
                }
            } else {
                return view('pengajuanPembelian.menu.po')
                    ->with('pengajuan', $pengajuan)
                    ->with('dpp', $dpp)
                    ->with('code', $code)
                    ->with('datapo', $datapo)
                    ->with('dataws', $dataws)
                    ->with('datacpo', $datacpo)
                    ->with('datadepartment', $datadepartment)
                    ->with('ppn', $ppn)
                    ->with('total', $total)
                    ->with('total_tnpa_ppn', $total_tnpa_ppn)
                    ->with('disc', $disc)
                    ->with('comments', $comments);
            }

        } else if ($check->role_id == 1 || $check->role_id == 3) {
                    return view('pengajuanPembelian.menu.po')
                    ->with('pengajuan', $pengajuan)
                    ->with('dpp', $dpp)
                    ->with('code', $code)
                    ->with('datapo', $datapo)
                    ->with('dataws', $dataws)
                    ->with('datacpo', $datacpo)
                    ->with('datadepartment', $datadepartment)
                    ->with('ppn', $ppn)
                    ->with('total', $total)
                    ->with('total_tnpa_ppn', $total_tnpa_ppn)
                    ->with('disc', $disc)
                    ->with('comments', $comments);
        }
    }

    public function history()
    {
        $check = Role::where('model_id', Auth::user()->id)->first();
        $datappb = CategoryPengajuanPembelian::where('user_id',Auth::user()->id)->where('status','Delivery Success')->paginate(10);
        if ($check->role_id == 2 || $check->role_id == 18 ){
            $ppb = CategoryPengajuanPembelian::where('user_id',Auth::user()->id)->first();

            if(!empty($ppb)){
                if($ppb->user_id == Auth::user()->id){
                    return view('pengajuanPembelian.menu.history')
                    ->with('datappb', $datappb);
                }else {
                    return redirect()->route('dashboard');
                }
            }else {
                return view('pengajuanPembelian.menu.history')
                ->with('datappb', $datappb);
            }

        }else if ($check->role_id == 1 || $check->role_id == 3) {
            return view('pengajuanPembelian.menu.history')
            ->with('datappb', $datappb);
        }
    }



    public function SearchHistoryPRQ(Request $request)
    {
     $cari = $request->cari;
     //dd($cari);=
     $datappb = CategoryPengajuanPembelian::where('id','like',"%".$cari."%")
     ->orWhere('status','like',"%".$cari."%")
     ->orWhere('desc','like',"%".$cari."%")
     ->orWhereHas('whosubmit', function($q) use($cari){
          $q->where('name','like',"%".$cari."%");
     })
     ->where('status','Delivery Success')
     ->paginate(10);

     return view('pengajuanPembelian.menu.history')
     ->with('datappb',$datappb);

    }


    public function historyfail()
    {
        $datappb = CategoryPengajuanPembelian::where('user_id',Auth::user()->id)->where('status','like',"%Rejected%")->paginate(10);
        return view('pengajuanPembelian.menu.historyfailed')
            ->with('datappb', $datappb);
    }

    public function SearchHistoryFailPRQ(Request $request)
    {
     $cari = $request->cari;
     //dd($cari);=
     $datappb = CategoryPengajuanPembelian::where('id','like',"%".$cari."%")
     ->orWhere('status','like',"%".$cari."%")
     ->orWhere('desc','like',"%".$cari."%")
     ->orWhereHas('whosubmit', function($q) use($cari){
          $q->where('name','like',"%".$cari."%");
     })
     ->where('status','like',"%Rejected%")
     ->paginate(10);

     return view('pengajuanPembelian.menu.historyfailed')
     ->with('datappb',$datappb);
    }

    public function create()
    {
        $check = Role::where('model_id', Auth::user()->id)->first();
        if ($check->role_id == 1 || $check->role_id == 2){

        $prepr              = Pre_pr::where('user_id',Auth::user()->id)->orderBy('id','DESC')->get();
        $atasan             = User::find(7);
        // dd($atasan);
        $dataws             = WhoSubmitted::all();
        $datadepartment     = Department::all();
        $purpose            = ReferensiNamaProject::get();

        $purpose_office     = Office::all();
        $purpose_inventory  = Inventory::all();
        $purpose_workshop   = Workshop::all();
        $purpose_rnd        = RND::all();
        $purpose_travel     = Travel::all();
        $ppb                = CategoryPengajuanPembelian::where('user_id', Auth::user()->id)->get();
        $uom                = Uom::all();
        $ItemsProject       = Pre_pr::with('partItem')->where('project_id', old('project'))->first();
        if (request()->pengajuan_id == null) {
        $ppb_old            = CategoryPengajuanPembelian::where('id',0)->get();
        } else {
        $ppb_old            = CategoryPengajuanPembelian::find(request()->pengajuan_id)->itemppn()->get();
        }

        $oldInput = Session::getOldInput();
        // dd($ppb_old);
        return view('pengajuanPembelian.menu.create')
            ->with('atasan', $atasan)
            ->with('purpose', $purpose)
            ->with('purpose_office', $purpose_office)
            ->with('purpose_inventory', $purpose_inventory)
            ->with('purpose_workshop', $purpose_workshop)
            ->with('purpose_rnd', $purpose_rnd)
            ->with('purpose_travel', $purpose_travel)
            ->with('dataws', $dataws)
            ->with('datadepartment', $datadepartment)
            ->with('ppb', $ppb)
            ->with('prepr', $prepr)
            ->with('uom', $uom)
            ->with('oldInput', $oldInput)
            ->with('ItemsProject', $ItemsProject)
            ->with('ppb_old', $ppb_old);
        }elseif ($check->role_id == 3){
        $prepr              = Pre_pr::orderBy('id','DESC')->get();
        $atasan             = User::find(7);
        // dd($atasan);
        $dataws             = WhoSubmitted::all();
        $datadepartment     = Department::all();
        $purpose            = ReferensiNamaProject::get();

        $purpose_office     = Office::all();
        $purpose_inventory  = Inventory::all();
        $purpose_workshop   = Workshop::all();
        $purpose_rnd        = RND::all();
        $purpose_travel     = Travel::all();
        $ppb                = CategoryPengajuanPembelian::where('user_id', Auth::user()->id)->get();
        $uom                = Uom::all();
        $ItemsProject       = Pre_pr::with('partItem')->where('project_id', old('project'))->first();
        if (request()->pengajuan_id == null) {
        $ppb_old            = CategoryPengajuanPembelian::where('id',0)->get();
        } else {
        $ppb_old            = CategoryPengajuanPembelian::find(request()->pengajuan_id)->itemppn()->get();
        }

        $oldInput = Session::getOldInput();
        // dd($ppb_old);
        return view('pengajuanPembelian.menu.create')
            ->with('atasan', $atasan)
            ->with('purpose', $purpose)
            ->with('purpose_office', $purpose_office)
            ->with('purpose_inventory', $purpose_inventory)
            ->with('purpose_workshop', $purpose_workshop)
            ->with('purpose_rnd', $purpose_rnd)
            ->with('purpose_travel', $purpose_travel)
            ->with('dataws', $dataws)
            ->with('datadepartment', $datadepartment)
            ->with('ppb', $ppb)
            ->with('prepr', $prepr)
            ->with('uom', $uom)
            ->with('oldInput', $oldInput)
            ->with('ItemsProject', $ItemsProject)
            ->with('ppb_old', $ppb_old);
        }else {
            return redirect()->route('dashboard');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $check = Role::where('model_id', Auth::user()->id)->first();
        if ($check->role_id == 1 || $check->role_id = 2 || $check->role_id == 3){
            $data = $request->all();
            // dd($data);
            $request->validate([
                'category_purpose' => 'required',
                'date_ps' => 'required',
                'dateline' => 'required',
                'ws'      => 'required',
                'department' => 'required',
                'desc'  => 'required',
                'atasan' => 'required',
                'send_to' => 'required',
                // 'path_file.*' => 'max:8192',
            ], [
                'category_purpose.required' => 'The Purpose field is required.',
                'date_ps.required' => 'The Date field is required.',
                'dateline.required' => 'The Date Line field is required.',
                'ws.required' => 'The Who Submitted field is required.',
                'department.required' => 'The Department field is required.',
                'desc.required' => 'The Description field is required.',
                'atasan.required' => 'The Super User field is required.',
                'send_to.required' => 'The Send To field is required.',
                'ppn.required' => 'The PPN To field is required.',
                // 'path_file.*.max' => 'Maximum File Size Is 2MB ',
            ]);

            try {
                // dd($data);
                foreach($data['item'] as $item => $value){
                    $preprItems = PartItem_Pre_pr::find($data['item'][$item]);
                    if($preprItems){
                        if($preprItems->total < $data['qty'][$item]){
                            Session::flashInput($request->input());
                            return redirect()->back()->with('error','Request qty > prepr total item '.$preprItems->child_item.' Request qty = '.$data['qty'][$item].' total required in prePR = '.$preprItems->total);
                        }
                    }
                }

                $logisticCheck = 0;
                // dd($request->category_purpose == "project");
                if ($request->category_purpose == "project") {
                    $logisticCheck = 1;
                }else {
                    $logisticCheck = 0;
                }

                $pengajuan = new CategoryPengajuanPembelian([
                    'logistic_check' => $logisticCheck,
                    'user_id' =>  Auth::user()->id,
                    'date_ps' => $request->date_ps,
                    'dateline' => $request->dateline,
                    'ws' => $request->ws,
                    'department' => $request->department,
                    'desc' => $request->desc,
                    'atasan' => $request->atasan,
                    'send_to' => $request->send_to,
                    'ppn' => $request->ppn,
                ]);



                if ($request->category_purpose == "project") {
                    $purpose1 = ReferensiNamaProject::find($request->project);
                    $pengajuan = $purpose1->purposes()->save($pengajuan);
                } elseif ($request->category_purpose == "office") {
                    $purpose2 = Office::find($request->company);
                    $pengajuan = $purpose2->purposes()->save($pengajuan);
                } elseif ($request->category_purpose == "workshop") {
                    $purpose3 = Workshop::find($request->workshop);
                    $pengajuan = $purpose3->purposes()->save($pengajuan);
                } elseif ($request->category_purpose == "inventory") {
                    $purpose4 = Inventory::find($request->inventory);
                    $pengajuan = $purpose4->purposes()->save($pengajuan);
                } elseif ($request->category_purpose == "rnd") {
                    $purpose5 = RND::find($request->rnd);
                    $pengajuan = $purpose5->purposes()->save($pengajuan);
                } elseif ($request->category_purpose == "travel") {
                    $purpose6 = Travel::find($request->travel);
                    $pengajuan = $purpose6->purposes()->save($pengajuan);
                }
                // dd($pengajuan);


                $year = Carbon::parse($pengajuan->created_at)->format('y');
                $month = Carbon::parse($pengajuan->created_at)->format('m');
                $ppb_id = str_pad($pengajuan->id,5,'0', STR_PAD_LEFT);
                $generateppb = strtoupper($ppb_id."/PPB/SII/".$month."/".$year);
                $file_pr = null;
                if($path_pr = $request->file('file_pr') ?? null) {
                    $file_pr = $ppb_id .'_'. $path_pr->getClientOriginalName();
                    $path_pr->move(public_path('upload_file_pr'), $file_pr);
                }
                CategoryPengajuanPembelian::where('id',$pengajuan->id)->update([
                    'code_pengajuan' => $generateppb,
                    'file_pr' => $file_pr,
                ]);



                foreach ($data['item'] as $item => $value) {
                    $file = null;
                    if($path = $request->file('path_file')[$item] ?? null) {
                        $file = $path->getClientOriginalName();
                        $path->move(public_path('upload_pengajuan'), $file);
                    }
                    $preprItems2 = PartItem_Pre_pr::find($data['item'][$item]);
                    if($preprItems2){
                        if($preprItems2->total < $data['qty'][$item]){
                            Session::flashInput($request->input());
                            return redirect()->back()->with('error','Request qty > prepr total');
                        }
                        $preprItems2->total -= $data['qty'][$item];
                        $preprItems2->save();
                    }

                    $data2 = array(
                        'pp_id'             => $pengajuan->id,
                        'product_id'        => $preprItems2->product_id ?? null,
                        'prepr_id'          => $preprItems2->id ?? null,
                        'item'              => $preprItems2->child_item ?? $data['item'][$item] ?? '-',
                        'qty'               => $data['qty'][$item],
                        'kategori'          => $data['kategori'][$item],
                        'path_file'         => $file,
                    );
                    PengajuanPembelian::create($data2);


                }

        // }

            } catch (Exception $err) {
                dd($err);
            }

            return redirect('send/'.$pengajuan->id)->with('success', 'Task Created Successfully!');
        } else {
            return redirect()->route('dashboard');
        }
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
    public function edit(Request $request, $id)
    {
        $check              = Role::where('model_id', Auth::user()->id)->first();
        $atasan             = User::whereIn('id', [3, 6, 7, 8, 9])->get();
        $datapt             = CategoryPT::all();
        $dv                 = CategoryPengajuanPembelian::find($id);
        $dataws             = WhoSubmitted::all();
        $prepr              = Pre_pr::where('user_id',Auth::user()->id)->get();
        $datadepartment     = Department::all();
        $purpose            = ReferensiNamaProject::all();
        $purpose_office     = Office::all();
        $purpose_inventory  = Inventory::all();
        $purpose_workshop   = Workshop::all();
        $purpose_rnd        = RND::all();
        $purpose_travel     = Travel::all();
        $item               = PengajuanPembelian::where('pp_id', $id)->get();
        $uom                = Uom::all();
        $oldInput           = Session::getOldInput();


        if ($check->role_id == 2 || $check->role_id == 18) {
            if(Auth::user()->id == $dv->user_id){
            return view('pengajuanPembelian.menu.edit')
            ->with('atasan', $atasan)
            ->with('datapt', $datapt)
            ->with('purpose', $purpose)
            ->with('prepr', $prepr)
            ->with('purpose_office', $purpose_office)
            ->with('purpose_inventory', $purpose_inventory)
            ->with('purpose_workshop', $purpose_workshop)
            ->with('purpose_rnd', $purpose_rnd)
            ->with('purpose_travel', $purpose_travel)
            ->with('item', $item)
            ->with('dataws', $dataws)
            ->with('datadepartment', $datadepartment)
            ->with('dv', $dv)
            ->with('oldInput',$oldInput)
            ->with('uom', $uom);
            }else {
                return redirect()->route('dashboard');
            }
        }else if ($check->role_id == 1 || $check->role_id == 3) {
            return view('pengajuanPembelian.menu.edit')
            ->with('atasan', $atasan)
            ->with('datapt', $datapt)
            ->with('purpose', $purpose)
            ->with('purpose_office', $purpose_office)
            ->with('purpose_inventory', $purpose_inventory)
            ->with('purpose_workshop', $purpose_workshop)
            ->with('purpose_rnd', $purpose_rnd)
            ->with('purpose_travel', $purpose_travel)
            ->with('item', $item)
            ->with('dataws', $dataws)
            ->with('datadepartment', $datadepartment)
            ->with('dv', $dv)
            ->with('uom', $uom);
        }
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
        $data = $request->all();
        // dd($data);
        $request->validate([
            'date_ps' => 'required',
            'dateline' => 'required',
            'ws'      => 'required',
            'department' => 'required',
            'desc'  => 'required',
            'atasan' => 'required',
            'send_to' => 'required',
        ], [
            'date_ps.required' => 'The Date field is required.',
            'dateline.required' => 'The Date Line field is required.',
            'ws.required' => 'The Who Submitted field is required.',
            'department.required' => 'The Department field is required.',
            'desc.required' => 'The Description field is required.',
            'atasan.required' => 'The Approved By field is required.',
            'send_to.required' => 'The Send To field is required.',
        ]);

        try {
            foreach ($data['item'] as $item => $value) {
                // dd($data['item']);
                $pengajuanItems = PengajuanPembelian::find($data['item'][$item]);
                $preprItems = PartItem_Pre_pr::find($data['item'][$item]);
                    if($preprItems){
                        if($preprItems->total < $data['qty'][$item]){
                            Session::flashInput($request->input());
                            return redirect()->back()->with('error','Request qty > prepr total 1');
                        }
                    }else if($pengajuanItems){
                        if($pengajuanItems->itemPrePR->total < $data['qty'][$item]){
                            Session::flashInput($request->input());
                            return redirect()->back()->with('error','Request qty > prepr total 2');
                        }
                    }
            }

            $pengajuan = CategoryPengajuanPembelian::where('id',$id)->first();
            $file_pr = null;
            if($path_pr = $request->file('file_pr') ?? null) {
                $file_pr = $id .'_'. $path_pr->getClientOriginalName();
                $path_pr->move(public_path('upload_file_pr'), $file_pr);
                if ($old_file = $pengajuan->file_pr) {

                    $old_file_path = public_path('upload_file_pr/' . $old_file);

                    if (file_exists($old_file_path)) {
                        File::delete($old_file_path);
                    }
                }
            }
            $pengajuan->update([
                'user_id' =>  Auth::user()->id,
                'date_ps' => $request->date_ps,
                'dateline' => $request->dateline,
                'ws' => $request->ws,
                'department' => $request->department,
                'desc' => $request->desc,
                'atasan' => $request->atasan,
                'matauang' => $request->matauang,
                'send_to' => $request->send_to,
                'file_pr' => $file_pr ?? null,
            ]);

            if ($request->category_purpose == "project") {
                $purpose1 = ReferensiNamaProject::find($request->project);
                $purpose1->purposes()->where('id',$id)->delete();
                $pengajuan = $purpose1->purposes()->save($pengajuan);
            } elseif ($request->category_purpose == "office") {
                $purpose2 = Office::find($request->office);
                $purpose2->purposes()->where('id',$id)->delete();
                $pengajuan = $purpose2->purposes()->save($pengajuan);
            } elseif ($request->category_purpose == "workshop") {
                $purpose3 = Workshop::find($request->workshop);
                $purpose3->purposes()->where('id',$id)->delete();
                $pengajuan = $purpose3->purposes()->save($pengajuan);
            } elseif ($request->category_purpose == "inventory") {
                $purpose4 = Inventory::find($request->inventory);
                $purpose4->purposes()->where('id',$id)->delete();
                $pengajuan = $purpose4->purposes()->save($pengajuan);
            } elseif ($request->category_purpose == "rnd") {
                $purpose5 = RND::find($request->rnd);
                $purpose5->purposes()->where('id',$id)->delete();
                $pengajuan = $purpose5->purposes()->save($pengajuan);
            } elseif ($request->category_purpose == "travel") {
                $purpose6 = Travel::find($request->travel);
                $purpose6->purposes()->where('id',$id)->delete();
                $pengajuan = $purpose6->purposes()->save($pengajuan);
            }

            foreach ($data['item'] as $item => $value) {

                $file = null;
                if($path = $request->file('path_file')[$item] ?? null) {
                    $file = $path->getClientOriginalName();
                    $path->move(public_path('upload_pengajuan'), $file);
                }

                if(!empty($data['id'][$item])){
                $pengajuanItems = PengajuanPembelian::find($data['id'][$item]); // Kalau id nya ada maka get
                }else {
                $pengajuanItems = null; // kalau idnnya ga ada maka dbkinn null
                }

                $preprOldItems = null;
                if($pengajuanItems){
                    $preprOldItems = PartItem_Pre_pr::where('id',$pengajuanItems->prepr_id)->first(); //kalau item oldnya ada maka get data old
                } else {
                    $preprOldItems = null; //bikin null kalau item pr nya ga ada
                }

                $preprItemsNew = PartItem_Pre_pr::find($data['item'][$item]);

                // dd($preprOldItems);
                if($preprOldItems){
                    //Update Data
                    PengajuanPembelian::where('id',$pengajuanItems->id)->update([
                        'item'              => $preprOldItems->child_item ?? $data['item'][$item] ?? '-',
                        'qty'               => $data['qty'][$item],
                        'kategori'          => $data['kategori'][$item],
                        'path_file'         => $file,
                    ]);
                    $cutoff =  $pengajuanItems->qty - $data['qty'][$item]; //ItemPR old - ItemPR New
                    $sumskuy = $preprOldItems->total + $cutoff; //Kalau minus dia ngurang jadi misal 10 + -(8); jadi 2
                    PartItem_Pre_pr::where('id', $preprOldItems->id)->update([
                        'total' => $sumskuy,
                    ]);
                }else if($preprItemsNew) {
                    //Create Data Baru

                    $defisitTotal = $preprItemsNew->total - $data['qty'][$item];

                    PengajuanPembelian::create([
                        'pp_id'             => $id,
                        'prepr_id'          => $preprItemsNew->id ?? null,
                        'item'              => $preprItemsNew->child_item ?? '-',
                        'qty'               => $data['qty'][$item],
                        'kategori'          => $data['kategori'][$item],
                        'path_file'         => $file,
                    ]);

                    PartItem_Pre_pr::where('id', $preprItemsNew->id)->update([
                        'total' => $defisitTotal
                    ]);
                }else {
                    $data2 = array(
                        'item'              => $data['item'][$item],
                        'qty'               => $data['qty'][$item],
                        'kategori'          => $data['kategori'][$item],
                        'path_file'         => $file,
                    );
                    PengajuanPembelian::where('id',$data['id'][$item])->update($data2);
                }
            }

            return redirect('menu-pengajuan-pembelian/')->with(['success' => true, 'message' => 'Update Successfully']);
        } catch (\Exception $e) {
            dd($e);
            return ['success' => false, 'message' => $e->getMessage()];
        }


        return redirect('menu-pengajuan-pembelian/');
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
        // dd($data);
        $check = Role::where('model_id', Auth::user()->id)->first();
        // dd($check->role_id == 2 || $check->role_id == 18);
        if ($check->role_id == 2 || $check->role_id == 18) {
                $itemPr = PengajuanPembelian::where('pp_id',$id)->get();
                foreach($itemPr as $item){
                    // dd($item->prepr_id);
                    if($item->prepr_id){
                        $preprItem = PartItem_Pre_pr::find($item->prepr_id);
                        // dd($preprItem);
                        $sumPreprtotal = $preprItem->qty + $preprItem->buffer;
                        $sumValue = $preprItem->total + $item->qty;
                        if($sumPreprtotal < $sumValue){
                            $updatePreprItem = PartItem_Pre_pr::where('id', $item->prepr_id)->update([
                                'total' => $sumPreprtotal
                            ]);
                        }else {
                            $updatePreprItem = PartItem_Pre_pr::where('id', $item->prepr_id)->update([
                                'total' => $sumValue
                            ]);
                        }
                    }
                    $item->delete();
                }
                $data->delete();
                return redirect('/menu-pengajuan-pembelian')->with('success', 'Task Deleted Successfully!');
        }else if ($check->role_id == 1 || $check->role_id == 3) {
            $itemPr = PengajuanPembelian::where('pp_id',$id)->get();
            // dd($itemPr);
            foreach($itemPr as $item){
                // dd($item->prepr_id);
                if($item->prepr_id){
                    $preprItem = PartItem_Pre_pr::find($item->prepr_id);
                    // dd($preprItem);
                    $sumPreprtotal = $preprItem->qty + $preprItem->buffer;
                    $sumValue = $preprItem->total + $item->qty;
                    if($sumPreprtotal < $sumValue){
                        $updatePreprItem = PartItem_Pre_pr::where('id', $item->prepr_id)->update([
                            'total' => $sumPreprtotal
                        ]);
                    }else {
                        $updatePreprItem = PartItem_Pre_pr::where('id', $item->prepr_id)->update([
                            'total' => $sumValue
                        ]);
                    }
                }
                $item->delete();
            }
            $data->delete();
            return redirect('/menu-pengajuan-pembelian')->with('success', 'Task Deleted Successfully!');
        }



    }

    public function export($id)
    {
        return Excel::download(new PPBExport($id), 'pengajuan_pembelian.xlsx');
    }

    public function exportpdf($id)
    {
        // $data['category_po'] = CategoryPengajuanPembelian::where('id', $this->id)->get()->first();
        $data['cpp'] = CategoryPengajuanPembelian::find($id);
        // $data['atasan'] = CategoryPengajuanPembelian::where('id',$id)->first();
        $data['cpo'] = CategoryPO::where('ppb_id', $id)->get()->first();
        $data['id'] = PengajuanPembelian::where('pp_id', $id)->first();
        $data['category_q'] = PengajuanPembelian::where('pp_id', $id)->get();
        // $data['day'] = Carbon::now()->format('d');
        // $data['year2'] = Carbon::now()->format('Y');
        $data['year'] = Carbon::now()->format('y');
        $data['month'] = Carbon::now()->format('m');

        $pdf = FacadePdf::loadView('pengajuanPembelian.export-pdf.pengajuan', $data)->setpaper('A4', 'potrait');
        return $pdf->stream('Pengajuan.pdf');

    }

    public function getDataPrePR($id)
    {
        $prepr = Pre_pr::with('partItem')->where('project_id',$id)->first();
        return response()->json([
            'message' => 'Success Get Data',
            'data' => $prepr,
        ]);
    }
}
