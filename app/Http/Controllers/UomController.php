<?php

namespace App\Http\Controllers;

use App\Imports\UomImport;
use App\Models\Uom;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class UomController extends Controller
{
    public function index()
    {
        $check = Role::where('model_id', Auth::user()->id)->first();
        if ($check->role_id == 1 || $check->role_id == 3 || $check->role_id == 4) {
        $data = Uom::orderBy('name','asc')->paginate(10);
        return view('dataUom.index')
        ->with('data',$data);
        }else {
            return redirect()->route('dashboard');
        }
    }

    public function SearchUom(Request $request)
    {
     $cari = $request->cari;
     //dd($cari);
     $data = Uom::Where('id','like',"%".$cari."%")
     ->orWhere('name','like',"%".$cari."%")
     ->paginate(10);

     return view('dataUom.index')
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
            Excel::import(new UomImport, $file); //IMPORT FILE
            return redirect()->back()->with(['success' => 'Upload file data !']);
        }

        return redirect()->back()->with(['error' => 'Please choose file before!']);
    }

    public function store(Request $request)
    {
        $check = Role::where('model_id', Auth::user()->id)->first();
        if ($check->role_id == 1 || $check->role_id == 3 || $check->role_id == 4) {
        Uom::create([
            'name' => $request->name,
        ]);
        return redirect()->back();
        }else {
            return redirect()->route('dashboard');
        }
    }

    public function show(Bank $bank)
    {
        //
    }

    public function edit(Bank $bank,$id)
    {
        //
    }

    public function update(Request $request,$id)
    {
        $check = Role::where('model_id', Auth::user()->id)->first();
        if ($check->role_id == 1 || $check->role_id == 3 || $check->role_id == 4) {
        Uom::where('id',$id)->update([
            'name' => $request->name,
        ]);
        return redirect('/uom');
        }else {
            return redirect()->route('dashboard');
        }
    }


    public function destroy($id)
    {
        $check = Role::where('model_id', Auth::user()->id)->first();
        if ($check->role_id == 1 || $check->role_id == 3) {
        $data = Str::createUuidsNormally()::find($id);
        $data->delete();
        return redirect('/uom');
        }else {
            return redirect()->route('dashboard');
        }
    }
}
