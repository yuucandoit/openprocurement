<?php

namespace App\Http\Controllers;

use App\Models\CategoryPB;
use App\Models\PengajuanDana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;

class CategoryPBController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $check = Role::where('model_id', Auth::user()->id)->first();
        if ($check->role_id == 2 || $check->role_id == 18) {
            $datapb = CategoryPB::where('user_id', Auth::user()->id)->get();
            return view('pembelianBarang.menu.index')
                ->with('datapb', $datapb);
        } else if ($check->role_id == 1 || $check->role_id == 3) {
            $datapb = CategoryPB::all();
            return view('pembelianBarang.menu.index')
                ->with('datapb', $datapb);
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
        $pb = $request->except(['_token']);
        $pb['user_id'] = Auth::user()->id;
        CategoryPB::insert($pb);
        return redirect("menu-pembelian-barang/")->with('success', 'Task Created Successfully!');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = CategoryPB::find($id);
        $delete->delete();
        return redirect('/menu-pembelian-barang')->with('success', 'Task Deleted Successfully!');
    }

    public function accept($id)
    {
        $data = CategoryPB::find($id);
        $data->status = 'Accepted';
        $data->save();
        return redirect()->back();
    }

    public function Reject($id)
    {
        $data = CategoryPB::find($id);
        $data->status = 'Rejected';
        $data->save();
        return redirect()->back();
    }
}
