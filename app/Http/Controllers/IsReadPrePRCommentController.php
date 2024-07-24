<?php

namespace App\Http\Controllers;

use App\Models\IsReadPrePRComment;
use Illuminate\Http\Request;

class IsReadPrePRCommentController extends Controller
{

    public function markAsRead(Request $request)
    {
        // return response()->json(['success' => true, 'message' => 'Endpoint reached']);
        try {
            $isRead = IsReadPrePRComment::updateOrCreate(
                [
                    'user_id' => $request->user_id,
                    'id_pre_pr_items' => $request->id_pre_pr_items,
                    'comment_id' => $request->comment_id
                ],
                ['is_read' => $request->is_read]
            );

            return response()->json(['success' => true, 'message' => 'Marked as read successfully', 'data' => $isRead]);
        } catch (\Exception $e) {
            // Log the exception message for debugging purposes
            \Log::error($e->getMessage());
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IsReadPrePRComment  $isReadPrePRComment
     * @return \Illuminate\Http\Response
     */
    public function show(IsReadPrePRComment $isReadPrePRComment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IsReadPrePRComment  $isReadPrePRComment
     * @return \Illuminate\Http\Response
     */
    public function edit(IsReadPrePRComment $isReadPrePRComment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\IsReadPrePRComment  $isReadPrePRComment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IsReadPrePRComment $isReadPrePRComment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IsReadPrePRComment  $isReadPrePRComment
     * @return \Illuminate\Http\Response
     */
    public function destroy(IsReadPrePRComment $isReadPrePRComment)
    {
        //
    }
}
