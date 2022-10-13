<?php

namespace App\Http\Controllers;

use App\Models\WhoSubmitted;
use Illuminate\Http\Request;

class WhoSubmittedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = WhoSubmitted::all();
        return view('dataWhoSubmitted.index')
        ->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = WhoSubmitted::all();
        return view('dataWhoSubmitted.create')
        ->with('data', $data);
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

       WhoSubmitted::create([
            "name" => $request->name,
        ]);

        return redirect("who-submitted/")->with('success', 'Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WhoSubmitted  $whoSubmitted
     * @return \Illuminate\Http\Response
     */
    public function show(WhoSubmitted $whoSubmitted)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WhoSubmitted  $whoSubmitted
     * @return \Illuminate\Http\Response
     */
    public function edit(WhoSubmitted $whoSubmitted, $id)
    {
        $data = WhoSubmitted::find($id);
        return view('dataWhoSubmitted.edit')
        ->with('data', $data);
    }   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WhoSubmitted  $whoSubmitted
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = WhoSubmitted::where('id',$id);

        // dd($data);
        $tes = WhoSubmitted::where("id", $id)->update([
            "name" => $request->name,
        ]);
        return redirect("who-submitted/")->with('success', 'Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WhoSubmitted  $whoSubmitted
     * @return \Illuminate\Http\Response
     */
    public function destroy(WhoSubmitted $whoSubmitted,$id)
    {
        $data = WhoSubmitted::find($id);
        $data->delete();
        return redirect("who-submitted/")->with('success', 'Deleted Successfully!');
    }
}
