<?php

namespace App\Http\Controllers;

use App\Models\Workshop;
use Illuminate\Http\Request;

class WorkshopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Workshop::paginate(10);
        return view('dataWorkshop.index')
        ->with('data',$data);
    }

    public function SearchWorkshop(Request $request)
   {
    $cari = $request->cari;
    //dd($cari);
    $data = Workshop::Where('id','like',"%".$cari."%")
    ->orWhere('name','like',"%".$cari."%")
    ->paginate(10);

    return view('dataWorkshop.index')
    ->with('data',$data);
   }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Workshop::all();
        return view('dataWorkshop.create')
        ->with('data',$data);
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
            'name' => 'required',
        ]);

       Workshop::create([
            "name" => $request->name,
        ]);

        return redirect("workshop/")->with('success', 'Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Workshop  $workshop
     * @return \Illuminate\Http\Response
     */
    public function show(Workshop $workshop)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Workshop  $workshop
     * @return \Illuminate\Http\Response
     */
    public function edit(Workshop $workshop,$id)
    {
        $data = Workshop::find($id);
        return view('dataWorkshop.edit')
        ->with('data',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Workshop  $workshop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Workshop $workshop,$id)
    {
        $data = Workshop::find($id);

        // dd($data);
        $tes = Workshop::where("id", $id)->update([
            "name" => $request->name,
        ]);
        return redirect("workshop/")->with('success', 'Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Workshop  $workshop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Workshop $workshop,$id)
    {
        $data = Workshop::find($id);
        $data->delete();
        return redirect("workshop/")->with('success', 'Deleted Successfully!');
    }
}
