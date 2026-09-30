<?php

namespace App\Http\Controllers;

use App\Models\Office;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OfficeController extends Controller
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
            $data = Office::paginate(10);
            return view('dataOffice.index')
            ->with('data',$data);
        }else {
            return redirect()->route('dashboard');
        }
    }

    public function SearchOffice(Request $request)
   {
    $cari = $request->cari;
    //dd($cari);
    $data = Office::Where('id','like',"%".$cari."%")
    ->orWhere('name','like',"%".$cari."%")
    ->paginate(10);

    return view('dataOffice.index')
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
            $data = Office::all();
            return view('dataOffice.create')
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

            Office::create([
                "name" => $request->name,
            ]);

            return redirect("office/")->with('success', 'Created Successfully!');
        }else {
            return redirect()->route('dashboard');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function show(Office $office)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function edit(Office $office,$id)
    {
        $check = Auth::user();
        if ( $check->role_id == 3) {
            $data = Office::find($id);
            return view('dataOffice.edit')
            ->with('data',$data);
        }else {
            return redirect()->route('dashboard');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Office $office,$id)
    {
        $check = Auth::user();
        if ( $check->role_id == 3) {
            $data = Office::find($id);

            // dd($data);
            $tes = Office::where("id", $id)->update([
                "name" => $request->name,
            ]);
            return redirect("office/")->with('success', 'Updated Successfully!');
        }else {
            return redirect()->route('dashboard');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function destroy(Office $office,$id)
    {
        $check = Auth::user();
        if ( $check->role_id == 3) {
            $data = Office::find($id);
            $data->delete();
            return redirect("office/")->with('success', 'Deleted Successfully!');
        }else {
            return redirect()->route('dashboard');
        }
    }
}
