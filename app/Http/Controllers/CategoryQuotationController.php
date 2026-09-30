<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryQuotation;
use App\Models\Q_Quotation;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;

class CategoryQuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $check = Auth::user();
        if ($check->role_id == 2 || $check->role_id == 18) {
            $dataqt = CategoryQuotation::where('user_id', Auth::user()->id)->get();
            return view('quotation.menu.index')
                ->with('dataqt', $dataqt);
        } else if ($check->role_id == 1 || $check->role_id == 4) {
            $dataqt = CategoryQuotation::all();
            return view('quotation.menu.index')
                ->with('dataqt', $dataqt);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('quotation.menu.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $qt = $request->except(['_token']);
        $qt['user_id'] = Auth::user()->id;
        CategoryQuotation::insert($qt);
        return redirect('menu-quotation/')->with('success', 'Task Created Successfully!');
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
        // dd("halo");
        $data = CategoryQuotation::find($id);
        // dd($data);
        $data->delete();
        $data_q = Q_Quotation::where('category_id', $id)->get();
        foreach ($data_q as $dt) {
            $dt->delete();
        }
        return redirect('/menu-quotation')->with('success', 'Task Deleted Successfully!');
    }

    public function accept($id)
    {
        $data = CategoryQuotation::find($id);
        $data->status = 'Accepted';
        $data->save();
        return redirect()->back();
    }

    public function Reject($id)
    {
        $data = CategoryQuotation::find($id);
        $data->status = 'Rejected';
        $data->save();
        return redirect()->back();
    }
}
