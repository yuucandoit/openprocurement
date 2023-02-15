<?php

namespace App\Http\Controllers;

use App\Models\CategoryPengajuanPembelian;
use App\Models\Comment;
use App\Models\CommentRead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
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
    public function store(Request $request,$id)
    {
        // dd($request->all());
        $pengajuan = CategoryPengajuanPembelian::find($id);
        $comments =  Comment::create([
            'ppb_id' => $pengajuan->id,
            'user_id' =>  Auth::user()->id,
            'comment' => $request->comment,
        ]);

        if($request->role == 'super user'){
            CommentRead::create([
                'comment_id' => $comments->id,
                'user_id' => Auth::user()->id,
                'is_read_bod'       => 1,
                'is_read_user'      => 0,
                'is_read_purchase'  => 0,
                'is_read_finance'   => 0,
            ]);
        }elseif ($request->role == 'user') {
            CommentRead::create([
                'comment_id' => $comments->id,
                'user_id' => Auth::user()->id,
                'is_read_user'      => 1,
                'is_read_purchase'  => 0,
                'is_read_finance'   => 0,
                'is_read_bod'       => 0,
            ]);

        }elseif ($request->role == 'purchasing') {
            CommentRead::create([
                'comment_id' => $comments->id,
                'user_id' => Auth::user()->id,
                'is_read_purchase'  => 1,
                'is_read_user'      => 0,
                'is_read_finance'   => 0,
                'is_read_bod'       => 0,
            ]);

        }elseif ($request->role == 'finance') {
            CommentRead::create([
                'comment_id' => $comments->id,
                'user_id' => Auth::user()->id,
                'is_read_finance'   => 1,
                'is_read_user'      => 0,
                'is_read_purchase'  => 0,
                'is_read_bod'       => 0,
            ]);

        }


        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $data = $request->all();
        $pengajuan = CategoryPengajuanPembelian::find($id);

        Comment::where('id',$id)->update([
            'ppb_id' => $pengajuan->id,
            'user_id' =>  Auth::user()->id,
            'comment' => $request->comment,
        ]);

        dd($data);
        return redirect()->back();
    }

    public function is_read(Request $request,$id)
    {
        // dd($request->all());
        if($request->role == 'super user'){
            $data = CommentRead::find($id);
            $data->is_read_bod = 1;
            $data->save();
            return redirect()->route('menu-taskList-atasan.detail',$data->comment->ppb_id.'#comment');
        }
        elseif ($request->role == 'user') {
            $data = CommentRead::find($id);
            $data->is_read_user = 1;
            $data->save();
            return redirect()->route('menu-pengajuan-pembelian.detail',$data->comment->ppb_id.'#comment');
        }
        elseif ($request->role == 'purchasing') {
            $data = CommentRead::find($id);
            $data->is_read_purchase = 1;
            $data->save();
            return redirect()->route('menu-purchase-order.detail',$data->comment->ppb_id.'#comment');
        }
        elseif ($request->role == 'finance') {
            $data = CommentRead::find($id);
            $data->is_read_finance = 1;
            $data->save();
            return redirect()->route('menu-pengajuan-dana.detail',$data->comment->ppb_id.'#comment');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment,$id)
    {
        $komentar = Comment::find($id);
        $komentar->destroy();
    }
}
