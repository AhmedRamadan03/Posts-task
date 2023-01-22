<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;

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
        // store the data in db
        $validator = validator($request->all(),$this->rules(null), $this->messages());

        if($validator->fails()){
            session()->flash('error', $validator->errors());
            return back();
        }
        $data = $request->except('image');
        if ($request->hasFile('image')) {
            $data['image'] = uploadFile($request->image , 'uploads/posts/');
        }
        $data['date'] = Carbon::now()->format('Y-m-d');
        $data['author'] = auth()->user()->id;
        Post::create($data);
        session()->flash('success', 'Post published successfully ');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
          // store the data in db
          $validator = validator($request->all(),$this->rules($post->id), $this->messages());

          if($validator->fails()){
              session()->flash('error', $validator->errors());
              return back();
          }
          $data = $request->except('image');
          if ($request->hasFile('image')) {
            if($post->image){
                $path = $post->image? public_path($post->image) : null;
                if(file_exists($path)){
                    unlink($path);
                }
            }
              $data['image'] = uploadFile($request->image , 'uploads/posts/');
          }
          $data['date'] = Carbon::now()->format('Y-m-d');
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


    public function rules($postId){
        return [
            'title' =>'required|string|regex:/^[a-zA-Z\s]+$/u|max:150|unique:posts,title,' . $postId,
            'content' => 'required|string|min:20',
            'image' => 'nullable|image|mimes:png,jpg,weba|max:2048',
        ];
    }

    public function messages (){
        return [
            'title.required'=>'this input must be require',
            'content.required'=>'this input must be require',
            'string'=>'this input must be string',
            'image' => 'this input must be image with type jpg,weba,png',
            'unique' => 'this input must be unique',
            'regex' => 'title accept only letter',
        ];
    }
}
