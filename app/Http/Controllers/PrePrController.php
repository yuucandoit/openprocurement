<?php

namespace App\Http\Controllers;

use App\Models\Pre_pr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ReferensiNamaProject;
use App\Models\PartItem_Pre_pr;
use Illuminate\Support\Facades\Session;

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
     * Display a detail of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function detail($id)
    {
        $pre_pr = Pre_pr::find($id);
        return view('PrePR.detail')
        ->with('pre_pr', $pre_pr);
    }

    /**
     * Display a Search List of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function search(Request $request)
    {
        $cari = $request->cari;
        //dd($cari);=
        $pre_pr = Pre_pr::where('user_id', Auth::user()->id)
        ->where('id','like',"%".$cari."%")
        ->orWhereHas('partItem', function($q) use($cari){
            $q->where('child_item','like',"%".$cari."%")
            ->orWhere('qty','like',"%".$cari."%")
            ->orWhere('buffer','like',"%".$cari."%")
            ->orWhere('desc','like',"%".$cari."%")
            ->orWhere('status','like',"%".$cari."%");
        })
        ->orWhereHas('project', function($p) use($cari){
            $p->where('name','like',"%".$cari."%");
        })
        ->orWhere('due_date','like',"%".$cari."%")
        ->paginate(10);

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
        $oldInput = Session::getOldInput();
        return view('PrePR.create')
        ->with('oldInput', $oldInput)
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

        $existProject = Pre_pr::where('user_id',Auth::user()->id)->where('project_id',$request->project)->first();
        if($existProject){
            Session::flashInput($request->input());
            return redirect()->back()->with('error', 'Project Already Exist -_- ');
        }

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
    public function edit($id)
    {
        $pre_pr = Pre_pr::find($id);
        $purpose = ReferensiNamaProject::orderBy('created_at','DESC')->get();
        return view('PrePR.edit')
        ->with('purpose',$purpose)
        ->with('pre_pr', $pre_pr);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pre_pr  $pre_pr
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        $existProject = Pre_pr::where('user_id',Auth::user()->id)->where('project_id',$request->project)->first();
        if($existProject){
            return redirect()->back()->with('error', 'Project Already Exist -_- ');
        }

        $pre_pr = Pre_pr::where('id',$id)->update([
            'user_id' =>  Auth::user()->id,
            'project_id' => $request->project,
            'due_date'=> $request->due_date
        ]);

        foreach ($data['item'] as $item => $value) {
            $qty = $data['qty'][$item];
            $buffer =  $data['buffer'][$item];
            $total = $qty + $buffer;

            $data2 = array(
                'child_item'        => $data['item'][$item],
                'desc'              => $data['desc'][$item],
                'link'              => $data['link'][$item],
                'status'            => $data['status'][$item],
                'qty'               => $qty ?? 0 ,
                'buffer'            => $buffer ?? 0,
                'total'             => $total
            );
            PartItem_Pre_pr::updateOrCreate(
                ['pre_pr_id' => $id, 'child_item' => $value],
                $data2
            );
        }

        PartItem_Pre_pr::where('pre_pr_id', $id)
        ->whereNotIn('child_item', $data['item'])
        ->delete();

        return redirect()->route('prepr.index')->with('message', 'Success Update Pre PR');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pre_pr  $pre_pr
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pre_pr = Pre_pr::find($id);
        PartItem_Pre_pr::where('pre_pr_id', $id)->delete();
        $pre_pr->delete();
        return redirect()->route('prepr.index')->with('message', 'Success Delete Pre PR');
    }
}
