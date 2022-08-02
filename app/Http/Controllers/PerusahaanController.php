<?php

namespace App\Http\Controllers;

use App\Exports\DvExport;
use App\Exports\PTExport;
use App\Models\CategoryDV;
use App\Models\CategoryPT;
use App\Models\DataVendor;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PerusahaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // public function menu()
    // {
    //     return view('dataVendor.menu.index');
    // }

    public function index($id)
    {
        /*$data_vendor*/  $data_perusahaan = CategoryPT::find($id);
        /*$dv*/ $pt = Perusahaan::where('pt_id', $id)->get();
        return view('dataVendor.index')
            ->with('pt', $pt)
            ->with('data_vendor', $data_perusahaan);
    }

    public function detail($id)
    {
        /*$data_vendor*/  $data_perusahaan = CategoryPT::find($id);
        /*$dv*/ $pt = Perusahaan::where('pt_id', $id)->get();
        return view('dataPerusahaan.detail')
            ->with('pt', $pt)
            ->with('data_perusahaan', $data_perusahaan);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
       /*$vendor*/  $perusahaan = Perusahaan::all();
        /*$data_vendor*/ $data_perusahaan = CategoryPT::find($id);
        // dd($data_company_po);
        return view('dataVendor.create')
            ->with('data_perusahaan', $data_perusahaan)
            ->with('perusahaan', $perusahaan);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        //validasi formnya
        $this->validate($request,[
            'pt_id' => 'required',
            'npwp' => 'required',
            'Pkp' => 'required',
            'jenis_usaha' => 'required',
        ]);

        $dv = $request->except(['_token']);
        // dd($po);
       Perusahaan::insert([
            "pt_id" => $id,
            "npwp" => $request->npwp,
            "Pkp" => $request->Pkp,
            "jenis_usaha" => $request->jenis_usaha,
        ]);

        return redirect("data-vendor/" . $id)->with('success', 'Task Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($pt_id ,$id)
    {
        $data = CategoryPT::find($pt_id);

        $dv = Perusahaan::where('id', $id)->first();
        // dd($po);
        return view('dataVendor.show')
        ->with('dv', $dv)
        ->with('data', $data);

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

        $data = Perusahaan::find($id);

        // dd($data);
        $tes = Perusahaan::where("id", $id)->update([
            "npwp" => $request->npwp,
            "Pkp" => $request->Pkp,
            "jenis_usaha" => $request->jenis_usaha,
        ]);
        return redirect("data-vendor/" . $data->pt_id);
        // dd($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $datavendor = Perusahaan::find($id);
        $datavendor->delete();
        return redirect()->view('datavendor.index')->with('success','Task Deleted Successfully!');
        $item = Perusahaan::find($id);
        $item->delete();
        return redirect("data-vendor/" . $item->pt_id)->with('success', 'Task Deleted Successfully!');
    }

    public function export($id)
    {
        // dd('hallo');
        return Excel::download(new PTExport($id), 'perusahaan.xlsx');
    }
}
