<?php

namespace App\Http\Controllers;

use App\Exports\PPBExport;
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
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Calculation\Category;

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
        if ($check->role_id == 2) {
            $user   = User::where('id', Auth::user()->id)->get();
            $datapt = CategoryPT::all();
            $dataop = CategoryPP::all();
            $dataec = CategoryEcommerce::all();
            $dataws = WhoSubmitted::all();
            $datadepartment = Department::all();
            $purpose = ReferensiNamaProject::all();
            $atasan = User::whereIn('id', [3, 6, 7, 8, 9])->get();
            $datadv = CategoryPengajuanPembelian::where('user_id', Auth::user()->id)->orderBy('id','DESC')->orderBy('date_ps','DESC')->orderBy('created_at','ASC')->paginate(10);
            $datapo = CategoryPO::get();
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
                ->with('datapo', $datapo)
                ->with('datadepartment', $datadepartment);
        } else if ($check->role_id == 1 || $check->role_id == 3) {
            $user = User::where('id', Auth::user()->id)->get();
            $datapt = CategoryPT::all();
            $datapo = CategoryPO::get();
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
                ->with('datapo', $datapo)
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
    ->paginate(5);
    $datapo = CategoryPO::get();

    return view('pengajuanPembelian.menu.index')
    ->with('datadv',$datadv)
    ->with('datapo', $datapo)
    ->with('dataws',$dataws);
   }

    public function detail($id)
    {
        /*$data_vendor*/
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

    public function po_detail($id)
    {
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

    public function history()
    {
        $datappb = CategoryPengajuanPembelian::where('user_id',Auth::user()->id)->where('status','Delivery Success')->paginate(10);
        return view('pengajuanPembelian.menu.history')
            ->with('datappb', $datappb);
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
     ->paginate(5);

     return view('pengajuanPembelian.menu.history')
     ->with('datappb',$datappb);

    }


    public function historyfail()
    {
        $datappb = CategoryPengajuanPembelian::where('user_id',Auth::user()->id)->where('status','like',"%Rejected%")
            // ->where('status','Purchase Request Rejected By BOD')
            // ->orWhere('status', 'Rejected by Purchasing')
            // ->orWhere('status', 'PO Rejected by BOD')
            // ->orWhere('status', 'Payment Rejected By BOD')
            // ->orWhere('status', 'Rejected by Finance')
        ->paginate(10);
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
        if (request()->pengajuan_id == null) {
        $ppb_old            = CategoryPengajuanPembelian::where('id',0)->get();
        } else {
        $ppb_old            = CategoryPengajuanPembelian::find(request()->pengajuan_id)->itemppn()->get();
        }
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
            ->with('ppb_old', $ppb_old)
            ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
            'path_file' => 'max:2047',
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
            'path_file.max' => 'Maximum File Size Is 2MB ',
        ]);

        try {

        // foreach($data['category_purpose'] as $purpose => $pp ){
            // dd($purpose);
        $pengajuan = new CategoryPengajuanPembelian([
            'user_id' =>  Auth::user()->id,
            'date_ps' => $request->date_ps,
            'dateline' => $request->dateline,
            'ws' => $request->ws,
            'department' => $request->department,
            'desc' => $request->desc,
            'atasan' => $request->atasan,
            'send_to' => $request->send_to,
            'ppn' => $request->ppn,
            // 'code_pengajuan' =>

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
        // dd($generateppb);
        CategoryPengajuanPembelian::where('id',$pengajuan->id)->update([
            'code_pengajuan' => $generateppb
        ]);


        foreach ($data['item'] as $item => $value) {
            $file = null;
            if($path = $request->file('path_file')[$item] ?? null) {
                $file = $path->getClientOriginalName();
                $path->move(public_path('upload_pengajuan'), $file);
            }
            // dd($pengajuan);
            $data2 = array(
                'pp_id'             => $pengajuan->id,
                'item'              => $data['item'][$item],
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
        $atasan = User::whereIn('id', [3, 6, 7, 8, 9])->get();
        $datapt = CategoryPT::all();
        $dv = CategoryPengajuanPembelian::find($id);
        $dataws             = WhoSubmitted::all();
        $datadepartment     = Department::all();
        $purpose = ReferensiNamaProject::all();
        $purpose_office     = Office::all();
        $purpose_inventory  = Inventory::all();
        $purpose_workshop   = Workshop::all();
        $purpose_rnd        = RND::all();
        $purpose_travel     = Travel::all();
        $item = PengajuanPembelian::where('pp_id', $id)->get();
        //dd($item);
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

            $pengajuan = CategoryPengajuanPembelian::where('id',$id)->first();
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

            foreach ($data['id'] as $item => $value) {
                $file = null;
                if($path = $request->file('path_file')[$item] ?? null) {
                    $file = $path->getClientOriginalName();
                    $path->move(public_path('upload_pengajuan'), $file);
                }
                $data2 = array(
                    'item'              => $data['item'][$item],
                    'qty'               => $data['qty'][$item],
                    'kategori'          => $data['kategori'][$item],
                    'path_file'         => $file,
                );
                PengajuanPembelian::where('id',$value)->update($data2);
            }

            return redirect('menu-pengajuan-pembelian/')->with(['success' => true, 'message' => 'Update Successfully']);
        } catch (\Exception $e) {
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
        $data1 = PengajuanPembelian::where('pp_id', $id);
        $data1->delete();
        $data = CategoryPengajuanPembelian::find($id);
        $data->delete();
        return redirect('/menu-pengajuan-pembelian')->with('success', 'Task Deleted Successfully!');
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
}
