<?php

namespace App\Http\Controllers;

use App\Imports\BankImport;
use App\Models\Bank;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Bank::paginate(10);
        return view('dataBank.index')
        ->with('data',$data);
    }

    public function SearchBank(Request $request)
   {
    $cari = $request->cari;
    //dd($cari);
    $data = Bank::Where('id','like',"%".$cari."%")
    ->orWhere('name','like',"%".$cari."%")
    ->orWhere('call_center','like',"%".$cari."%")
    ->orWhere('bank','like',"%".$cari."%")
    ->paginate(10);

    return view('dataTravel.index')
    ->with('data',$data);
   }

    public function import(Request $request)
    {
        //Validasi
        $this->validate($request, [
            'file' => 'required|mimes:xls,xlsx'
        ]);

        if ($request->hasFile('file')) {
            //UPLOAD FILE
            $file = $request->file('file'); //GET FILE
            // dd($file);
            Excel::import(new BankImport, $file); //IMPORT FILE
            return redirect()->back()->with(['success' => 'Upload file data !']);
        }

        return redirect()->back()->with(['error' => 'Please choose file before!']);
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
        Bank::create([
            'name' => $request->name,
            'alamat' => $request->alamat,
            'call_center' => $request->call_center,
        ]);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function show(Bank $bank)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function edit(Bank $bank,$id)
    {
        $data = Bank::find($id);
        return view('dataBank.edit')
        ->with('data',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        Bank::where('id',$id)->update([
            'name' => $request->name,
            'alamat' => $request->alamat,
            'call_center' => $request->call_center,
        ]);
        return redirect('/bank');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bank $bank,$id)
    {
        $data = Bank::find($id);
        $data->delete();
        return redirect('/bank');
    }
}
