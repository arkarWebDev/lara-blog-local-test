<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdatePostRequest;
use App\Models\SubImg;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::when(request("keyword"),function($q){
            $keyword = request("keyword");
                $q->Orwhere("title","like","%$keyword%")
                ->orWhere("description","like","%$keyword%");
        })->when(Auth::user()->role == 2,fn ($q) => $q->where("user_id",Auth::user()->id))
        ->latest()->paginate(10)->withQueryString();
        return view("post.index",compact("posts"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("post.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $post = new Post();
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->description = $request->description;
        $post->excerpt = Str::words($request->description,50);
        
        if($request->hasFile("feature_image")){

            Storage::delete("public/". $post->feature_image);
            $fileName = uniqid() . "feature_img." . $request->file("feature_image")->extension();
            $request->file("feature_image")->storeAs("public",$fileName);
            $post->feature_image = $fileName;
        }

        $post->user_id = Auth::id();
        $post->category_id = $request->category;
        $post->save();

        foreach($request->subImgs as $img){
            $fileName = uniqid() . "_sub_img." . $request->file("feature_image")->extension();
            $img->storeAs("public",$fileName);

            $subImg = new SubImg();
            $subImg->name = $fileName;
            $subImg->post_id = $post->id;

            $subImg->save();
        }
        
        return redirect()->route("post.index")->with("status","Post uploaded successfully.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view("post.show",compact("post"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        Gate::authorize("update",$post);
        
        return view("post.edit",compact("post"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        if(Gate::denies("update",$post)){
            return abort("403","You can't update other users posts");
        }
        
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->description = $request->description;
        $post->excerpt = Str::words($request->description,50);
        
        if($request->hasFile("feature_image")){
            $fileName = uniqid() . "feature_img." . $request->file("feature_image")->extension();
            $request->file("feature_image")->storeAs("public",$fileName);
            $post->feature_image = $fileName;
        }

        $post->user_id = Auth::id();
        $post->category_id = $request->category;
        $post->update();
        
        return redirect()->route("post.index")->with("status","Post updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if(Gate::denies("delete",$post)){
            return abort("403","you can't delete other users posts.");
        }

        if(isset($post->feature_image)){
            Storage::delete("public/". $post->feature_image);
        }
        $post->delete();
        return redirect()->route("post.index")->with("status","Post deleted successfully.");
    }
}