<?php

namespace App\Http\Controllers;

use App\Models\CategoryPD;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;

class CategoryPDController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $check = Role::where('model_id', Auth::user()->id)->first();
        if ($check->role_id == 5) {
            $datapd = CategoryPD::where('user_id', Auth::user()->id)->get();
            return view('pengajuanDana.menu.index')
                ->with('datapd', $datapd);
        } else if ($check->role_id == 3 || $check->role_id == 5 || $check->role_id == 2) {
            $datapd = CategoryPD::all();
            return view('pengajuanDana.menu.index')
                ->with('datapd', $datapd);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorypd = CategoryPD::all();
        return view('pengajuanDana.menu.create')
            ->with('categorypd', $categorypd);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pd = $request->except(['_token']);
        $pd['user_id'] = Auth::user()->id;
        CategoryPD::insert($pd);
        return redirect('menu-pengajuan-dana/')->with('success', 'Task Created Successfully!');
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
        $delete = CategoryPD::find($id);
        $delete->delete();
        return redirect('/menu-pengajuan-dana')->with('success', 'Task Deleted Successfully!');
    }

    public function accept($id)
    {
        $data = CategoryPD::find($id);
        // dd($data);
        $data->status = 'Accepted';
        $data->save();
        return redirect()->back();
    }

    public function Reject($id)
    {
        $data = CategoryPD::find($id);
        $data->status = 'Rejected';
        $data->save();
        return redirect()->back();
    }
}
