<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\WhoSubmitted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WhoSubmittedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $check = Role::where('model_id', Auth::user()->id)->first();
        if ($check->role_id == 3) {
            $data = WhoSubmitted::paginate(10);
            return view('dataWhoSubmitted.index')
            ->with('data',$data);
        }else {
            return redirect()->route('dashboard');
        }
    }

    public function SearchWS(Request $request)
    {
     $cari = $request->cari;
     //dd($cari);
     $data = WhoSubmitted::Where('id','like',"%".$cari."%")
     ->orWhere('name','like',"%".$cari."%")
     ->paginate(10);

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
        $check = Role::where('model_id', Auth::user()->id)->first();
        if ($check->role_id == 3) {
            $data = WhoSubmitted::all();
            return view('dataWhoSubmitted.create')
            ->with('data', $data);
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
        $check = Role::where('model_id', Auth::user()->id)->first();
        if ($check->role_id == 3) {
            //validasi formnya
            $this->validate($request,[
                'name' => 'required',
            ]);

        WhoSubmitted::create([
                "name" => $request->name,
            ]);

            return redirect("who-submitted/")->with('success', 'Created Successfully!');
        }else {
            return redirect()->route('dashboard');
        }
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
        $check = Role::where('model_id', Auth::user()->id)->first();
        if ($check->role_id == 3) {
            $data = WhoSubmitted::find($id);
            return view('dataWhoSubmitted.edit')
            ->with('data', $data);
        }else {
            return redirect()->route('dashboard');
        }
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
        $check = Role::where('model_id', Auth::user()->id)->first();
        if ($check->role_id == 3) {
            $data = WhoSubmitted::where('id',$id);

            // dd($data);
            $tes = WhoSubmitted::where("id", $id)->update([
                "name" => $request->name,
            ]);
            return redirect("who-submitted/")->with('success', 'Updated Successfully!');
        }else {
            return redirect()->route('dashboard');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WhoSubmitted  $whoSubmitted
     * @return \Illuminate\Http\Response
     */
    public function destroy(WhoSubmitted $whoSubmitted,$id)
    {
        $check = Role::where('model_id', Auth::user()->id)->first();
        if ($check->role_id == 3) {
            $data = WhoSubmitted::find($id);
            $data->delete();
            return redirect("who-submitted/")->with('success', 'Deleted Successfully!');
        }else {
            return redirect()->route('dashboard');
        }
    }
}
