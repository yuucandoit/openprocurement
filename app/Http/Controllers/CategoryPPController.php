<?php

namespace App\Http\Controllers;

use App\Exports\DvExport;
use App\Exports\PPExport;
use App\Imports\PrivatePersonImport;
use App\Models\Bank;
use App\Models\CategoryPP;
use App\Models\Role;
use App\Models\VendorBank;
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
        if ($check->role_id == 17 || $check->role_id == 3 ||$check->role_id == 4) {
            $bank = Bank::orderBy('name')->get();
            $datadv = CategoryPP::orderBy('nama')->paginate(10);
            return view('dataPrivatePerson.menu.index')
                ->with('bank', $bank)
                ->with('datadv', $datadv);
        } else {
            return redirect()->route('dashboard');
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
     $bank = Bank::orderBy('name')->get();

     return view('dataPrivatePerson.menu.index')
     ->with('bank',$bank)
     ->with('datadv',$datadv);
    }

    public function detail($id)
    {
        $check = Role::where('model_id', Auth::user()->id)->first();

        if ($check->role_id == 17 || $check->role_id == 3 ||$check->role_id == 4) {

            $data_person = CategoryPP::find($id);
            return view('dataPrivatePerson.menu.detail')
            ->with('data_person',$data_person);

        }else {
            return redirect()->route('dashboard');
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $check = Role::where('model_id', Auth::user()->id)->first();
        if ($check->role_id == 17 || $check->role_id == 3 ||$check->role_id == 4) {
            $bank = Bank::orderBy('name')->get();
            return view('dataPrivatePerson.menu.create')
                ->with('bank', $bank);
        } else {
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
        // dd($request->all());
        $check = Role::where('model_id', Auth::user()->id)->first();
        if ($check->role_id == 17 || $check->role_id == 3 ||$check->role_id == 4) {
            $this->validate($request,[
                'nama' => 'required',
                'alamat' => 'required',
                'nik' => 'required',
                'npwp_pp' => 'required',
                'pkp' => 'required',
                'email' => 'required',
                'contact' => 'required',
            ]);

            $dv = $request->except(['_token']);
            $dv['user_id'] = Auth::user()->id;
            $pp = CategoryPP::create([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'nik' => $request->nik,
                'npwp_pp' => $request->npwp_pp,
                'pkp' => $request->pkp,
                'email' => $request->email,
                'contact' => $request->contact,
                'no_rekening' => $request->no_rekening[0] ?? '-',
                'bank' => $request->bank[0] ?? '-',
                'cabang_bank' => $request->cabang_bank ?? '-',
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
                $vendorBank->vendor_id = $pp->id;
                $vendorBank->vendor_type = CategoryPP::class; // Set the class name as vendor_type
                $vendorBank->bank_id = $bankName;
                $vendorBank->no_rekening = $noRekening;
                $vendorBank->nama_penerima = $namaPenerima;

                // Save the record to the database
                $vendorBank->save();
            }
            return redirect('menu-private-person/')->with('success', 'Task Created Successfully!');
        } else {
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
        $check = Role::where('model_id', Auth::user()->id)->first();
        if ($check->role_id == 17 || $check->role_id == 3 || $check->role_id == 4) {
            $bank = Bank::orderBy('name')->get();
            $dv = CategoryPP::find($id);
            return view('dataPrivatePerson.menu.edit')
            ->with('dv', $dv)
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
        $check = Role::where('model_id', Auth::user()->id)->first();
        if ($check->role_id == 17 || $check->role_id == 3 ||$check->role_id == 4) {
            $this->validate($request,[
                'nama' => 'required',
                'alamat' => 'required',
                'nik' => 'required',
                'npwp_pp' => 'required',
                'pkp' => 'required',
                'email' => 'required',
                'contact' => 'required',
            ]);

            $data = CategoryPP::find($id);

            $tes = CategoryPP::where("id", $id)->update([
                "nama" => $request->nama,
                "alamat" => $request->alamat,
                "nik" => $request->nik,
                "npwp_pp" => $request->npwp_pp,
                "pkp" => $request->pkp,
                "no_rekening" => $request->no_rekening,
                "bank" => $request->bank,
                "cabang_bank" => $request->cabang_bank,
                "contact"   => $request->contact,
                "email"     => $request->email,
            ]);


            $existingVendorBanks = VendorBank::where('vendor_id', $id)
                                      ->where('vendor_type', CategoryPP::class)
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
                        'vendor_type'     => CategoryPP::class,
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


            return redirect("menu-private-person/");
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
        $check = Role::where('model_id', Auth::user()->id)->first();
        if ($check->role_id == 17 || $check->role_id == 3 || $check->role_id == 4 ) {
        $data = CategoryPP::find($id);
        $data->delete();
        return redirect('/menu-private-person')->with('success', 'Task Deleted Successfully!');
        }else {
            return redirect()->route('dashboard');
        }
    }

    public function fileImportPP()
    {
        $check = Role::where('model_id', Auth::user()->id)->first();
        if ($check->role_id == 17 || $check->role_id == 3 ||$check->role_id == 4) {
        return view('dataPrivatePerson.menu.import');
        }else {
            return redirect()->route('dashboard');
        }
    }

    public function fileImport(Request $request)
    {
        $check = Role::where('model_id', Auth::user()->id)->first();
        if ($check->role_id == 17 || $check->role_id == 3 ||$check->role_id == 4) {
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
        }else {
            return redirect()->route('dashboard');
        }
    }

    public function export()
    {
        $check = Role::where('model_id', Auth::user()->id)->first();
        if ($check->role_id == 17 || $check->role_id == 3 ||$check->role_id == 4) {
        return Excel::download(new PPExport, 'PrivatePerson.xlsx');
        }return redirect()->route('dashboard');
    }
}
