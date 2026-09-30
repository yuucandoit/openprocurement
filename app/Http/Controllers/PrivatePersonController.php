<?php

namespace App\Http\Controllers;

use App\Models\CategoryPP;
use App\Models\PrivatePerson;
use Illuminate\Http\Request;

class PrivatePersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        /*$data_perusahaan*/  $data_person = CategoryPP::find($id);
        /*$pt*/ $pp = PrivatePerson::where('pp_id', $id)->get();
        return view('dataPrivatePerson.index')
            ->with('pp', $pp)
            ->with('data_person', $data_person);
    }

    public function detail($id)
    {
        /*$data_perusahaan*/  $data_person = CategoryPP::find($id);
        /*$pt*/ $pp = PrivatePerson::where('pp_id', $id)->get();
        return view('dataPrivatePerson.detail')
            ->with('pt', $pp)
            ->with('data_person', $data_person);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        /*$perusahaan*/  $person = PrivatePerson::all();
        /*$data_perusahaan*/ $data_person = CategoryPP::find($id);
        return view('dataVendor.create')
            ->with('data_perusahaan', $data_person)
            ->with('perusahaan', $person);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        //validasi formnya
        // $this->validate($request,[
        //     'pp_id' => 'required',
        //     'npwp' => 'required',
        //     'Pkp' => 'required',
        //     'jenis_usaha' => 'required',
        // ]);

        $dv = $request->except(['_token']);
       PrivatePerson::insert([
            "pp_id" => $id,
            "npwp" => $request->npwp,
            "Pkp" => $request->Pkp,
            "jenis_usaha" => $request->jenis_usaha,
        ]);

        return redirect("data-person/" . $id)->with('success', 'Task Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $pp_id)
    {
        $data = CategoryPP::find($pp_id);

        $dv = PrivatePerson::where('id', $id)->first();
        return view('dataVendor.show')
        ->with('dv', $dv)
        ->with('data', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $data = PrivatePerson::find($id);

        $tes = PrivatePerson::where("id", $id)->update([
            "npwp" => $request->npwp,
            "Pkp" => $request->Pkp,
            "jenis_usaha" => $request->jenis_usaha,
        ]);
        return redirect("data-vendor/" . $data->pp_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $datavendor = PrivatePerson::find($id);
        $datavendor->delete();
        return redirect()->view('datavendor.index')->with('success','Task Deleted Successfully!');
        $item = PrivatePerson::find($id);
        $item->delete();
        return redirect("data-vendor/" . $item->pp_id)->with('success', 'Task Deleted Successfully!');
    }
}
