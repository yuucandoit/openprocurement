<?php

namespace App\Http\Controllers;

use App\Imports\EcommerceImport;
use App\Imports\ProjectImport;
use App\Exports\ProjectCode;
use App\Models\ReferensiNamaProject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $check = Auth::user();
        if ( $check->role_id == 3) {
            $data = ReferensiNamaProject::paginate(10);
            return view('dataReferenceProject.index')
            ->with('data',$data);
        }else {
            return redirect()->route('dashboard');
        }
    }

    public function SearchProject(Request $request)
   {
    $cari = $request->cari;
    $data = ReferensiNamaProject::Where('id','like',"%".$cari."%")
    ->orWhere('name','like',"%".$cari."%")
    ->paginate(10);

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
        $check = Auth::user();
        if ( $check->role_id == 3) {
            $data = ReferensiNamaProject::all();
            return view('dataReferenceProject.create')
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

            ReferensiNamaProject::create([
                "name" => $request->name,
            ]);

            return redirect("project-reference/")->with('success', 'Created Successfully!');
        }else{
            return redirect()->route('dashboard');
        }
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
        $check = Auth::user();
        if ( $check->role_id == 3) {
            $data = ReferensiNamaProject::find($id);
            return view('dataReferenceProject.edit')
            ->with('data',$data);
        }else {
            return redirect()->route('dashboard');
        }
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
        $check = Auth::user();
        if ( $check->role_id == 3) {
            $data = ReferensiNamaProject::find($id);

            $tes = ReferensiNamaProject::where("id", $id)->update([
                "name" => $request->name,
            ]);
            return redirect("project-reference/")->with('success', 'Updated Successfully!');
        }else{
            return redirect()->route('dashboard');
        }
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
        $check = Auth::user();
        if ( $check->role_id == 3) {
            $data = ReferensiNamaProject::find($id);
            $data->delete();
            return redirect("project-reference/")->with('success', 'Deleted Successfully!');
        }else{
            return redirect()->route('dashboard');
        }
    }

    public function exportProjectCode()
    {
        return Excel::download(new ProjectCode, 'ProjectCode.xlsx');
    }
}
