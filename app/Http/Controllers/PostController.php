<?php

namespace App\Http\Controllers;

use App\Http\Requests\Posts\SavePost;
use App\Http\Requests\Posts\UpdatePost;
use App\Models\Post;
use Carbon\Carbon;


class PostController extends Controller
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
    public function store(SavePost $request)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $data['image'] = uploadFile($request->image , config('path.POST_PATH'));
        }
        $data['date'] = Carbon::now()->format('Y-m-d');
        $data['author'] = auth()->user()->id;
        Post::create($data);
        session()->flash('success', 'Post published successfully ');
        return back();
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(SavePost $request, Post $post)
    {

        $data = $request->validated();
        //cheak if have request image to delete old and store new image
        if ($request->hasFile('image')) {
        if($post->image){
            $path = $post->image? public_path($post->image) : null;
            if(file_exists($path)){
                unlink($path);
            }
        }
            $data['image'] = uploadFile($request->image , config('path.POST_PATH'));
        }
        $post->update($data);
        session()->flash('success', 'Post Edit successfully ');
        return redirect()->route('home');
      }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if($post->image){
            $path = $post->image? public_path($post->image) : null;
            if(file_exists($path)){
                unlink($path);
            }
        }
        $post->delete();
        session()->flash('success', 'post Deleted successfully ');
        return back();
    }



}
