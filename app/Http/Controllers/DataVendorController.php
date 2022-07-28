<?php

namespace App\Http\Controllers;

use App\Models\DataVendor;
use Illuminate\Http\Request;

class DataVendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datavendor['datavendor'] = DataVendor::all();
        return view('dataVendor.index',$datavendor);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dataVendor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request )
    {
        $request->validate([
            "npwp" => 'required',
            "nama" => 'required',
            "no_telp" =>'required',
            "alamat" => 'required',
            "email" => 'required',
            "pkp" => 'required',
            "jenis_usaha" => 'required'
        ]);
        $datavendor = new DataVendor();
        $datavendor->npwp = $request->npwp;
        $datavendor->nama = $request->nama;
        $datavendor->no_telp = $request->no_telp;
        $datavendor->alamat = $request->alamat;
        $datavendor->email = $request->email;
        $datavendor->pkp = $request->pkp;
        $datavendor->jenis_usaha = $request->jenis_usaha;
        $datavendor->save();

        return redirect()->route('datavendor.index')->with('success', 'Task Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $datavendor = DataVendor::where('id', $id)->first();
        return view('dataVendor.show')->with('datavendor',$datavendor);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(DataVendor $datavendor)
    {

        return view('dataVendor.show',compact('datavendor'));
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
        //     "npwp" => 'required',
        //     "nama" => 'required',
        //     "no_telp" =>'required',
        //     "alamat" => 'required',
        //     "email" => 'required',

        // ]);
        $datavendor = DataVendor::find($id);
        $data = DataVendor::where("id" ,$id)->update([
            "npwp" => $request->npwp,
            "nama" => $request->nama,
            "no_telp" =>$request->no_telp,
            "alamat" => $request->alamat,
            "email" => $request->email,
            "Pkp" => $request->Pkp,
            "jenis_usaha" => $request->jenis_usaha,
        ]);

        return redirect('/data-vendor')->with('success', 'Task Created Successfully!');
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
    }
}
