<?php

namespace App\Http\Controllers;

use App\Models\CategoryPB;
use Illuminate\Http\Request;
use App\Models\PembelianBarang;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PbExport;
use Carbon\Carbon;

class PembelianBarangController extends Controller
{
    // public function menu(){
    //     return view('PembelianBarang.menu');
    // }

    public function index($id)
    {
        $menu_pb = CategoryPB::find($id);
        $pb = PembelianBarang::where('pb_id', $id)->get();
        return view('pembelianBaran.index')
            ->with('pb', $pb)
            ->with('menu_pb', $menu_pb);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $pb = CategoryPB::find($id);
        return view('pembelianBarang.create')
            ->with('pb', $pb);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $pb = $request->except(['_token']);
        $pb['user_id'] = Auth::user()->id;
        $category = CategoryPB::where('id', $id)->firstOrFail();

        PembelianBarang::insert([
            'pb_id' => $id,
            // 'no_doc' => $request->no_doc,
            // 'revisi' => $request->revisi,
            // 'tanggal' => $request->tanggal,
            'rev' => $request->rev,
            'subject' => $category->subject,
            'nama' => $category->nama,
            'lokasi' => $request->lokasi,
            'jangka_waktu' => $request->jangka_waktu,
            // 'jam_approve' => $category->acc_at,
            'dana_diperlukan' => $request->dana_diperlukan,
            'no_rek' => $request->no_rek,
            'item' => $request->item,
            'quantity' => $request->quantity,
            'jumlah_quantity' => $request->jumlah_quantity,
            'harga_satuan' => $request->harga_satuan,
            'total' => $request->jumlah_quantity * $request->harga_satuan
        ]);
        return redirect("pembelian-barang/" . $id)->with('success', 'Task Created Successfully!');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $pb_id, $id)
    {
        $menu_pb = CategoryPB::find($pb_id);
        $pb = PembelianBarang::where('id', $id)->first();
        return view('pembelianBarang.show')
            ->with('pb', $pb)
            ->with('menu_pb', $menu_pb);
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
        $item = PembelianBarang::find($id);
        $category = CategoryPB::where('id', $id)->firstOrFail();
        PembelianBarang::where('id', $id)->update([
            // 'tanggal' => $request->tanggal,
            'rev' => $request->rev,
            'subject' => $category->subject,
            'nama' => $category->nama,
            'lokasi' => $request->lokasi,
            'jangka_waktu' => $request->jangka_waktu,
            // 'jam_approve' => $category->acc_at,
            'dana_diperlukan' => $request->dana_diperlukan,
            'no_rek' => $request->no_rek,
            'item' => $request->item,
            'quantity' => $request->quantity,
            'jumlah_quantity' => $request->jumlah_quantity,
            'harga_satuan' => $request->harga_satuan,
            'total' => $request->jumlah_quantity * $request->harga_satuan
        ]);
        return redirect('pembelian-barang/' . $item->pb_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = PembelianBarang::find($id);
        $item->delete();
        return redirect('pembelian-barang/' . $item->pb_id)->with('success', 'Task Deleted Successfully!');
    }

    public function export($id)
    {
        return Excel::download(new PbExport($id), 'pembelian.xlsx');
    }

    public function accept($id)
    {
        $data = PembelianBarang::find($id);

        $data->status = 'Accepted';

        $data->update();

        return redirect()->back();
    }

    public function Reject($id)
    {
        $data = PembelianBarang::find($id);

        $data->status = 'Rejected';

        $data->save();

        return redirect('pembelian-barang/');
    }
}
