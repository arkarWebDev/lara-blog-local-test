<?php

namespace App\Http\Controllers;

use App\Models\user;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreuserRequest;
use App\Http\Requests\UpdateuserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::when(request("keyword"),function($q){
            $keyword = request("keyword");
                $q->Orwhere("name","like","%$keyword%");
        })
        ->latest("id")->paginate(10)->withQueryString();
        return view("user.index",compact("users"));
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
     * @param  \App\Http\Requests\StoreuserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreuserRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function show(user $user)
    {
        // return $user;
        return view("user.show",compact("user"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(user $user)
    {
        return view("post.edit",compact($user));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateuserRequest  $request
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateuserRequest $request, user $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(user $user)
    {
        $userName = $user->name;
        $user->delete();
        return redirect()->route("user.index")->with("status",$userName . " have been banned");
    }

    public function showAllPost(){
        $normalUser = User::where("id",Auth::id())->get();
        $finalUser = $normalUser[0]->posts()->latest('id')->paginate(12);
        return view("user.allpost",compact('finalUser'));
    }
}