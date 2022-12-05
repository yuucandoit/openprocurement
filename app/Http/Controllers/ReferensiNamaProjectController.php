<?php

namespace App\Http\Controllers;

use App\Imports\EcommerceImport;
use App\Imports\ProjectImport;
use App\Models\ReferensiNamaProject;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReferensiNamaProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = ReferensiNamaProject::all();
        return view('dataReferenceProject.index')
        ->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = ReferensiNamaProject::all();
        return view('dataReferenceProject.create')
        ->with('data',$data);
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

       ReferensiNamaProject::create([
            "name" => $request->name,
        ]);

        return redirect("project-reference/")->with('success', 'Created Successfully!');
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
        $data = ReferensiNamaProject::find($id);
        return view('dataReferenceProject.edit')
        ->with('data',$data);
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
        $data = ReferensiNamaProject::find($id);

        // dd($data);
        $tes = ReferensiNamaProject::where("id", $id)->update([
            "name" => $request->name,
        ]);
        return redirect("project-reference/")->with('success', 'Updated Successfully!');
    }


    public function fileImportRF()
    {
        return view('dataReferenceProject.import');
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
		$file->move('file_project',$nama_file);

		// import data
		Excel::import(new ProjectImport, public_path('/file_project/'.$nama_file));

		// alihkan halaman kembali
		return redirect('/project-reference');
    }

    public function destroy($id)
    {
        $data = ReferensiNamaProject::find($id);
        $data->delete();
        return redirect("project-reference/")->with('success', 'Deleted Successfully!');
    }
}
