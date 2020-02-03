<?php

namespace App\Http\Controllers;

use App\Http\Requests\Posts\PostsCreateRequest;
use App\Http\Requests\Posts\PostsUpdateRequest;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('posts.index')->with('posts',Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsCreateRequest $request)
    {

//      upload the image
        $image=$request->image->store('posts');
//        create the post
        Post::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'contents'=>$request->contents,
            'published_at'=>$request->published_at,
            'image'=>$image,

        ]);
//        flash message
        session()->flash('success','Post has been created successfully');

//        redirect user
        return redirect(route('posts.index'));
//        dd($request->all());

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.create',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostsUpdateRequest $request, Post $post)
    {
        $data=$request->only('title','description','contents','published_at');
//        check if new image
        if ($request->hasFile('image')){
//        update if
           $image= $request->image->store('posts');
//        delete old image
            Storage::delete($post->image);

            $data['image']=$image;
        }
//        update attributes
        $post->update($data);
//        flash message
        session()->flash('success','Post Updated Successfully');
//        redirect
        return redirect(route('posts.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post=Post::withTrashed()->where('id',$id)->firstOrFail();
        if ($post->trashed()){
            Storage::delete($post->image);
            $post->forceDelete();
        }else{
            $post->delete();
        }

        //        flash message
        session()->flash('success','Post Deleted Successfully');

//        redirect user
        return redirect(route('posts.index'));
    }

    /**
     * display the trashed posts here
     *
     */
    public function trashed(){
        $trashed=Post::onlyTrashed()->get();
        return view('posts.index')->with('posts',$trashed);
    }
}
