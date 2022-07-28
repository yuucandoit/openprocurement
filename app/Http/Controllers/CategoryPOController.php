<?php

namespace App\Http\Controllers;

use App\Models\CategoryPO;
use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;

class CategoryPOController extends Controller
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
            $datapo = CategoryPO::where('user_id', Auth::user()->id)->get();
            return view('purchaseOrder.menu.index')
                ->with('datapo', $datapo);
        } else if ($check->role_id == 1 || $check->role_id == 3) {
            $datapo = CategoryPO::all();
            return view('purchaseOrder.menu.index')
                ->with('datapo', $datapo);
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
        $po = $request->except(['_token']);
        $po['user_id'] = Auth::user()->id;
        CategoryPO::insert($po);
        return redirect('menu-purchase-order/')->with('success', 'Task Created Successfully!');
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
        $data = CategoryPO::find($id);
        $data->delete();
        return redirect('/menu-purchase-order')->with('success', 'Task Deleted Successfully!');
    }

    public function accept($id)
    {
        $data = CategoryPO::find($id);
        // dd($data);
        $data->status = 'Accepted';
        $data->save();
        return redirect()->back();
    }

    public function Reject($id)
    {
        $data = CategoryPO::find($id);
        $data->status = 'Rejected';
        $data->save();
        return redirect()->back();
    }
}
