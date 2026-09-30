<?php

namespace App\Http\Controllers;

use App\Imports\CurrencyImport;
use App\Models\Currency;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $check = Auth::user();
        if ($check->role_id == 1 || $check->role_id == 3 || $check->role_id == 4) {
        $data = Currency::orderBy('name','asc')->paginate(10);
        return view('dataCurrency.index')
        ->with('data',$data);
        }else {
            return redirect()->route('dashboard');
        }
    }

    public function SearchCurrency(Request $request)
    {
     $cari = $request->cari;
     //dd($cari);
     $data = Currency::Where('id','like',"%".$cari."%")
     ->orWhere('name','like',"%".$cari."%")
     ->orWhere('code','like',"%".$cari."%")
     ->paginate(10);

     return view('dataCurrency.index')
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
            Excel::import(new CurrencyImport, $file); //IMPORT FILE
            return redirect()->back()->with(['success' => 'Upload file data !']);
        }

        return redirect()->back()->with(['error' => 'Please choose file before!']);
    }

    public function store(Request $request)
    {
        $check = Auth::user();
        if ($check->role_id == 1 || $check->role_id == 3 || $check->role_id == 4) {
        Currency::create([
            'name' => $request->name,
            'code' => $request->code,
        ]);
        return redirect()->back();
        }else {
            return redirect()->route('dashboard');
        }
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
    public function edit($id)
    {
        //
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
        $check = Auth::user();
        if ($check->role_id == 1 || $check->role_id == 3 || $check->role_id == 4) {
        Currency::where('id',$id)->update([
            'name' => $request->name,
            'code' => $request->code,
        ]);
        return redirect('/currency');
        }else {
            return redirect()->route('dashboard');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $check = Auth::user();
        if ($check->role_id == 1 || $check->role_id == 3) {
        $data = Currency::find($id);
        $data->delete();
        return redirect('/currency');
        }else {
            return redirect()->route('dashboard');
        }
    }
}
