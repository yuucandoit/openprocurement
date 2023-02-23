<?php

namespace App\Http\Controllers;

use App\Imports\ItemHistoryImport;
use App\Models\ItemHistory;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ItemHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pd = ItemHistory::paginate(20);
        return view('pengajuanPembelian.item_history')
            ->with('pd', $pd);
    }

    public function importExcel(Request $request)
    {
         //Validasi
         $this->validate($request, [
            'file' => 'required|mimes:xls,xlsx'
        ]);

        if ($request->hasFile('file')) {
            //UPLOAD FILE
            $file = $request->file('file'); //GET FILE
            // dd($file);
            Excel::import(new ItemHistoryImport, $file); //IMPORT FILE
            return redirect()->back()->with(['success' => 'Upload file data !']);
        }

        return redirect()->back()->with(['error' => 'Please choose file before!']);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ItemHistory  $itemHistory
     * @return \Illuminate\Http\Response
     */
    public function show(ItemHistory $itemHistory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ItemHistory  $itemHistory
     * @return \Illuminate\Http\Response
     */
    public function edit(ItemHistory $itemHistory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ItemHistory  $itemHistory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ItemHistory $itemHistory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ItemHistory  $itemHistory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemHistory $itemHistory)
    {
        //
    }
}
