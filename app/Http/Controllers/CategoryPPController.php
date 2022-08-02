<?php

namespace App\Http\Controllers;

use App\Exports\DvExport;
use App\Exports\PPExport;
use App\Models\CategoryPP;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class CategoryPPController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $check = Role::where('model_id', Auth::user()->id)->first();
        if ($check->role_id == 2) {
            $datadv = CategoryPP::where('user_id', Auth::user()->id)->get();
            return view('dataPrivatePerson.menu.index')
                ->with('datadv', $datadv);
        } else if ($check->role_id == 1 || $check->role_id == 3) {
            $datadv = CategoryPP::all();
            return view('dataPrivatePerson.menu.index')
                ->with('datadv', $datadv);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

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
        'nama' => 'required',
        'alamat' => 'required',
        'nik' => 'required',
        'npwp_pp' => 'required',
        'pkp' => 'required',
    ]);

    $dv = $request->except(['_token']);
    $dv['user_id'] = Auth::user()->id;
    CategoryPP::insert($dv);
    return redirect('menu-private-person/')->with('success', 'Task Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dv = CategoryPP::find($id);
        return view('dataPrivatePerson.menu.edit')
        ->with('dv' , $dv);
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
        $data = CategoryPP::find($id);

        // dd($data);
        $tes = CategoryPP::where("id", $id)->update([
            "nama" => $request->nama,
            "alamat" => $request->alamat,
            "nik" => $request->nik,
            "npwp_pp" => $request->npwp_pp,
            "pkp" => $request->pkp,
        ]);
        return redirect("menu-private-person/");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = CategoryPP::find($id);
        $data->delete();
        return redirect('/menu-private-person')->with('success', 'Task Deleted Successfully!');
    }
    public function export($id)
    {
        // dd('hallo');
        return Excel::download(new PPExport($id), 'PrivatePerson.xlsx');
    }
}
