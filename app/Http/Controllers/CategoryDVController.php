<?php

namespace App\Http\Controllers;

use App\Models\CategoryDV;
use App\Models\DataVendor;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryDVController extends Controller
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
            $datadv = CategoryDV::where('user_id', Auth::user()->id)->get();
            return view('dataVendor.menu.index')
                ->with('datadv', $datadv);
        } else if ($check->role_id == 1 || $check->role_id == 3) {
            $datadv = CategoryDV::all();
            return view('dataVendor.menu.index')
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
        $dv = $request->except(['_token']);
        $dv['user_id'] = Auth::user()->id;
        CategoryDV::insert($dv);
        return redirect('menu-data-vendor/')->with('success', 'Task Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($dv_id,$id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //$data = CategoryDV::find($dv_id);

        $dv = CategoryDV::where('id', $id)->first();
        // dd($po);
        return view('dataVendor.menu.edit')
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
        $data = CategoryDV::find($id);

        // dd($data);
        $tes = CategoryDV::where("id", $id)->update([
            "nama" => $request->nama,
            "no_telp" => $request->no_telp,
            "alamat" => $request->alamat,
            "email" => $request->email,
        ]);
        return redirect("menu-data-vendor/");
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

        $data = CategoryDV::find($id);

        DataVendor::find($id)->delete();

        $data->delete();
        return redirect('/menu-data-vendor')->with('success', 'Task Deleted Successfully!');
    }
}
