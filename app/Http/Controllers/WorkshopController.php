<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Workshop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkshopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $check = Auth::user();
        if ($check->role_id == 3) {
            $data = Workshop::paginate(10);
            return view('dataWorkshop.index')
            ->with('data',$data);
        }else {
            return redirect()->route('dashboard');
        }
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
        $check = Auth::user();
        if ($check->role_id == 3) {
            $data = Workshop::all();
            return view('dataWorkshop.create')
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
        if ($check->role_id == 3) {
            //validasi formnya
            $this->validate($request,[
                'name' => 'required',
            ]);

            Workshop::create([
                "name" => $request->name,
            ]);

            return redirect("workshop/")->with('success', 'Created Successfully!');
        }else{
            return redirect()->route('dashboard');
        }
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
        $check = Auth::user();
        if ($check->role_id == 3) {
            $data = Workshop::find($id);
            return view('dataWorkshop.edit')
            ->with('data',$data);
        }else {
            return redirect()->route('dashboard');
        }
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
        $check = Auth::user();
        if ($check->role_id == 3) {
            $data = Workshop::find($id);

            // dd($data);
            $tes = Workshop::where("id", $id)->update([
                "name" => $request->name,
            ]);
            return redirect("workshop/")->with('success', 'Updated Successfully!');
        }else {
            return redirect()->route('dashboard');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Workshop  $workshop
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $check = Auth::user();
        if ($check->role_id == 3) {
            $data = Workshop::find($id);
            $data->delete();
            return redirect("workshop/")->with('success', 'Deleted Successfully!');
        }else {
            return redirect()->route('dashboard');
        }
    }
}
