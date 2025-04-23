<?php

namespace App\Http\Controllers;

use App\Models\Origin;
use App\Http\Requests\StoreOriginRequest;
use App\Http\Requests\UpdateOriginRequest;
use Illuminate\Support\Facades\Redirect;

class OriginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $origins = Origin::all();
        return view('admin.modules.origins.index_origin', [
            'origins' => $origins
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.modules.origins.add_origin');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOriginRequest $request)
    {
        Origin::create([
            'origin_name' => $request->origin_name,
        ]);
        //return
        return Redirect::route('origins.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Origin $origin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Origin $origin)
    {
        return view('admin.modules.origins.edit_origin', [
            'origin' => $origin
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOriginRequest $request, Origin $origin)
    {
        $origin->update([
            'origin_name' => $request->edit_origin,
        ]);
        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Origin $origin)
    {
        $origin->delete();
        return Redirect::route('origins.index');
    }
}
