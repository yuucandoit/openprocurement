<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Q_Quotation;
use App\Models\CategoryQuotation;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\QuExport;


class QuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        return view('auth.login');
    }

    public function menu()
    {
        return view('quotation.menu');
    }

    public function index($id)
    {
        $data_company = CategoryQuotation::find($id);
        $data = Q_Quotation::where('category_id', $id)->get();
        return view('quotation.Index')
            ->with('data', $data)
            ->with('data_company', $data_company);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $data_company = CategoryQuotation::find($id);
        // dd($data_company);
        return view('quotation.create')
            ->with('data_company', $data_company);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $data = $request->except(['_token']);
        // dd($data);
        Q_Quotation::insert([
            "category_id" => $id,
            "type" => $request->type,
            "qty" => $request->qty,
            "unit" => $request->unit,
            "unitprice" => $request->unitprice,
            "amount" => $request->qty * $request->unitprice
        ]);
        return redirect('quotation/' . $id)->with('success', 'Task Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id_company, $id)
    {
        $data_company = CategoryQuotation::find($id_company);
        // dd($data_company);
        $data = Q_Quotation::where('id', $id)->first();
        // dd($data);
        return view('quotation.show')
            ->with('data', $data)
            ->with('data_company', $data_company);
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
        $data_company = Q_Quotation::find($id);
        // dd($data_company);
        Q_Quotation::where('id', $id)->update([
            "type" => $request->type,
            "qty" => $request->qty,
            "unit" => $request->unit,
            "unitprice" => $request->unitprice,
            "amount" => $request->qty * $request->unitprice
        ]);
        return redirect('quotation/' . $data_company->category_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $data = Q_Quotation::find($id);
        $data->delete();
        return redirect('quotation/' . $data->category_id)->with('success', 'Task Deleted Successfully!');
    }


    public function export($id)
    {
        return Excel::download(new QuExport($id), 'quotation.xlsx');
    }
}
