<?php

namespace App\Http\Controllers;

use App\Models\RND;
use Illuminate\Http\Request;

class RNDController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = RND::paginate(10);
        return view('dataRnD.index')
        ->with('data',$data);
    }

    public function SearchRND(Request $request)
   {
    $cari = $request->cari;
    //dd($cari);
    $data = RND::Where('id','like',"%".$cari."%")
    ->orWhere('name','like',"%".$cari."%")
    ->paginate(10);

    return view('dataRnD.index')
    ->with('data',$data);
   }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = RND::all();
        return view('dataRnD.create')
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

       RND::create([
            "name" => $request->name,
        ]);

        return redirect("RnD/")->with('success', 'Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RND  $rND
     * @return \Illuminate\Http\Response
     */
    public function show(RND $rND)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RND  $rND
     * @return \Illuminate\Http\Response
     */
    public function edit(RND $rND,$id)
    {
        $data = RND::find($id);
        return view('dataRnD.edit')
        ->with('data',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RND  $rND
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = RND::find($id);

        // dd($data);
        $tes = RND::where("id", $id)->update([
            "name" => $request->name,
        ]);
        return redirect("RnD/")->with('success', 'Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RND  $rND
     * @return \Illuminate\Http\Response
     */
    public function destroy(RND $rND,$id)
    {
        $data = RND::find($id);
        $data->delete();
        return redirect("RnD/")->with('success', 'Deleted Successfully!');
    }
}
