<?php

namespace App\Http\Controllers;

use App\Models\CategoryEcommerce;
use App\Models\Ecommerce;
use Illuminate\Http\Request;

class EcommerceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $data_ecommerce = CategoryEcommerce::find($id);
        $ec = Ecommerce::where('ec_id', $id)->get();
        return view('dataEcommerce.index')
        ->with('ec', $ec)
        ->with('data_ecommerce', $data_ecommerce);
    }

    public function detail($id)
    {
        $data_ecommerce = CategoryEcommerce::find($id);
        $ec = Ecommerce::where('ec_id', $id)->get();
        return view('dataEcommerce.detail')
            ->with('ec', $ec)
            ->with('data_ecommerce', $data_ecommerce);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
         /*$perusahaan*/  $ecommerce = Ecommerce::all();
        /*$data_perusahaan*/ $data_ecommerce = CategoryEcommerce::find($id);
        return view('dataVendor.create')
            ->with('data_ecommerce', $data_ecommerce)
            ->with('ecommerce', $ecommerce);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request , $id)
    {

        $dv = $request->except(['_token']);
       Ecommerce::insert([
            "ec_id" => $id,
            "nama" => $request->nama,
            "link" => $request->link,
        ]);

        return redirect("data-ecommerce/" . $id)->with('success', 'Task Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $ec_id)
    {
        $data = CategoryEcommerce::find($ec_id);

        $dv = Ecommerce::where('id', $id)->first();
        return view('dataVendor.show')
        ->with('dv', $dv)
        ->with('data', $data);
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
        $data = Ecommerce::find($id);

        $tes = Ecommerce::where("id", $id)->update([
            "nama" => $request->nama,
            "link" => $request->link,
        ]);
        return redirect("#" . $data->pp_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $datavendor = Ecommerce::find($id);
        $datavendor->delete();
        return redirect()->view('datavendor.index')->with('success','Task Deleted Successfully!');
        $item = Ecommerce::find($id);
        $item->delete();
        return redirect("data-vendor/" . $item->pp_id)->with('success', 'Task Deleted Successfully!');
    }
}
