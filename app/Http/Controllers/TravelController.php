<?php

namespace App\Http\Controllers;

use App\Models\Travel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TravelController extends Controller
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
            $data = Travel::paginate(10);
            return view('dataTravel.index')
            ->with('data',$data);
        }else {
            return redirect()->route('dashboard');
        }
    }

    public function SearchTravel(Request $request)
   {
    $cari = $request->cari;
    $data = Travel::Where('id','like',"%".$cari."%")
    ->orWhere('name','like',"%".$cari."%")
    ->paginate(10);

    return view('dataTravel.index')
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
            return view('dataTravel.create');
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
            $this->validate($request,[
                'name' => 'required',
            ]);

        Travel::create([
                "name" => $request->name,
            ]);

            return redirect("travel/")->with('success', 'Created Successfully!');
        }else {
            return redirect()->route('dashboard');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Travel  $travel
     * @return \Illuminate\Http\Response
     */
    public function show(Travel $travel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Travel  $travel
     * @return \Illuminate\Http\Response
     */
    public function edit(Travel $travel,$id)
    {
        $check = Auth::user();
        if ($check->role_id == 3) {
            $data = Travel::find($id);
            return view('dataTravel.edit')
            ->with('data',$data);
        }else {
            return redirect()->route('dashboard');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Travel  $travel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Travel $travel,$id)
    {
        $check = Auth::user();
        if ($check->role_id == 3) {
            $this->validate($request,[
                'name' => 'required',
            ]);

        Travel::where('id',$id)->update([
                "name" => $request->name,
            ]);

            return redirect("travel/")->with('success', 'Created Successfully!');
        }else {
            return redirect()->route('dashboard');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Travel  $travel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Travel $travel,$id)
    {
        $check = Auth::user();
        if ($check->role_id == 3) {
            $data = Travel::find($id);
            $data->delete();
            return redirect("travel/")->with('success', 'Deleted Successfully!');
        }else {
            return redirect()->route('dashboard');
        }
    }
}
