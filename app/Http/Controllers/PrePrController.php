<?php

namespace App\Http\Controllers;

use App\Models\Pre_pr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ReferensiNamaProject;
use App\Models\PartItem_Pre_pr;
use App\Imports\PrePRImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use App\Exports\PrePRExport;
use App\Models\Uom;
use App\Models\CategoryPengajuanPembelian;
use App\Models\PengajuanPembelian;
use App\Models\Comment;
use App\Models\Role;
use Illuminate\Support\Facades\Http;

class PrePrController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pre_pr = Pre_pr::where('user_id', Auth::user()->id)->paginate(10);
        $purpose = ReferensiNamaProject::orderBy('created_at','DESC')->get();
        return view('PrePR.index')
        ->with('purpose', $purpose)
        ->with('pre_pr', $pre_pr);
    }

    /**
     * Display a detail of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function detail($id)
    {
        $pre_pr = Pre_pr::with(['partItem' => function ($query) {
            $query->with('prItems', function ($query) {
                $query->whereHas('ppb', function ($query) {
                    $query->where('status', 'NOT LIKE', '%Rejected%');
                });
            });
        }])->find($id);

        // $pre_pr =

        return view('PrePR.detail')
        ->with('pre_pr', $pre_pr);
    }

    /**
     * Display a Search List of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function search(Request $request)
    {
        $cari = $request->cari;
        //dd($cari);=
        $pre_pr = Pre_pr::where('user_id', Auth::user()->id)
        ->where('id','like',"%".$cari."%")
        ->orWhereHas('partItem', function($q) use($cari){
            $q->where('child_item','like',"%".$cari."%")
            ->orWhere('qty','like',"%".$cari."%")
            ->orWhere('buffer','like',"%".$cari."%")
            ->orWhere('desc','like',"%".$cari."%")
            ->orWhere('status','like',"%".$cari."%");
        })
        ->orWhereHas('project', function($p) use($cari){
            $p->where('name','like',"%".$cari."%");
        })
        ->orWhere('due_date','like',"%".$cari."%")
        ->paginate(10);

        return view('PrePR.index')
        ->with('pre_pr', $pre_pr);
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
            // dd($token);
            if ($response->successful() && $response['valid']) {
                // Token masih valid, lanjutkan ke rute yang diminta
                return true;
            }else {
                return false;
            }
        }
    }

//Get Product From Stocky
    private function getProducts($bearer)
    {
        // dd($bearer);
        $url = env('URL_STOCKY').'/get_products_api';
        $response = Http::withHeaders([
            'Authorization' => 'Bearer '. $bearer,
        ])->get($url);
        // dd($response);

        if($response->successful()) {
            $resjson = $response->json();
            $products = $resjson['products'];
            // dd($resjson['products']);
            return $products;
        }else {
            dd($response);
        }
    }



    public function create()
    {
        $tokenGerry = Session::get('token');

        $checking = $this->CheckToken($tokenGerry);

        // dd($checking);
        $items= [];

        if(!$checking){
            $this->getToken();
        }else {
          $products =   $this->getProducts($tokenGerry);
        }
        // dd($products);
        $purpose = ReferensiNamaProject::orderBy('created_at','DESC')->get();
        $oldInput = Session::getOldInput();
        return view('PrePR.create')
        ->with('oldInput', $oldInput)
        ->with('products', $products)
        ->with('purpose',$purpose);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $data = $request->all();
        // dd($data);
        $existProject = Pre_pr::where('user_id',Auth::user()->id)->where('project_id',$request->project)->first();
        if($existProject){
            Session::flashInput($request->input());
            return redirect()->back()->with('error', 'Project Already Exist -_- ');
        }

        $pre_pr = Pre_pr::create([
            'user_id' =>  Auth::user()->id,
            'project_id' => $request->project,
            'due_date'=> $request->due_date
        ]);
        // dd($data);

        foreach ($data['item'] as $item => $value) {
            $qty = $data['qty'][$item];
            $buffer =  $data['buffer'][$item];
            $total = $qty + $buffer;

            list($id, $name) = explode(':', $data['item'][$item]);

            $data2 = array(
                'pre_pr_id'         => $pre_pr->id,
                'product_id'        => $id ?? null,
                'child_item'        => $name,
                'desc'              => $data['desc'][$item],
                'link'              => $data['link'][$item],
                'status'            => $data['status'][$item]?? '',
                'qty'               => $qty ?? 0 ,
                'buffer'            => $buffer ?? 0,
                'total'             => $total
            );
            PartItem_Pre_pr::create($data2);
        }
        return redirect()->route('prepr.index')->with('message', 'Success Create Pre PR');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pre_pr  $pre_pr
     * @return \Illuminate\Http\Response
     */
    public function show(Pre_pr $pre_pr)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pre_pr  $pre_pr
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pre_pr = Pre_pr::find($id);
        $purpose = ReferensiNamaProject::orderBy('created_at','DESC')->get();
        return view('PrePR.edit')
        ->with('purpose',$purpose)
        ->with('pre_pr', $pre_pr);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pre_pr  $pre_pr
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        $pre_pr = Pre_pr::where('id',$id)->update([
            'user_id' =>  Auth::user()->id,
            'due_date'=> $request->due_date
        ]);

        foreach ($data['item'] as $item => $value) {
            $qty = $data['qty'][$item];
            $buffer =  $data['buffer'][$item];
            $total = $qty + $buffer;

            $data2 = array(
                'child_item'        => $data['item'][$item],
                'desc'              => $data['desc'][$item],
                'link'              => $data['link'][$item],
                'status'            => $data['status'][$item],
                'qty'               => $qty ?? 0 ,
                'buffer'            => $buffer ?? 0,
                'total'             => $total
            );
            PartItem_Pre_pr::updateOrCreate(
                ['pre_pr_id' => $id, 'child_item' => $value],
                $data2
            );
        }

        PartItem_Pre_pr::where('pre_pr_id', $id)
        ->whereNotIn('child_item', $data['item'])
        ->delete();

        return redirect()->route('prepr.index')->with('message', 'Success Update Pre PR');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pre_pr  $pre_pr
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pre_pr = Pre_pr::find($id);
        PartItem_Pre_pr::where('pre_pr_id', $id)->delete();
        $pre_pr->delete();
        return redirect()->route('prepr.index')->with('message', 'Success Delete Pre PR');
    }

    public function importPrePR(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:xls,xlsx'
        ]);
        $project = $request->input('project');
        $due_date = $request->input('due_date');
        if ($request->hasFile('file')) {
            //UPLOAD FILE
            $file = $request->file('file'); //GET FILE
            // dd($file);
            Excel::import(new PrePRImport($project, $due_date), $file); //IMPORT FILE
            return redirect()->back()->with(['success' => 'Upload file data !']);
        }

        return redirect()->back()->with(['error' => 'Please choose file before!']);
    }

    public function exportPrePR($id)
    {
        // $convertID = intval($id);
        return Excel::download(new PrePRExport($id), 'PrePR.xlsx');
    }

    public function check_logistic()
    {
        $pengajuan = CategoryPengajuanPembelian::where('status', 'Awaiting Purchase Request Approval')->where('logistic_check', 1)
        ->orderBy('status', 'desc')->orderBy('dateline', 'asc')
        ->with('itemppn')
        ->paginate(10);
        return view('check_logistic.index')
        ->with('pengajuan', $pengajuan);
    }

    public function check_logistic_edit($id)
    {
        $pengajuan = CategoryPengajuanPembelian::where('status', 'Awaiting Purchase Request Approval')
        ->where('logistic_check', 1)->where('id',$id)
        ->orderBy('status', 'desc')->orderBy('dateline', 'asc')
        ->with('itemppn')
        ->first();

        $uom  = Uom::all();
        return view('check_logistic.edit')
        ->with('pengajuan', $pengajuan)
        ->with('uom', $uom);
    }

    public function check_logistic_update(Request $request,$id)
    {
        // dd($request);
        $data = $request->all();
        $preprOldItems = null;
        $oldItemPr = PengajuanPembelian::where('pp_id',$id)->pluck('id');
        $dataItemIds = collect($data['id']);
        $itemsToDelete = $oldItemPr->diff($dataItemIds);

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

            if($pengajuanItems){
                $preprOldItems = PartItem_Pre_pr::where('id',$pengajuanItems->prepr_id)->first(); //kalau item oldnya ada maka get data old
            } else {
                $preprOldItems = null; //bikin null kalau item pr nya ga ada
            }

            // dd($preprOldItems);
            if($preprOldItems){
                //Update Data
                PengajuanPembelian::where('id',$pengajuanItems->id)->update([
                    'item'              => $preprOldItems->child_item ?? $data['item'][$item] ?? '-',
                    'qty'               => $data['qty'][$item],
                    'kategori'          => $data['kategori'][$item],
                ]);
                $cutoff =  $pengajuanItems->qty - $data['qty'][$item]; //ItemPR old - ItemPR New
                $sumskuy = $preprOldItems->total + $cutoff; //Kalau minus dia ngurang jadi misal 10 + -(8); jadi 2
                PartItem_Pre_pr::where('id', $preprOldItems->id)->update([
                    'total' => $sumskuy,
                ]);
            }
        }
        $deleted_pengajuan =  PengajuanPembelian::whereIn('id', $itemsToDelete)->get();
        if($deleted_pengajuan){
            foreach($deleted_pengajuan as $dp) {
                $preprParts = PartItem_Pre_pr::where('child_item',$dp->item)->where('id', $dp->prepr_id)->first();
                if($preprParts){
                    $total = $dp->qty + $preprParts->total;
                    PartItem_Pre_pr::where('id', $dp->prepr_id)->update([
                        'total' => $total,
                    ]);
                }
            }
        }

        PengajuanPembelian::whereIn('id', $itemsToDelete)->delete();




        return redirect()->route('logistic.detail',$id)->with('message','Success Edit Data');

    }

    public function search_check_logistic(Request $request)
    {
        $cariIn = $request->cariIn;
        //dd($cari);
        $pengajuan = CategoryPengajuanPembelian::where('status', 'Awaiting Purchase Request Approval')->where('logistic_check', 1)
        ->orderBy('status', 'desc')->orderBy('dateline', 'asc')
        ->where('id','like',"%".$cariIn."%")
        ->orWhere('status','like',"%".$cariIn."%")
        ->orWhere('desc','like',"%".$cariIn."%")
        ->orWhereHas('whosubmit', function($q) use($cariIn){
            $q->where('name','like',"%".$cariIn."%");
        })
        ->paginate(10);
        return view('check_logistic.index')
        ->with('pengajuan', $pengajuan);
    }

    public function detail_check_logistic($id)
    {
        $pengajuan = CategoryPengajuanPembelian::find($id);
        $comments  = Comment::where('ppb_id',$id)->get();
        return view('check_logistic.detail')
        ->with('pengajuan',$pengajuan)
        ->with('comments',$comments);

    }

    public function approve_check_logistic(Request $request,$id)
    {
        $check = Role::where('model_id', Auth::user()->id)->first();
        if ($check->role_id == 20) {
            $data = CategoryPengajuanPembelian::find($id);
            $data->logistic_check = 0;
            $data->note_logistic = $request->note_logistic;
            $data->save();

            return redirect()->route('logistic.index')->with('message','Success Approved');
        }
    }

    public function approve_check_logistic_selected(Request $request)
    {
        // dd($request);
        $check = Role::where('model_id', Auth::user()->id)->first();
        if ($check->role_id == 20) {
            $ids = explode(',', $request->ids);
            $data = CategoryPengajuanPembelian::whereIn('id',$ids)->get();
            foreach($data as $d) {
                $d->logistic_check = 0;
                $d->save();
            }
            return redirect()->route('logistic.index')->with('message','Success Approved');
        }
    }

    public function reject_check_logistic(Request $request, $id)
    {
        // dd($request);
        $check = Role::where('model_id', Auth::user()->id)->first();
        if ($check->role_id == 20) {
            $data = CategoryPengajuanPembelian::find($id);

            foreach ($data->itemppn as $item => $value) {
                if(!empty($data->itemppn[$item]->id)){
                $pengajuanItems = PengajuanPembelian::find($data->itemppn[$item]->id); // Kalau id nya ada maka get
                }else {
                $pengajuanItems = null; // kalau idnnya ga ada maka dbkinn null
                }

                if($pengajuanItems){
                    $preprOldItems = PartItem_Pre_pr::where('id',$pengajuanItems->prepr_id)->first(); //kalau item oldnya ada maka get data old
                } else {
                    $preprOldItems = null; //bikin null kalau item pr nya ga ada
                }

                // dd($preprOldItems->id);
                if($preprOldItems){
                    //Update Data
                    $sumskuy = $preprOldItems->total + $pengajuanItems->qty; //Kalau minus dia ngurang jadi misal 10 + -(8); jadi 2
                    PartItem_Pre_pr::where('id', $preprOldItems->id)->update([
                        'total' => $sumskuy,
                    ]);
                }
            }



            $data->logistic_check = 1;
            $data->status = 'Rejected From Logistics';
            $data->note_logistic = $request->note_logistic;
            $data->save();

            return redirect()->route('logistic.index')->with('message','Success Rejected');
        }
    }

    public function reject_check_logistic_selected(Request $request)
    {
        $check = Role::where('model_id', Auth::user()->id)->first();
        if ($check->role_id == 20) {
            $ids = explode(',', $request->ids);
            $data = CategoryPengajuanPembelian::whereIn($ids)->get();
            foreach($data as $d) {
                $d->logistic_check = 1;
                $d->status = 'Rejected From Logistics';
                $d->note_logistic = $request->note_logistic;
            }

            return redirect()->route('logistic.index')->with('message','Success Rejected');
        }
    }
}
