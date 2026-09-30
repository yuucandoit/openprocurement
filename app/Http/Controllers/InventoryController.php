<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
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
        $data = Inventory::paginate(10);
        return view('dataInventory.index')
        ->with('data',$data);
        }else{
            return redirect()->route('dashboard');
        }
    }

    public function SearchInventory(Request $request)
   {
    $cari = $request->cari;
    //dd($cari);
    $data = Inventory::Where('id','like',"%".$cari."%")
    ->orWhere('name','like',"%".$cari."%")
    ->paginate(10);

    return view('dataInventory.index')
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
            $data = Inventory::all();
            return view('dataInventory.create')
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

            Inventory::create([
                "name" => $request->name,
            ]);

            return redirect("inventory/")->with('success', 'Created Successfully!');
        }else {
            return redirect()->route('dashboard');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function show(Inventory $inventory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function edit(Inventory $inventory,$id)
    {
        $check = Auth::user();
        if ($check->role_id == 3) {
            $data = Inventory::find($id);
            return view('dataInventory.edit')
            ->with('data',$data);
        }else {
            return redirect()->route('dashboard');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inventory $inventory,$id)
    {
        $check = Auth::user();
        if ($check->role_id == 3) {
            $data = Inventory::find($id);

            // dd($data);
            $tes = Inventory::where("id", $id)->update([
                "name" => $request->name,
            ]);
            return redirect("inventory/")->with('success', 'Updated Successfully!');
        }else{
            return redirect()->route('dashboard');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inventory $inventory,$id)
    {
        $check = Auth::user();
        if ($check->role_id == 3) {
            $data = Inventory::find($id);
            $data->delete();
            return redirect("inventory/")->with('success', 'Deleted Successfully!');
        }else{
            return redirect()->route('dashboard');
        }
    }
}
