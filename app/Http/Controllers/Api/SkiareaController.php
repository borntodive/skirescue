<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Requests\StoreSkiareaRequest;
use App\Http\Requests\UpdateSkiareaRequest;
use App\Models\Skiarea;
use Illuminate\Http\Request;



class SkiareaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $central_id = $request->user()->opscentral_id;
        $skyareas = Skiarea::where('opscentral_id', $central_id)->get();
        return response()->json($skyareas);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSkiareaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Skiarea $skiarea)
    {
        return response()->json($skiarea);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Skiarea $skiarea)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSkiareaRequest $request, Skiarea $skiarea)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Skiarea $skiarea)
    {
        //
    }
}
