<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comments\SaveComment;
use App\Models\Comment;
use Illuminate\Http\Request;

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveComment $request)
    {

        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;
        Comment::create($data);
        session()->flash('success', 'Comment published successfully ');
        return back();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        session()->flash('success', 'Comment Deleted successfully ');
        return back();

    }



}
