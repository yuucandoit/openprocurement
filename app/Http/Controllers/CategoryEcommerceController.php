<?php

namespace App\Http\Controllers;

use App\Exports\DvExport;
use App\Exports\EcExport;
use App\Models\CategoryEcommerce;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class CategoryEcommerceController extends Controller
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
            $datadv = CategoryEcommerce::where('user_id', Auth::user()->id)->get();
            return view('dataEcommerce.menu.index')
                ->with('datadv', $datadv);
        } else if ($check->role_id == 1 || $check->role_id == 3) {
            $datadv = CategoryEcommerce::all();
            return view('dataEcommerce.menu.index')
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
           //validasi formnya
       $this->validate($request,[
        'nama' => 'required',
        'link' => 'required',
    ]);

    $dv = $request->except(['_token']);
    $dv['user_id'] = Auth::user()->id;
    CategoryEcommerce::insert($dv);
    return redirect('menu-ecommerce/')->with('success', 'Task Created Successfully!');
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
        $dv = CategoryEcommerce::find($id);
        return view('dataEcommerce.menu.edit')
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
        $data = CategoryEcommerce::find($id);

        // dd($data);
        $tes = CategoryEcommerce::where("id", $id)->update([
            "nama" => $request->nama,
            "link" => $request->link,
        ]);
        return redirect("menu-ecommerce/");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = CategoryEcommerce::find($id);
        $data->delete();
        return redirect('/menu-ecommerce')->with('success', 'Task Deleted Successfully!');
    }

    public function export($id)
    {
        // dd('hallo');
        return Excel::download(new EcExport($id), 'Ecommerce.xlsx');
    }
}
