<?php

namespace App\Http\Controllers;

use App\Exports\DvExport;
use App\Exports\PPExport;
use App\Imports\PrivatePersonImport;
use App\Models\CategoryPP;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
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
            $datadv = CategoryPP::where('user_id', Auth::user()->id)->paginate(10);
            return view('dataPrivatePerson.menu.index')
                ->with('datadv', $datadv);
        } else if ($check->role_id == 1 || $check->role_id == 3 ||$check->role_id == 4) {
            $datadv = CategoryPP::orderBy('nama')->paginate(10);
            return view('dataPrivatePerson.menu.index')
                ->with('datadv', $datadv);
        }
    }

    public function SearchPP(Request $request)
    {
     $cari = $request->cari;
     //dd($cari);
     $datadv = CategoryPP::Where('id','like',"%".$cari."%")
     ->orWhere('nama','like',"%".$cari."%")
     ->orWhere('alamat','like',"%".$cari."%")
     ->orWhere('nik','like',"%".$cari."%")
     ->orWhere('npwp_pp','like',"%".$cari."%")
     ->orWhere('pkp','like',"%".$cari."%")
     ->paginate(10);

     return view('dataPrivatePerson.menu.index')
     ->with('datadv',$datadv);
    }

    public function detail($id)
    {
        $data_person = CategoryPP::find($id);
        return view('dataPrivatePerson.menu.detail')
        ->with('data_person',$data_person);
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
            "no_rekening" => $request->no_rekening,
            "bank" => $request->bank,
            "cabang_bank" => $request->cabang_bank,
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

    public function fileImportPP()
    {
        return view('dataPrivatePerson.menu.import');
    }

    public function fileImport(Request $request)
    {
        // validasi
		$this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);

		// menangkap file excel
		$file = $request->file('file');

		// membuat nama file unik
		$nama_file = rand().$file->getClientOriginalName();

		// upload ke folder file_siswa di dalam folder public
		$file->move('file_pp',$nama_file);

		// import data
		Excel::import(new PrivatePersonImport, public_path('/file_pp/'.$nama_file));

		// alihkan halaman kembali
		return redirect('/menu-private-person');
    }

    public function export()
    {
        // dd('hallo');
        return Excel::download(new PPExport, 'PrivatePerson.xlsx');
    }
}
