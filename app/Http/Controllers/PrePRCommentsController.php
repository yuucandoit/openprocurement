<?php

namespace App\Http\Controllers;

use App\Models\PrePRComments;
use Illuminate\Http\Request;

class PrePRCommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $comment = PrePRComments::create([
            'user_id' => $request->user_id,
            'id_pre_pr' => $request->id_prepr,
            'id_pre_pr_items' => $request->id_item,
            'comment' => $request->comment,
        ]);

        return redirect()->back();
    }

    public function detail($id)
    {
        $prePRComments = PrePRComments::where('id_pre_pr_items',$id)->get();
        return response()->json([
            'message' => 'Success Get Data',
            'data' => $prePRComments,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PrePRComments  $prePRComments
     * @return \Illuminate\Http\Response
     */
    public function show(PrePRComments $prePRComments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PrePRComments  $prePRComments
     * @return \Illuminate\Http\Response
     */
    public function edit(PrePRComments $prePRComments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PrePRComments  $prePRComments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PrePRComments $prePRComments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PrePRComments  $prePRComments
     * @return \Illuminate\Http\Response
     */
    public function destroy(PrePRComments $prePRComments)
    {
        //
    }
}
