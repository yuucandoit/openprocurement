<?php

namespace App\Http\Controllers;

use App\Models\RND;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RNDController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $check = Auth::user();
        if ( $check->role_id == 3) {
            $data = RND::paginate(10);
            return view('dataRnD.index')
            ->with('data',$data);
        }else {
            return redirect()->route('dashboard');
        }
    }

    public function SearchRND(Request $request)
   {
    $cari = $request->cari;
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
        $check = Auth::user();
        if ( $check->role_id == 3) {
            $data = RND::all();
            return view('dataRnD.create')
            ->with('data',$data);
        }else {
            return redirect()->route('dashboard');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $check = Auth::user();
        if ( $check->role_id == 3) {
         //validasi formnya
            $this->validate($request,[
                'name' => 'required',
            ]);

        RND::create([
                "name" => $request->name,
            ]);

            return redirect("RnD/")->with('success', 'Created Successfully!');
        }else{
            return redirect()->route('dashboard');
        }
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
        $check = Auth::user();
        if ( $check->role_id == 3) {
            $data = RND::find($id);
            return view('dataRnD.edit')
            ->with('data',$data);
        }else{
            return redirect()->route('dashboard');
        }
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
        $check = Auth::user();
        if ( $check->role_id == 3) {
            $data = RND::find($id);

            $tes = RND::where("id", $id)->update([
                "name" => $request->name,
            ]);
            return redirect("RnD/")->with('success', 'Updated Successfully!');
        }else {
            return redirect()->route('dashboard');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RND  $rND
     * @return \Illuminate\Http\Response
     */
    public function destroy(RND $rND,$id)
    {
        $check = Auth::user();
        if ( $check->role_id == 3) {
            $data = RND::find($id);
            $data->delete();
            return redirect("RnD/")->with('success', 'Deleted Successfully!');
        }else{
            return redirect()->route('dashboard');
        }
    }
}
