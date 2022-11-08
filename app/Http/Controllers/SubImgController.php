<?php

namespace App\Http\Controllers;

use App\Models\SubImg;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreSubImgRequest;
use App\Http\Requests\UpdateSubImgRequest;

class SubImgController extends Controller
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
     * @param  \App\Http\Requests\StoreSubImgRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubImgRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubImg  $subImg
     * @return \Illuminate\Http\Response
     */
    public function show(SubImg $subImg)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubImg  $subImg
     * @return \Illuminate\Http\Response
     */
    public function edit(SubImg $subImg)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSubImgRequest  $request
     * @param  \App\Models\SubImg  $subImg
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubImgRequest $request, SubImg $subImg)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubImg  $subImg
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubImg $subImg)
    {
        Storage::delete("public/" . $subImg->name);
        $subImg->delete();

        return redirect()->back();
    }
}