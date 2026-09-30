<?php

namespace App\Http\Controllers;

use App\Exports\PTExport;
use App\Imports\PerusahaanImport;
use App\Models\Bank;
use App\Models\CategoryDV;
use App\Models\CategoryPT;
use App\Models\DataVendor;
use App\Models\Perusahaan;
use App\Models\Role;
use App\Models\VendorBank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class CategoryPTController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $check = Auth::user();

        if ($check->role_id == 17 || $check->role_id == 3 || $check->role_id == 4 ) {
            $datadv = CategoryPT::orderBy('nama')->paginate(10);
            $bank = Bank::orderBy('name')->get();
            return view('dataPerusahaan.menu.index')
                ->with('datadv', $datadv)
                ->with('bank', $bank);
        } else {
            return redirect()->route('dashboard');
        }
    }

    public function SearchPT(Request $request)
    {
     $cari = $request->cari;
     //dd($cari);
     $datadv = CategoryPT::Where('id','like',"%".$cari."%")
     ->orWhere('nama','like',"%".$cari."%")
     ->orWhere('alamat','like',"%".$cari."%")
     ->orWhere('no_telp_kantor','like',"%".$cari."%")
     ->orWhere('website','like',"%".$cari."%")
     ->paginate(10);
     $bank = Bank::orderBy('name')->get();

     return view('dataPerusahaan.menu.index')
     ->with('datadv',$datadv)
     ->with('bank', $bank);
    }

    public function detail($id)
    {
        $check = Auth::user();
        if ($check->role_id == 17 || $check->role_id == 3 ||$check->role_id == 4) {
        $data_perusahaan = CategoryPT::find($id);
        return view('dataPerusahaan.menu.detail')
        ->with('data_perusahaan',$data_perusahaan);
        }else {
            return redirect()->route('dashboard');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bank = Bank::orderBy('name')->get();
        return view('dataPerusahaan.menu.create',compact('bank'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $check = Auth::user();
        if ($check->role_id == 17 || $check->role_id == 3 ||$check->role_id == 4) {
            $this->validate($request,[
                'nama' => 'required',
                'alamat' => 'required',
                'no_telp_kantor' => 'required',
                'nama_pic' => 'required',
                'no_telp_pic' => 'required',
                'email' => 'required',
                'npwp_perusahaan' => 'required',
                'Pkp' => 'required',
                'bidang_usaha' => 'required',
                'no_telp_kantor' => 'required'
            ]);
            // dd($request->no_rekening[0]);

            $pt = CategoryPT::create([
                'user_id'               => Auth::user()->id,
                'nama'                  => $request->nama ?? '-',
                'alamat'                => $request->alamat ?? '-',
                'no_telp_kantor'        => $request->no_telp_kantor ?? '-',
                'website'               => $request->website ?? '-',
                'nama_pic'              => $request->nama_pic ?? '-',
                'no_telp_pic'           => $request->no_telp_pic ?? '-',
                'email'                 => $request->email ?? '-',
                'npwp_perusahaan'       => $request->npwp_perusahaan ?? '-',
                'pkp'                   => $request->pkp ?? '-',
                'nib'                   => $request->nib ?? '-',
                'bidang_usaha'          => $request->bidang_usaha ?? '-',
                'no_rekening'           => $request->no_rekening[0] ?? '-',
                'bank'                  => $request->bank[0] ?? '-',
                'cabang_bank'           => $request->cabang_bank ?? '-',
                'nama_penerima'         => $request->nama_penerima[0] ?? '-',
            ]);

            $bankData = $request->input('bank');
            $noRekeningData = $request->input('no_rekening');
            $namaPenerimaData = $request->input('nama_penerima');

            // Iterate over the bank data and save each record
            foreach ($bankData as $index => $bankName) {
                $noRekening = $noRekeningData[$index];
                $namaPenerima = $namaPenerimaData[$index];

                // Create a new instance of VendorBank and fill the fields
                $vendorBank = new VendorBank();
                $vendorBank->vendor_id = $pt->id;
                $vendorBank->vendor_type = CategoryPT::class; // Set the class name as vendor_type
                $vendorBank->bank_id = $bankName;
                $vendorBank->no_rekening = $noRekening;
                $vendorBank->nama_penerima = $namaPenerima;

                // Save the record to the database
                $vendorBank->save();
            }


            return redirect('menu-perusahaan/')->with('success', 'Task Created Successfully!');
        }else {
            return redirect()->route('dashboard');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($pt_id,$id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request ,$id)
    {
        $check = Auth::user();
        if ($check->role_id == 17 || $check->role_id == 3 ||$check->role_id == 4) {
            $bank = Bank::orderBy('name')->get();
            $dv = CategoryPT::find($id);
            return view('dataPerusahaan.menu.edit')
            ->with('dv' , $dv)
            ->with('bank' , $bank);
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
        // dd($request->all());
        $check = Auth::user();
        if ($check->role_id == 17 || $check->role_id == 3 ||$check->role_id == 4) {
            $data = CategoryPT::find($id);
            $tes = CategoryPT::where("id", $id)->update([
                "nama" => $request->nama,
                "alamat" => $request->alamat,
                "no_telp_kantor" => $request->no_telp_kantor,
                "website" => $request->website,
                "nama_pic" => $request->nama_pic,
                "email" => $request->email,
                "npwp_perusahaan" => $request->npwp_perusahaan,
                "Pkp" => $request->Pkp,
                "nib" => $request->nib,
                "bidang_usaha" => $request->bidang_usaha,
            ]);

            $existingVendorBanks = VendorBank::where('vendor_id', $id)
                                      ->where('vendor_type', CategoryPT::class)
                                      ->get()
                                      ->keyBy('id'); // Key by ID for easier comparison

            // Collect data from the request
            $bankData = $request->input('bank');
            $noRekeningData = $request->input('no_rekening');
            $namaPenerimaData = $request->input('nama_penerima');

            // Iterate over the bank data and process each record
            foreach ($bankData as $index => $bankName) {
                $noRekening = $noRekeningData[$index];
                $namaPenerima = $namaPenerimaData[$index];

                // Check if we need to update an existing record or create a new one
                $existingVendorBank = $existingVendorBanks->firstWhere('bank_id', $bankName);

                if ($existingVendorBank) {
                    // Update existing record
                    $existingVendorBank->update([
                        'no_rekening'    => $noRekening,
                        'nama_penerima'  => $namaPenerima,
                    ]);

                    // Remove from existing records to track for deletion
                    $existingVendorBanks->forget($existingVendorBank->id);
                } else {
                    // Create a new record
                    VendorBank::create([
                        'vendor_id'       => $id,
                        'vendor_type'     => CategoryPT::class,
                        'bank_id'         => $bankName,
                        'no_rekening'     => $noRekening,
                        'nama_penerima'   => $namaPenerima,
                    ]);
                }
            }

            // Delete records that were not included in the current request
            foreach ($existingVendorBanks as $vendorBank) {
                $vendorBank->delete();
            }

            return redirect("menu-perusahaan/");
        }else {
            return redirect()->route('dashboard');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $check = Auth::user();
        if ($check->role_id == 17 || $check->role_id == 3 ) {
            $data = CategoryPT::find($id);
            $data->delete();
            return redirect('/menu-perusahaan')->with('success', 'Task Deleted Successfully!');
        }else {
            return redirect()->route('dashboard');
        }
    }

    public function fileImportPT()
    {
        $check = Auth::user();
        if ($check->role_id == 17 || $check->role_id == 3 ) {
        return view('dataPerusahaan.menu.import');
        }else {
            return redirect()->route('dashboard');
        }
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
		$file->move('file_pt',$nama_file);

		// import data
		Excel::import(new PerusahaanImport, public_path('/file_pt/'.$nama_file));

		// alihkan halaman kembali
		return redirect('/menu-perusahaan');
    }

    public function export()
    {
        $check = Auth::user();
        if ($check->role_id == 17 || $check->role_id == 3 || $check->role_id == 4) {
        return Excel::download(new PTExport, 'data_pt.xlsx');
        }
    }
}
