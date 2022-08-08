<?php

namespace App\Http\Controllers;

use App\Models\CategoryPengajuanPembelian;
use App\Models\CategoryPO;
use App\Models\CategoryPT;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
            $datapt = CategoryPT::all();
            $datapo = CategoryPO::all();
            $datadv = CategoryPengajuanPembelian::where('user_id', Auth::user()->id)->get();
            return view('pengajuanPembelian.menu.index')
                ->with('datapt',$datapt)
                ->with('datapo', $datapo)
                ->with('datadv', $datadv);
        } else if ($check->role_id == 1 || $check->role_id == 3) {
            $datapt = CategoryPT::all();
            $datapo = CategoryPO::all();
            $datadv = CategoryPengajuanPembelian::all();
            return view('pengajuanPembelian.menu.index')
                ->with('datapt',$datapt)
                ->with('datapo', $datapo)
                ->with('datadv', $datadv);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dv = CategoryPT::all();
        $dv = CategoryPO::all();
        $dv = $request->except(['_token']);
        $dv['user_id'] = Auth::user()->id;
        CategoryPengajuanPembelian::insert($dv);
        return redirect('menu-pengajuan-pembelian/')->with('success', 'Task Created Successfully!');
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
    public function edit(Request $request ,$id)
    {
        $dv = CategoryPengajuanPembelian::find($id);
        return view('dataPerusahaan.menu.edit')
        ->with('dv' , $dv);
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
        $data = CategoryPengajuanPembelian::find($id);

        // dd($data);
        $tes = CategoryPengajuanPembelian::where("id", $id)->update([
            "pt_id" => $request->pt_id,
            "po_id" => $request->alpo_idamat,
            "date_ps" => $request->date_ps,
            "ws" => $request->ws,
            "item" => $request->item,
            "qty" => $request->qty,
            "ref" => $request->ref,
            "desc" => $request->desc,
            "purpose" => $request->purpose,
            "priceperunit" => $request->priceperunit,
            "send_to" => $request->send_to,
            "date_send" => $request->date_send,
            "proposed_supplier" => $request->proposed_supplier,
        ]);
        return redirect("menu-perusahaan/");
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
        return redirect('/menu-perusahaan')->with('success', 'Task Deleted Successfully!');
    }
}
