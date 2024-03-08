<?php

namespace App\Http\Controllers;

use App\Models\Pre_pr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ReferensiNamaProject;
use App\Models\PartItem_Pre_pr;

class PrePrController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pre_pr = Pre_pr::where('user_id', Auth::user()->id)->paginate(10);
        return view('PrePR.index')
        ->with('pre_pr', $pre_pr);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $purpose = ReferensiNamaProject::orderBy('created_at','DESC')->get();
        return view('PrePR.create')
        ->with('purpose',$purpose);
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
        $data = $request->all();

        $pre_pr = Pre_pr::create([
            'user_id' =>  Auth::user()->id,
            'project_id' => $request->project,
            'due_date'=> $request->due_date
        ]);

        foreach ($data['item'] as $item => $value) {
            $qty = $data['qty'][$item];
            $buffer =  $data['buffer'][$item];
            $total = $qty + $buffer;

            $data2 = array(
                'pre_pr_id'         => $pre_pr->id,
                'child_item'        => $data['item'][$item],
                'desc'              => $data['desc'][$item],
                'link'              => $data['link'][$item],
                'status'            => $data['status'][$item],
                'qty'               => $qty ?? 0 ,
                'buffer'            => $buffer ?? 0,
                'total'             => $total
            );
            PartItem_Pre_pr::create($data2);
        }
        return redirect()->route('prepr.index')->with('message', 'Success Create Pre PR');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pre_pr  $pre_pr
     * @return \Illuminate\Http\Response
     */
    public function show(Pre_pr $pre_pr)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pre_pr  $pre_pr
     * @return \Illuminate\Http\Response
     */
    public function edit(Pre_pr $pre_pr)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pre_pr  $pre_pr
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pre_pr $pre_pr)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pre_pr  $pre_pr
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pre_pr $pre_pr)
    {
        //
    }
}
