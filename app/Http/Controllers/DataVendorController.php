<?php

namespace App\Http\Controllers;

use App\Exports\DvExport;
use App\Models\CategoryDV;
use App\Models\DataVendor;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DataVendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function menu()
    {
        return view('dataVendor.menu.index');
    }

    public function index($id)
    {
        $data_vendor = CategoryDV::find($id);
        $dv = DataVendor::where('dv_id', $id)->get();
        return view('dataVendor.index')
            ->with('dv', $dv)
            ->with('data_vendor', $data_vendor);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $vendor = DataVendor::all();
        $data_vendor = CategoryDV::find($id);
        // dd($data_company_po);
        return view('dataVendor.create')
            ->with('data_vendor', $data_vendor)
            ->with('vendor', $vendor);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $dv = $request->except(['_token']);
        // dd($po);
       DataVendor::insert([
            "dv_id" => $id,
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
    public function show($dv_id ,$id)
    {
        $data = CategoryDV::find($dv_id);

        $dv = DataVendor::where('id', $id)->first();
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

        $data = DataVendor::find($id);

        // dd($data);
        $tes = DataVendor::where("id", $id)->update([
            "npwp" => $request->npwp,
            "Pkp" => $request->Pkp,
            "jenis_usaha" => $request->jenis_usaha,
        ]);
        return redirect("data-vendor/" . $data->dv_id);
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
        $datavendor = DataVendor::find($id);
        $datavendor->delete();
        return redirect()->view('datavendor.index')->with('success','Task Deleted Successfully!');
        $item = DataVendor::find($id);
        $item->delete();
        return redirect("data-vendor/" . $item->dv_id)->with('success', 'Task Deleted Successfully!');
    }

    public function export($id)
    {
        // dd('hallo');
        return Excel::download(new DvExport($id), 'vendor.xlsx');
    }
}
